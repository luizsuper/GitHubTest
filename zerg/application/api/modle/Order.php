<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/18
 * Time: 20:22
 */

namespace app\api\modle;


class Order extends BaseModel
{
    protected $hidden=['update_time','delete_time','user_id'];
}