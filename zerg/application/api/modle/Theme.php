<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/4/11
 * Time: 9:22
 */

namespace app\api\modle;


class Theme extends  BaseModel
{
    protected $hidden = ['delete_time','update_time','topic_img_id','head_img_id'];
    public function  topImg()
    {
        return $this->belongsTo('Image','topic_img_id','ids');
    }
    public function headImg()
    {
        return $this->belongsTo('Image','head_img_id','ids');
    }
    public function products()
    {

        return $this->belongsToMany('Product','theme_product','product_id','theme_id');


    }
    public  static function  getTheWithPro($id)
    {
       return self::with('products,headImg,topImg')->select($id);

    }
}