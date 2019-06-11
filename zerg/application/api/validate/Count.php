<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/7
 * Time: 16:04
 */

namespace app\api\validate;


class Count extends BaseValidate
{
    protected $rule = ['count'=>'isInt|between:1,15'];
    protected $message = ['count.between:1,15'=>'范围错误'];

}