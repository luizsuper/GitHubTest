<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/17
 * Time: 16:51
 */

namespace app\api\controller\v1;


use app\api\controller\BaseConitroller;
use app\api\validate\OrderPlace;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Controller;
use app\api\service\Token as TokenS;
use app\api\service\Order as OrderS;
use think\response\Json;

class Order extends BaseConitroller
{
    //用户在选择商品后，向api提交包含所选商品的相关信息
    //API在接受到信息后，需要检查订单查看相关产品库存量
    //有库存，把订单存入数据库=下单成功，拉起支付接口
    //支付之前再检测一遍库存量
    //返回支付结果
    //支付成功，需要进行库存量的检测
    //成功:进行库存量扣除，失败，返回支付失败结果
    protected $beforeActionList = [
        'checkExclusiveScope'=>['only'=>'placeOrder']
    ];

    public function placeOrder()
    {
       ( new OrderPlace())->goCheck();
       //使用助手函数接受大量的参数
        $products = input('post.products/a');
        $uid = TokenS::getCurrentUid();

        $order = new OrderS();
        $status = $order->place($uid,$products);
        return json($status);
    }


}