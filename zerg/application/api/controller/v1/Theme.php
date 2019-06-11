<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/4/11
 * Time: 9:22
 */

namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\ThemeException;
use think\Controller;
use app\api\modle\Theme as ThemeModel;
use think\response\Json;

class Theme extends Controller
{
    public $kk = 1;
    public function getList($ids='')
    {
        (new IDCollection())->goCheck();
        $ids = explode(',',$ids);
        $result = ThemeModel::with('topImg,headImg')->select($ids);
        if($result->isEmpty())
        {
            throw  new ThemeException();
        }

        return json($result);

    }

    /**
     * @param $id
     * @return string
     * @url http://localhost/api/v1/Theme/:id
     * 商品详情
     */
    public function getProductDetail($id)
    {
        (new IDMustBePostiveInt())->goCheck();
        $theme = ThemeModel::getTheWithPro($id);
        if($theme->isEmpty())
        {
            throw new ThemeException();
        }
       // $kk = $theme->column('Product');
        $theme->hidden(['main_img_url']);
        return json($theme);
    }
}
