<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/3/14
 * Time: 8:12
 */

namespace app\api\controller\v1;

use app\api\modle\BannerItem;
use app\api\modle\Product;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\BannerMissException;
use think\Model;
use think\Validate;
use app\api\modle\Banner as BannerM;
use app\api\modle\Theme;
class Banner
{
    public function getBanner($id)
    {

        (new IDMustBePostiveInt())->goCheck();

         $banner = BannerM::getBannerById($id);

       if($banner->isEmpty())
        {
            throw new BannerMissException();
        }
        return json($banner);






    }

}