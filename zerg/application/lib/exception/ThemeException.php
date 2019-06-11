<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/4/11
 * Time: 22:14
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在';
    public $errorCode = 30000;
}