<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/10
 * Time: 9:00
 */

namespace  app\lib\exception;


use app\lib\exception\BaseException;

class WeChatException extends BaseException
{
    public $code = 404;
    public $msg = '微信调用异常';
    public $errorCode = 999;
}