<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/7
 * Time: 19:47
 */

namespace app\lib\exception;


class CateException extends BaseException
{
    public $code = 404;
    public $msg = '商品种类问题';
    public $errorCode = 9000;
}