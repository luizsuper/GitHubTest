<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/13
 * Time: 20:40
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;
use think\Route;
use app\api\service\Token as TokenS;
class Token
{
    public static function generateToken()
    {
        //32个字符组成随机字符串
        $randChars = getRandChar(32);
        //用三组字符串进行md5加密
        $timestap = $_SERVER['REQUEST_TIME'];
        //yan
        $salt = config('secure.token_salt');
        return md5($randChars.$timestap.$salt);
    }
    public static function getCurrentUid()
    {
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }
    public static function getCurrentTokenVar($key)
    {
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);
        if(!$vars)
        {
            throw new TokenException();
        }
        else
            {
                if(!is_array($vars)){
                    $vars = json_decode($vars,true);
                }
                if(array_key_exists($key, $vars)) {

                    return  $vars[$key];
                }
                else {
                        throw new Exception('尝试获取的Token不存在');
                }
            }
    }
   public static function needPrimayScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if($scope)
        {
            if($scope >= ScopeEnum::User)
            {
                return true;
            }else
            {
                throw new ForbiddenException();
            }
        }
        else
        {
            throw new TokenException();
        }
    }
    public static function needExclusiveScope()
    {
        $scope = self::getCurrentTokenVar('scope');
        if($scope)
        {
            if($scope == ScopeEnum::User)
            {
                return true;
            }else
            {
                throw new ForbiddenException();
            }
        }
        else
        {
            throw new TokenException();
        }
    }
}