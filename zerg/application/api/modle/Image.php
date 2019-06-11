<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/4/10
 * Time: 22:46
 */

namespace app\api\modle;


use think\Model;

class Image extends BaseModel
{
    protected $hidden =['id','from','delete_time','update_time','ids'];
    public function getUrlAttr($value,$data)
    {
        $this->getUrl($value,$data);
        return $this->finalUr;
    }
}