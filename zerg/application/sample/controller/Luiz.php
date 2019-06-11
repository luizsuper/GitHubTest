<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/6/3
 * Time: 9:23
 */

namespace app\sample\controller;
use app\api\service\Conn;
use app\api\service\Data;
use app\api\service\Exam;

class Luiz
{
    public function win($username,$psw)
    {
        $conn = new Conn();
        $data = new Data();
        $cookies = $data->getCookies( $conn->getConnData($username,$psw));
        $conn->ImBest($cookies);
        //获取用户的题目
        $context = $conn->ImBestt($cookies);
        $Exam= new Exam();
        $search_array = $Exam->getExamSession($context,"/divQuestionIndexItem\_(.*)\w(\d{1,})\" /Us");
        $null_array = $Exam->getNull($search_array);
        $arraySingle = $Exam->getSingle($null_array);
        $arrayAnswer = $Exam->getUu($arraySingle,$context);
        $arrayQue =  $Exam->getU($arraySingle,$context);
        $arrayMix = $Exam->Mix($arrayAnswer,$arrayQue);
        $arrayType = $Exam->getTypes($arraySingle,$context);
        try {
            $Exam->in($arrayMix,$arrayType,$null_array);
        } catch (Exception $e)
        {
            return json(["msg"=>"再点击一次按钮"]);
        }
        $kk = $Exam->getAll($search_array);
        $cleanTypes = $Exam->cleanTypes($kk);
        $moon = $Exam->makeMoon($kk);
        $UserVisitPostUrl = $Exam->getExamSession($context,"/id=\"UserVisitPostUrl\" value=\"(.*)\"/Us")[0];
        $UserVisitKey = $Exam->getExamSession($context,"/id=\"UserVisitKey\" value=\"(.*)\"/Us")[0];
        $hLoginDataTime = $Exam->getExamSession($context,"/id=\"hLoginDataTime\" value=\"(.*)\"/Us")[0];
        $hidWebID = $Exam->getExamSession($context,"/id=\"hidWebID\" value=\"(.*)\"/Us")[0];
        $__VIEWSTATE = $Exam->getExamSession($context,"/id=\"__VIEWSTATE\" value=\"(.*)\"/Us")[0];
        $hidExamID = $Exam->getExamSession($context,"/id=\"hidExamID\" value=\"(.*)\"/Us")[0];
        $home_hidExamID = $Exam->getExamSession($context,"/id=\"DoHomework1_hidExamID\" value=\"(.*)\"/Us")[0];
        $hidSource = $Exam->getExamSession($context,"/id=\"DoHomework1_hidSource\" value=\"(.*)\"/Us")[0];
        $home_hidStudentID = $Exam->getExamSession($context,"/id=\"DoHomework1_hidStudentID\" value=\"(.*)\"/Us")[0];
        $home_hidWebID = $Exam->getExamSession($context,"/id=\"DoHomework1_hidWebID\" value=\"(.*)\"/Us")[0];
        $hidUserID = $Exam->getExamSession($context,"/id=\"hidUserID\" value=\"(.*)\"/Us")[0];

     /*   return json( ["moon"=>$moon,"UserVisitPostUrl"=>$UserVisitPostUrl,"UserVisitKey"=>$UserVisitKey,
            "hLoginDataTime"=>$hLoginDataTime,"hidWebID"=>$hidWebID,"__VIEWSTATE"=>$__VIEWSTATE,
            "hidExamID"=>$hidExamID,"home_hidExamID"=>$home_hidExamID,"hidSource"=>$hidSource,"home_hidStudentID"=>$home_hidStudentID,
            "home_hidWebID"=>$home_hidWebID,"hidUserID"=>$hidUserID,"Types"=>$cleanTypes
        ]);*/
       $Exam->saveTample($hidWebID,$home_hidStudentID,$hLoginDataTime,$moon,$cookies);
       return $this->ImBest($cookies,$UserVisitKey,$UserVisitPostUrl,$__VIEWSTATE,$hidExamID,$hidWebID,$hLoginDataTime,$moon,$home_hidExamID,$hidSource,
            $home_hidStudentID,$home_hidWebID,$hidUserID
        );
    }
    public function ImBest($cookies, $UserVisitKey,$UserVisitPostUrl,$__VIEWSTATE, $hidExamID,$hidWebID, $hLoginDataTime, $moon, $home_hidExamID
    ,$hidSource,$hidStudentID,$home_hidWebID,$hidUserID
    )
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
        curl_setopt($curl, CURLOPT_TIMEOUT, 40);
        curl_setopt($curl, CURLOPT_REFERER,'http://lc.usth.net.cn/G2S/StudentSpace/Exam/Examing.aspx?ID=3386 ');
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        $post_data =  array(
            "UserVisitKey"=>$UserVisitKey,
            "UserVisitPostUrl" => $UserVisitPostUrl,
            "__VIEWSTATE"=>$__VIEWSTATE,
            "hidExamID"=>$hidExamID,
            "hidWebID"=>$hidWebID,
            "hLoginDataTime"=>$hLoginDataTime,
            "DoHomework1\$hidStudentAnswer"=>$moon,
            "DoHomework1\$hidExamID"=>$home_hidExamID,
            "DoHomework1\$hidSource"=>$hidSource,
            "DoHomework1\$hidStudentID"=>$hidStudentID,
            "DoHomework1\$hidWebID"=>$home_hidWebID,
            "hidUserID"=>$hidUserID,
            "btnSubmit"=>"Button"
        );
        // $post_dat = array("1"=>"1");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        // curl_setopt($curl,CURLOPT_POSTFIELDS,$post_dat);
        //执行命令
        $context = curl_exec($curl);
        return $context;
    }
}