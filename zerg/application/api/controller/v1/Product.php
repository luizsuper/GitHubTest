<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/7
 * Time: 15:55
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ProductException;
use think\Collection;
use think\Controller;
use app\api\modle\Product as ProductModel;
class Product
{
    public function getRecent($count = 15)
    {
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);
        if($products->isEmpty())
        {
            throw new ProductException();
        }
       $products->hidden(['summary']);
        return json($products);
    }

    public function getAllPro($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $products = ProductModel::getProductsByCate($id);
        if($products->isEmpty())
        {
            throw new ProductException();
        }
        $products->hidden(['summary']);
        return json($products);
    }
    public function getOne($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $product =  ProductModel::getProductDetail($id);
        if(!$product)
        {
            throw new ProductException();
        }
        return $product;
    }
    public function deleteOne($id)
    {

    }

}
