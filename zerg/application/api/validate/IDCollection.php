<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/4/11
 * Time: 17:06
 */

namespace app\api\validate;


class IDCollection extends BaseValidate
{
    protected $rule = ['ids'=>'require|checkIDs'];
    protected $message = ['ids'=>'ids参数格式错误'];
    protected function checkIDs($value)
    {
        $values = explode(',',$value);
        if(empty($values))
        {
            return false;
        }
        foreach ($values as $id)
        {
            if(!($this->isInt($id)))
            {
                return false;
            }
        }
        return true;

    }

}