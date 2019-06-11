<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/17
 * Time: 9:20
 */

namespace app\api\modle;


class UserAddress extends BaseModel
{
    protected $hidden=['id','delete_time','user_id'];
}