<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/3/26
 * Time: 17:21
 */

namespace app\api\modle;


use think\Db;
use think\Exception;
use think\Model;

class Banner extends BaseModel
{
    public static function getBannerById($id)
    {
        $banner = self::with(['items','items.img'])->select($id);
        return $banner;
    }
    //模型关联处的知识点
    public function items()
    {
        return $this->hasMany('BannerItem','banner_id','id');
    }
    public function getProductDetail()
    {
        return 'success';
    }
}