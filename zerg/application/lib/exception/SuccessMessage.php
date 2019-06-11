<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/17
 * Time: 9:32
 */

namespace app\lib\exception;


class SuccessMessage extends BaseException
{
    public $code = 201;
    public $msg = 'ok';
    public $errorCode = 0;
}