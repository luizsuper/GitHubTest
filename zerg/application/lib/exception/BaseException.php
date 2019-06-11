<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/3/26
 * Time: 17:02
 */

namespace app\lib\exception;


use think\Exception;
use Throwable;

class BaseException extends Exception
{
    public $code;
    public $msg;
    public $errorCode;
    public function __construct($param = [])
    {

        if(!is_array($param))
        {
            return;
        }
        if(array_key_exists('code',$param))
        {
            $this->code = $param['code'];
        }
        if(array_key_exists('msg',$param))
        {
            $this->msg = $param['msg'];
        }
        if(array_key_exists('errorCode',$param))
        {
            $this->errorCode = $param['errorCode'];
        }

    }
}