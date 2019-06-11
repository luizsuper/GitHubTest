<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/3/26
 * Time: 19:43
 */

namespace app\lib\exception;


use think\Exception;

class IdException extends BaseException
{
    public $code = 404;
    public $msg = '必须是正整数';
    public $errorCode = 9000;
}