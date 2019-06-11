<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/13
 * Time: 21:08
 */

namespace app\lib\exception;


class TokenException extends BaseException
{
    public $code = 401;
    public $msg = 'Token已过期，或无效';
    public $errorCode = 10001;
}