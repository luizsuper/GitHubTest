<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/8
 * Time: 17:34
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
    protected $rule = ['code'=>'require|isNotEmpty'];
    protected $message = ['code'=>'没有code好像获取token，做梦嗷'];
}