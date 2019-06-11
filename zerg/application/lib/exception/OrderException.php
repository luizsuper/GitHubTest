<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/18
 * Time: 14:41
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在';
    public $errorCode = 80000;
}