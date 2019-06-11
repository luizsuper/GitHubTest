<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/8
 * Time: 17:41
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
    public function getToken($code = '')
    {
        (new TokenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();
        $a = [
          'token'=>$token
        ];
        return json($a);
    }
    public function get()
    {

    }
}