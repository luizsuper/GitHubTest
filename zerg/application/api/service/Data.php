<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/30
 * Time: 21:06
 */

namespace app\api\service;


class Data
{
    /*这个方法用于数组的方法组装cookies*/
    private function  makeUpCookies($array)
    {
        $kk ='';
        for($i = 0; $i<3; $i++)
        {
            if($i != 2)
                $kk = $kk.';'.$array[$i];
            else
                $kk = $array[$i].$kk;
        }
        return $kk;
    }
    /*这个方法用于将得到的请求通过正则表达式返回cookie*/
    public function getCookies($url)
    {
        //$mail = 'HTTP/1.1 200 OK Cache-Control: private Server: Microsoft-IIS/7.5 Set-Cookie: ASP.NET_SessionId=ivwqfk3ynj3gvxye1v4zspj0; path=/; HttpOnly X-AspNet-Version: 2.0.50727 Set-Cookie: user_name=MjAxNjAyNDE1NA%3d%3d; domain=222.171.146.29; expires=Mon, 18-Mar-2019 01:41:01 GMT; path=/ Set-Cookie: login_code=MQ%3d%3d; domain=222.171.146.29; expires=Mon, 18-Mar-2019 01:41:01 GMT; path=/ X-Powered-By: ASP.NET Date: Mon, 18 Mar 2019 00:41:01 GMT Content-Length: 0 ';  //邮箱地址
        $pattern1 = "/Set-Cookie:(.*);/Us";
        preg_match_all($pattern1, $url, $matches);
        $kkk = $matches[1];
        return   $this->makeUpCookies($kkk);
    }
}