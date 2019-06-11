<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/3/19
 * Time: 13:19
 */

namespace app\sample\controller;


class ForTest
{

    public  $arr;
    public $cleanArray;
    function test()
    {

        $cleanArray= array(858,859,860,861,862,863,864,866,715,731,732,733,734,735,747,748,750,751,752,753,754,755,847,848,850,851,852,853,854,855,865,867,868,869,870,721,722,723,724,725,726,727,728,729,871,872,873,874,875,877,895,896,897,744,806,807,808,893,812,834,835,836,837,838,839,841,748,785,786,787,844,888,889,890,891,892,878,879,880,881,882,883,884,885,886,840
    );
        $arr = array('courseName'=>'sss','courseId'=>1);
        $json = json_encode($arr,JSON_UNESCAPED_UNICODE);
        $numbytes = file_put_contents('config.json', $json); //如果文件不存在创建文件，并写入内容



        if($numbytes){


            $res = (file_get_contents('config.json'));

            return $res;



        }else{
            echo '写入失败或者没有权限，注意检查';
        }

    }
}