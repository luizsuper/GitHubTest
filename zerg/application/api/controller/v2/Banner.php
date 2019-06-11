<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/3/14
 * Time: 8:12
 */

namespace app\api\controller\v2;

use app\api\modle\BannerItem;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\BannerMissException;
use think\Model;
use think\Validate;
use app\api\modle\Banner as BannerM;
class Banner
{
    public function getBanner($id)
    {

       return $id;





    }

}