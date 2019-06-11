<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/22
 * Time: 11:39
 */

namespace app\api\service;


use app\api\modle\Que;

class Exam
{
    private  $k = [];
    public  function getExamSession($url,$pattern1)
    {
        preg_match_all($pattern1, $url, $matches);
        $kkk = $matches[1];
       // echo 1;
        //$CleanArray = $this->cleanArray;
        return   $kkk;
    }
    public function saveTample($web_id,$uid,$hltime,$info)
    {

        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, 'http://lc.usth.net.cn/G2S/StudentSpace/Exam/ExamService.ashx');
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 1);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //发送cookie
        //curl_setopt($curl, CURLOPT_COOKIE, $cookies);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 40);
        curl_setopt($curl, CURLOPT_REFERER,'http://lc.usth.net.cn/G2S/StudentSpace/Exam/ExamService.ashx');
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //设置post数据
        $post_data =  array(
            "OptType"=>"SaveTemplateAnswer",
            "ID" => 3386,
            "uid"=>$uid,
            "hltime"=>$hltime,
            "info"=>$info
        );
        // $post_dat = array("1"=>"1");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        //执行命令
        $context = curl_exec($curl);
        return $context;

    }
    /*public static function makeNum($array)
    {
        $arryNew = [];
        for($i = 0; $i < count($array); $i++)
        {
            $arryNew[$i] = '2633_'.$array[$i];
        }
        return $arryNew;
    }*/
    public function paixu($array)
    {
        sort($array);
        return $array;
    }/*将不存在的数组存入数据库*/
    public  function getNull($arrayPost)
    {
        $s = [];
        $this->k = Que::all($arrayPost)->toArray();
        //Exam::getNull($k);
        for($i = 0; $i < count($this->k); $i++)
        {
                $s[] =  $this->k[$i]['que_no'];
        }
        $result = array_diff($arrayPost,$s);
        //$result = $s;
      return array_values($result);
    }
    public function sendPostArray($array_win,$context)
    {

        $win = [];
        for($i = 0; $i < count($array_win); $i++)
        {

           $wt = $array_win[$i]['asw'];
           if($wt == null)
           {
               $win[$i] = '?';
           }
           else
               {
                   $a = explode(",",$wt);
                   $ss ='';
                   for($k = 0 ; $k < count($a) ; $k++)
                   {
                       ;
                       $wtt = $this->getExamSession($context,"/_".$a[$k]."\">(\w)./Us");
                       if($k < (count($a) - 1))
                       {
                           $ss .= $wtt[0].',';
                       }else
                           {
                               $ss .= $wtt[0];
                           }
                       $win[$i] = $ss;
                   }
               }

        }
        return $win;
       // $this->getExamSession($context,"/_1888167\">(\w)./Us");
    }
    //按照题目顺序将各种需要的都返回
    public function getAll($arrayPost)
    {
        $que = new Que();
        $arrayIwant = [];
        for($i = 0; $i < count($arrayPost); $i++)
        {
            $whatever = $que->where('que_no',$arrayPost[$i])->find()->toArray();
            $arrayIwant[$i] = $whatever;
        }

        return $arrayIwant;
    }
    public function cleanTypes($arrayClean)
    {
        $cleanTypes = [];
        for($i = 0; $i < count($arrayClean); $i++)
        {
            $cleanTypes[$i] = $arrayClean[$i]['type1'];
        }
        return $cleanTypes;
    }

    public function makeMoon($kk)
    {

        $q = "♂\$♀AA@&☆";
        $a = "♂\$♀QQ@&☆";
        $moon = '';
        for($i = 0; $i < count($kk); $i++)
        {
            if($i < (count($kk) - 1))
            {
                $moon.=$this->getValueNum($kk[$i]['que_no']).$q.$kk[$i]['asw'].$a;
            }
            else
                {
                    $moon.=$this->getValueNum($kk[$i]['que_no']).$q.$kk[$i]['asw'];
                }
        }

        return $moon;
    }
    public function getK()
    {
       return $this->k;
    }

    public  function in($arrayMix,$arrayType,$arrayNum)
    {
        $user = new Que();
        $list = [

        ];
        $i = 0;
        foreach ($arrayMix as $key => $value)
        {
            $list[$i] = ['detail1'=>$key,'choice'=>json_encode($value),'type1'=>$arrayType[$i],'que_no'=>$arrayNum[$i]];
            $i++;
        }
        $user->saveAll($list,false);
    }
    /*后台调取空数组将其发送到答题界面*/
    /*public static  function getAsw()
    {

        $user = new Que();
        $list = [

        ];
        $i = 0;
        foreach ($arrayMix as $key => $value)
        {
            $list[$i] = ['detail'=>$key,'choice'=>json_encode($value),'type'=>$arrayType[$i],'que_no'=>$arrayNum[$i]];
            $i++;
        }
        $user->saveAll($list,false);
    }*/

    public  function getValueNum($sss)
    {
      $k = explode('_',$sss,2);
      return $k[1];
    }
    public  function getSingle($array)
    {
        $kk = [];
        foreach ($array as $key => $value)
        {
            $k = explode('_',$value,2);
            $kk[$key] = $k[1];
        }
        return $kk;
    }

    public  function getTypes($array,$url)
    {
        $kk = [];
        foreach ($array as $key => $value)
        {
            $pattern = "/id=\"hidQuestionType_".$array[$key]."\" value=\"(.*)\"/Us";
            $kk[$key] = $this->getExamSession($url,$pattern)[0];

        }
        return $kk;
    }

    public  function getValues($array,$url)
    {
        $kk = [];
        foreach ($array as $key => $value)
        {
           // $pattern = "/id=\"hidQuestionType_".$array[$key]."\" value=\"(.*)\"/Us";
            $pattern = "/chkChoiceItem_".$array[$key]."_(.*)\"/Us";
            $kk[$key] = $this->getExamSession($url,$pattern)[0];

        }
        return $kk;
    }
    public  function getU($array,$url)
    {
        $kk = [];
        foreach ($array as $key => $value)
        {
            // $pattern = "/id=\"hidQuestionType_".$array[$key]."\" value=\"(.*)\"/Us";
            $pattern = "/id=\"hidQuestionType_".$array[$key]."\" value=\"\d{1,2}\" name=\"hidQuestionType\" \/><div class=\"Width960 BottomLineTitle HideOverflow ClearBoth\">\d{1,2}. (.*)</Us";
            $kkk =  $this->getExamSession($url,$pattern);
            if($kkk!=null)
            {
                $kk[$key] = $kkk[0];
            }
        }
        return $kk;
    }

    public  function getUu($array,$url)
    {
        $kk = [];
        foreach ($array as $key => $value)
        {
            // $pattern = "/id=\"hidQuestionType_".$array[$key]."\" value=\"(.*)\"/Us";
            $pattern = "/for=\"chkChoiceItem_".$array[$key]."_(.*)</Us";
            $kkk =  $this->getExamSession($url,$pattern);

            if($kkk!=null)
            {
                foreach ($kkk as $key1 => $value1)
                {
                    $kkk[$key1] = $this->getCleanChoice($value1);
                }
                $kk[$key] = $kkk;
            }
        }
        return $kk;
    }
    private  function getCleanChoice($need)
    {

        $k = preg_split("/\">\w./",$need);
        return $k;

    }
    public  function Mix($arrayAsw,$arrayQue)
    {
        $array=[];
        foreach ($arrayQue as $key => $value)
        {
           $array[$value] = $arrayAsw[$key];
        }
        return $array;
    }


}