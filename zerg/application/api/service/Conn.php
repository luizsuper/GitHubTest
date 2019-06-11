<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/30
 * Time: 21:02
 */

namespace app\api\service;


class Conn
{

    public function getConnData($username,$md5)
    {//初始化
        $md5 = md5($md5);
        $curl1 = curl_init();
        //设置抓取的url
        curl_setopt($curl1, CURLOPT_URL, 'http://lc.usth.net.cn/G2S/ShowSystem/Login.ashx?');
        //设置头文件的信息作为数据流输出
        curl_setopt($curl1, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
        //设置post方式提交
        curl_setopt($curl1, CURLOPT_POST, 1);
        //设置post数据
        $post_data = array(
            "LoginName" => $username,
            "Password" => $md5,
            "action"=>"GetUserLoginInfo"
        );
        curl_setopt($curl1, CURLOPT_POSTFIELDS, $post_data);

        //执行命令
        $data = curl_exec($curl1);
        //关闭URL请求
      //curl_close($curl1);
        //显示获得的数据
        return $data;
    }


    /*我的空间主页*/
    public function getIndex($cookies)
    {
        $cc = $cookies;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://lc.usth.net.cn/G2S/MySpace/IndexStudent.aspx');
        $header = array();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_COOKIE,$cc);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_REFERER,'http://lc.usth.net.cn/G2S/MySpace/IndexStudent.aspx');

        $content = curl_exec($ch);
        //curl_close($ch);
        return $content;
    }
    public function getMySpace($cookies)
    {
        $cc = $cookies;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://lc.usth.net.cn/G2S/MySpace/MySpace.aspx');
        $header = array();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_REFERER,'http://lc.usth.net.cn/G2S/MySpace/MySpace.aspx');
        curl_setopt($ch,CURLOPT_HEADER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_COOKIE,$cc);
        $content = curl_exec($ch);
        return $content;
    }
    public function saveKey($cookies)
    {
        $cc = $cookies;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://lc.usth.net.cn/G2S/StatHandler.ashx?action=SaveUserVisit&UserVisitKey=1&random=0.45871699994389115');
        $header = array();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_REFERER,'http://lc.usth.net.cn/G2S/MySpace/MySpace.aspx');
        curl_setopt($ch,CURLOPT_HEADER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_COOKIE,$cc);
        $content = curl_exec($ch);
        return $content;
    }
    public function getExam($cookies)
    {
        $cc = $cookies;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://lc.usth.net.cn/G2S/MySpace/IndexStudent.aspx');
        $header = array();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HEADER,true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_REFERER,'http://lc.usth.net.cn/G2S/StudentSpace/Index.aspx');
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_COOKIE,$cc);
        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }
    public function ImBest($cookies)
    {
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, 'http://lc.usth.net.cn/G2S/MySpace/IndexStudent.aspx');
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //发送cookie
        curl_setopt($curl, CURLOPT_COOKIE, $cookies);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_REFERER,'http://lc.usth.net.cn/G2S/StudentSpace/Index.aspx');
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        $post_data =  array(
            "ctl00\$ContentPlaceHolder1\$UCStudentCourse1\$btnGoStudentWebsite"=>"Button",
            "ctl00\$ContentPlaceHolder1\$UCStudentCourse1\$hidWebSiteID" => '315',
            "__VIEWSTATE"=>"/wEPDwUKLTg1MjcyMTMzMQ9kFgJmD2QWAgIDD2QWAgICD2QWBgIBD2QWEmYPDxYEHghDc3NDbGFzcwUPbWFzdGVyX25hdmhvdmVyHgRfIVNCAgIWAh4Hb25jbGljawU1d2luZG93LmxvY2F0aW9uLmhyZWY9Jy9HMlMvTXlTcGFjZS9JbmRleFN0dWRlbnQuYXNweCdkAgEPD2QWAh8CBRRDaGVja0NsYXNzKDUyNzg2LDIpO2QCAg8PZBYCHwIFSHdpbmRvdy5sb2NhdGlvbi5ocmVmPScvRzJTL015U3BhY2UvUmVzb3VyY2VTaGFyaW5nU3R1L1NoYXJlRXhwbG9yZS5hc3B4J2QCAw8PZBYCHwIFQ3dpbmRvdy5sb2NhdGlvbi5ocmVmPScvRzJTL1N0dWRlbnRTcGFjZS9BZGRyZXNzQm9vay9NeUFkZHJlc3MuYXNweCdkAgQPDxYCHgdWaXNpYmxlaGRkAgUPD2QWAh4Fc3R5bGUFDWRpc3BsYXk6bm9uZTtkAggPDxYCHwNoZGQCCQ8PFgIfA2hkZAIMDxYCHglpbm5lcmh0bWwFATBkAgUPFgIfA2gWAgIBD2QWBGYPPCsACgEADxYCHgJTRBYBBgDAxV1z59aIZGQCAQ8WAh4FdmFsdWUFBuivpue7hmQCCQ8WAh8DaGRkl5sVxwX9lfOeEndl8RU2ZTulQFU=",
        );
       // $post_dat = array("1"=>"1");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
       // curl_setopt($curl,CURLOPT_POSTFIELDS,$post_dat);

        //执行命令
       $context = curl_exec($curl);
        return $context;
    }
    public function saygoodBye($kk,$cookies)
    {
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, 'http://lc.usth.net.cn/G2S/StudentSpace/Exam/Examing.aspx?ID=3386');
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //发送cookie
        curl_setopt($curl, CURLOPT_COOKIE, $cookies);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_REFERER,'http://lc.usth.net.cn/G2S/StudentSpace/Exam/Examing.aspx?ID=3386');
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        $post_data = array();
        for($i = 0 ; $i < count($kk) ; $i++)
        {
            $post_data = ["hidQuestionIndex"=>$kk[$i]];
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        }

        $context = curl_exec($curl);
        curl_close($curl);
        return $context;
    }
    public function ImBestt($cookies)
    {
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, 'http://lc.usth.net.cn/G2S/StudentSpace/Exam/Examing.aspx?ID=3386');
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //发送cookie
        curl_setopt($curl, CURLOPT_COOKIE, $cookies);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 7200);
        curl_setopt($curl, CURLOPT_REFERER,'http://lc.usth.net.cn/G2S/StudentSpace/Exam/Examing.aspx?ID=3386');
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        $post_data = array();
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $context = curl_exec($curl);
       // curl_close($curl);
        return $context;
    }
}