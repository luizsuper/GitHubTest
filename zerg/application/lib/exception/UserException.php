<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/17
 * Time: 9:13
 */

namespace app\lib\exception;


use app\api\validate\BaseValidate;

class UserException extends  BaseException
{
    public $code = 404;
    public $message = '用户不存在';
    public $errorCode = 60000;
}