<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/3/17
 * Time: 18:18
 */

namespace app\api\validate;



use app\lib\exception\IdException;
use app\lib\exception\ParameterException;
use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{


   /* public $request;
    //public $rule = array();
    //public $msg = array();
   public function test($rule,$msg)
   {
       //$this->request = Request::instance();
      $this->rule = $rule;
      $this->message = $msg;

   }*/
   public function goCheck()
   {

       //$request = ;
       $param = Request::instance() ->param();
       //var_dump($this->rule);
       $result = $this->batch()->check($param);

       if (!$result)
       {

          $e = new IdException(
            ['msg'=>$this->error]
           );
           throw $e;
          // throw new Exception($this->error);
       }
          else{
               return true;
           }

   }
   protected  function  isInt($value,$rule='',$data='',$field='')
   {
       if(is_numeric($value) && is_int($value+ 0) && ($value + 0) > 0)
       {
           return true;
       }
       else
           {
               return false;
           }
   }
   protected function isNotEmpty($value,$rule='',$data='',$field='')
   {
       if(empty($value))
       {
           return false;
       }
       else
           {
               return true;
           }
   }
   public function getDataByRule($arrys)
   {
       if(array_key_exists('user_id',$arrys)|array_key_exists('uid',$arrys))
       {
            throw new ParameterException();
       }
       $newArray = [];
       foreach ($this->rule as $key => $value)
       {
            $newArray[$key] = $arrys[$key];
       }
       return $newArray;
   }
}