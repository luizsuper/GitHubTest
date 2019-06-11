<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/16
 * Time: 20:49
 */

namespace app\api\validate;


class AddressNew extends BaseValidate
{
    protected $rule = [
        'name'=>'require|isNotEmpty',  'mobile'=>'require|regex:/^[1]([3-9])[0-9]{9}$/',
        'province'=>'require|isNotEmpty',  'city'=>'require|isNotEmpty',  'country'=>'require|isNotEmpty',
        'detail'=>'require|isNotEmpty',
    ];
}