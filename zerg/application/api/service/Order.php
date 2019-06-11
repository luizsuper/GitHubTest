<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/18
 * Time: 13:42
 */

namespace app\api\service;


use app\api\modle\OrderProduct;
use app\api\modle\Product;
use app\api\modle\UserAddress;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;
use think\Exception;

class Order
{
    //用户传递进来的订单
    protected $oProducts;
    //真实的订单
    protected $products;
    protected $uid;

    public function place($uid,$oProducts)
    {
        $this->oProducts = $oProducts;
        $this->products = $this->getProductsByOrder($oProducts);
        $this->uid = $uid;
        $status = $this->getOrderStatus();
        if(!$status['pass'])
        {
            $status['order_id'] = -1;
            return $status;
        }
        //开始创建订单
        $orderSnap = $this->snapOrder($status);
        $order = $this->createOrder($orderSnap);
        $order['pass'] = true;
        return $order;

    }
    private function createOrder($snap)
    {
        try{
            $orderNo = $this::makeOrderNo();
            $order = new \app\api\modle\Order();
            $order->user_id = $this->uid;
            $order->order_no = $orderNo;
            $order->total_price = $snap['orderPrice'];
            $order->total_count = $snap['totalCount'];
            $order->snap_img = $snap['snapImg'];
            $order->snap_address = $snap ['snapAddress'];
            $order->snap_items = json_encode($snap['pStatus']);
            $order->snap_name = $snap['snapName'];
            $order->save();

            $orderID = $order->id;
            $createtime = $order->create_time;
            foreach ($this->oProducts as &$p)
            {
                $p['order_id'] = $orderID;
            }
            $orderProduct = new OrderProduct();
            $orderProduct->saveAll($this->oProducts);
            return[
                'order_no' => $orderNo,
                'order_id' => $orderID,
                'create_time' => $createtime
            ];}catch (\Exception $exception)
        {
            throw $exception;
        }

    }
    public static function makeOrderNo()
    {
        $yCode = array('A','B','C','D','E','F','G','H','I','J');
        $orderSn = $yCode[intval(date('Y'))-2017]. strtoupper(dechex(date('m'))). date('d'). substr(time(), -5).
            substr(microtime(),2,5). sprintf('%02d',rand(0,99));
        return $orderSn;
    }
    //生成订单快照
    private function snapOrder($status)
    {
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' =>[],
            'snapAddress' => null,
            'snapName' => '',
            'snapImg' =>''
        ];
        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus'] = $status[ 'pStatusArray'];
        $snap ['snapAddress'] =  json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];
        $snap['snapImg'] = $this->products[0]['main_img_url'];
        if(count($this->products) > 1)
        {
            $snap['snapName'] .= '等';
        }
        return $snap;
    }
    private function getUserAddress()
    {
        $userAddress = UserAddress::where('user_id','=',$this->uid)->find();
        if(!$userAddress)
        {
            throw new UserException(
                ['msg'=>'收货地址不存在 ',
                    'errorCode'=>60001
                    ]
            );
        }
        return $userAddress->toArray();
    }
    //根据订单信息查找真实的商品信息
    private function getProductsByOrder($oProducts)
    {
        $oPIDS = [];
        foreach ($oProducts as $item)
        {
            array_push($oPIDS,$item['product_id']);
        }
        $products = Product::all($oPIDS)->visible(['id','name','price','stock','main_img_url'])->toArray();
        return $products;

    }
    private function getOrderStatus()
    {
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'pStatusArray'=>[],
            'totalCount' => 0
        ];
        foreach ($this->oProducts as $oProduct)
        {
            $pStatus = $this->getProductStatus(
                $oProduct['product_id'],$oProduct['count'],$this->products
            );
            if(!$pStatus['haveStock'])
            {
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
            $status['totalCount'] += $pStatus['count'];
            array_push($status['pStatusArray'],$pStatus);
        }
        return $status;
    }
    private function getProductStatus($oPID,$oCount,$products)
    {
        $pIndex = -1;
        $pStatus = [
            'id' =>null,'haveStock'=>false,'count'=>0,'name'=>'','totalPrice'=>''
        ];
        for($i=0;$i<count($products);$i++)
        {
            if($oPID == $products[$i]['id'])
            {
                $pIndex = $i;
            }
        }
        if($pIndex == -1)
        {
            throw new  OrderException([
                'msg'=>'id为'.$oPID.'商品不存在'
            ]);
        }
        else
            {
                $product = $products[$pIndex];
                $pStatus['id'] = $product['id'];
                $pStatus['count'] = $oCount;
                $pStatus['name'] = $product['name'];
                $pStatus['totalPrice'] = $product['price'] * $oCount;
                if($product['stock'] - $oCount >= 0)
                {
                    $pStatus['haveStock'] = true;
                }
            }
        return $pStatus;
    }

}