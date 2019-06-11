<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/7
 * Time: 19:32
 */

namespace app\api\modle;


class Category extends BaseModel
{
    protected $hidden =['delete_time','update_time'];
    public function img()
    {
        return $this->belongsTo('Image','topic_img_id','ids');
    }
}
