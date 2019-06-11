<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/4/11
 * Time: 8:40
 */

namespace app\api\modle;


use think\Model;

class BaseModel extends  Model
{
    protected  $finalUr;
    protected  function getUrl($value,$date)
    {
        $this->finalUr = $value;
        if($date['from'] ==1)
        {
            $this->finalUr = config('setting.img_url').$value;
        }

    }

}