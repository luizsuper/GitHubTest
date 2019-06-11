<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/7
 * Time: 19:30
 */

namespace app\api\controller\v1;
use app\api\modle\Category as CategoryModel;
use app\lib\exception\CateException;

class Category
{
    public function getAllCategories()
    {
        $cat = CategoryModel::all([],'img');
        if($cat->isEmpty())
        {
            throw  new CateException();
        }
        return json($cat);
    }

}