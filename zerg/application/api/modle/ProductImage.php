<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/18
 * Time: 15:01
 */

namespace app\api\modle;


class ProductImage
{
    protected $hidden = ['delete_time','img_id','product_id'];
    public function img()
    {
        return $this->belongsTo('Image','img_id','ids');
    }
}