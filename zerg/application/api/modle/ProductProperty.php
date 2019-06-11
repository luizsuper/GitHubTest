<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/16
 * Time: 11:50
 */

namespace app\api\modle;


class productProperty extends BaseModel
{
    protected $hidden = ['delete_time','product_id','id'];
}