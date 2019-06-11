<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/8
 * Time: 17:47
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\modle\User as UserModel;

class UserToken extends Token
{

    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code)
    {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(config('wx.login_url'),$this->wxAppID,$this->wxAppSecret,$this->code);
    }

    public function get()
    {
       $result = curl_get($this->wxLoginUrl);
       $wxResult = json_decode($result,true);
       if(empty($wxResult))
       {
           throw new Exception('获取open_id一场');
       }
       else
           {
               $loginFail = array_key_exists('errcode',$wxResult);
               if($loginFail)
               {
                   $this->processLoginError($wxResult);
               }
               else
                   {
                       return $this->grantToken($wxResult);
                   }
           }
    }
    private function processLoginError($wxResult)
    {
       throw new WeChatException([
            'msg' =>$wxResult['errmsg'],
            'errorCode'=>$wxResult['errcode']
        ]);
    }
    private function prepareCachedValue($wxResult,$uid)
    {
        $cachedValue =  $wxResult;
        $cachedValue['uid'] = $uid;
        $cachedValue['scope'] = ScopeEnum::User;
        return $cachedValue;
    }
    private function grantToken($wxResult)
    {
        //得到openID
        //拿到数据库看一下，这个openid是否已存在
        //如果存在，则不处理，如果不存在，则新增一条user记录
        //生成令牌，准备缓存数据，写入缓存
        //把令牌返回到客户端
        $openid = $wxResult['openid'];
        $user = UserModel::getByOpenId($openid);
        if($user)
        {
            $uid = $user->id;
        }
        else
            {
               $uid = $this->newUser($openid);
            }
        $chachedValue = $this->prepareCachedValue($wxResult,$uid);
        $tokenKey = $this->saveToCache($chachedValue);
        return $tokenKey;
    }
    private function saveToCache($cacheVlue)
    {
        $key =  self::generateToken();
        $value = json_encode($cacheVlue);
        //设置缓存过期时间，在extra下面有
        $expire_in = config('setting.token_expire_in');
        $result = cache($key,$value,$expire_in);
        if(!$result)
        {
            throw new TokenException([
                'msg'=>'服务器缓存异常',
                'errorCode'=>10005
            ]);
        }
        return $key;
    }


    private function newUser($openid){
        $user = UserModel::create([
            'openid'=>$openid
        ]);
        return $user->id;
    }
}