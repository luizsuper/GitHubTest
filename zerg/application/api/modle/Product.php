<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/4/11
 * Time: 9:23
 */

namespace app\api\modle;


class Product extends BaseModel
{
    protected $hidden = ['delete_time','pivot','category_id','img_id','create_time','update_time','from'];
    /*读取器读取完整路径*/
    public function getMainImgUrlAttr($value,$data)
    {
        $this->getUrl($value,$data);
        return $this->finalUr;
    }
    public static function getMostRecent($count=15)
    {
        $products = self::limit($count)->order('create_time desc')->select();
        return $products;
    }
    public static function getProductsByCate($id)
    {
        $products = self::where('category_id','=',$id)->select();
        return $products;

    }
    public function imgs()
    {
      return  $this->hasMany('ProductImage','product_id','id');
    }
    public function properties()
    {
       return $this->hasMany('ProductProperty','product_id','id');
    }
    public  static function getProductDetail($id)
    {
        //$product = self::with(['imgs.img','properties'])->find($id);
        $product = self::with(['imgs'=>function($query)
        {
            $query->with(['img'])->order('order','asc');
        }])
        ->with(['properties'])->find($id);
        return json($product);
    }
}