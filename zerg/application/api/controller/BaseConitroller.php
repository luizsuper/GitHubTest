<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/18
 * Time: 13:01
 */

namespace app\api\controller;


use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;
use think\Controller;
use app\api\service\Token as TokenS;
class BaseConitroller extends Controller
{
    protected function checkPrimaryScope()
    {
      TokenS::needPrimayScope();

    }
    protected function checkExclusiveScope()
    {
        TokenS::needExclusiveScope();
    }
}