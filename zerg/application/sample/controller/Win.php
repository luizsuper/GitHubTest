<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/3/18
 * Time: 3:00
 */

namespace app\sample\controller;



use app\api\modle\Que;
use app\api\service\Conn;
use app\api\service\Exam;
use think\Controller;
use think\Exception;

class Win extends Controller
{

   public function login($context)
   {

       $Exam = new Exam();
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
        $k = $Exam->getAll($search_array);
       $finally = $Exam->sendPostArray($k,$context);
        return json($finally);
   }
   public function asw()
   {
       $k =  Que::where('asw','null')->select()->toArray();
       return json($k);
   }
    public function get()
    {
        $que = new Que();
        $formCon = $this->request->post();
        foreach ($formCon as $key => $value)
        {
            if(is_array($value))
            {
                $k ='';
                for($i = 0 ; $i < sizeof($value); $i++)
                {
                    if($i != (sizeof($value) - 1))
                    {
                       $k .= $value[$i].','
;                    }
                    else
                        {
                            $k .= $value[$i];
                        }
                }
                $que->update(['que_no' => $key, 'asw' => $k]);
            }
            else{
                $que->update(['que_no' => $key, 'asw' => $value]);
            }

        }
        return '保存成功';
    }

}