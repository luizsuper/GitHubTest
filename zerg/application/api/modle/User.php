<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/8
 * Time: 17:45
 */

namespace app\api\modle;


class User extends BaseModel
{

    public function  address()
    {
        return $this->hasOne('UserAddress','user_id','id');
    }
    public static function getByOpenId($openid)
    {
        $user = self::where('openid','=',$openid)->find();
        return $user;
    }

}