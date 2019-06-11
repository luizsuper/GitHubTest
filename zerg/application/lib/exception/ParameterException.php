<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/17
 * Time: 9:57
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 404;
    public $msg = '非法请求参数';
    public $errorCode = 9000;

}