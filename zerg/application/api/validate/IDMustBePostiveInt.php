<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/3/14
 * Time: 21:39
 */

namespace app\api\validate;


use think\Validate;

class IDMustBePostiveInt extends BaseValidate
{


    protected $rule = [
        //'id' => '^[0-9]\d*$',
        'id'=>'require|isInt'
    ];
    protected  $message = ['id.isInt'=>'参数必须是正整数','id.require'=>'参数缺少'];
   // protected $message = ['id.^[0-9]\d*$'=>'必须是正整数'];
  //  protected  $message = ['isInt'=>'必须是正整数'];
}