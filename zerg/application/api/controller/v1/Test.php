<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/3/15
 * Time: 10:49
 */

namespace app\api\controller\v1;


class Test
{
    public function archive($year='2016',$month='01')
    {
        return 'year='.$year.'&month='.$month;

    }
}