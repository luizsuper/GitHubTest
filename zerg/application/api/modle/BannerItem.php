<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/4/9
 * Time: 18:28
 */

namespace app\api\modle;


use think\Model;

class BannerItem extends BaseModel
{
    public function img()
    {
        return $this->belongsTo('Image','img_id','ids');
    }
}