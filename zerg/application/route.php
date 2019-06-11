<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
Route::get('safeMath','sample/test/getsss');
Route::get('hello','sample/test/test');
Route::get('helloo','sample/test/baoli');
Route::get('hellooo','sample/test/shuxuejianMo');
Route::get('luiz','sample/ForTest/test');

Route::get('api/:v1/category/all','api/:v1.Category/getAllCategories');


Route::get('api/:v1/product/by_category','api/:v1.Product/getAllPro');
Route::get('api/:v1/product/recent','api/:v1.Product/getRecent');
Route::get('api/:v1/product/:id','api/:v1.Product/getOne',[],['id'=>'\d+']);


Route::get('api/:v1/Theme/:id','api/:v1.Theme/getProductDetail');
Route::get('api/:v1/banner/:id','api/:v1.Banner/getBanner');
Route::get('api/:v1/Theme','api/:v1.Theme/getList');
Route::get('kk/:uname/:psw','sample/test/cishu');
Route::get('byebye','sample/test/cishu');
Route::post('api/:v1/token/user','api/:v1.Token/getToken');

Route::post('api/:v1/address','api/:v1.Address/createOrUpdateAdress');

Route::post('api/:v1/order','api/:v1.Order/placeOrder');


Route::get('exam/:username/:psw','sample/test/getExamInfo');
Route::post('exam2','sample/win/login');
Route::get('asw','sample/win/asw');
Route::post('asw2','sample/win/get');
Route::get('ckx','sample/luiz/win');
Route::get("ckx1/:username/:psw",'sample/luiz/win');

