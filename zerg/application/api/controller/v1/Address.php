<?php
/**
 * Created by PhpStorm.
 * User: luiz
 * Date: 2019/5/16
 * Time: 20:33
 */

namespace app\api\controller\v1;


use app\api\controller\BaseConitroller;
use app\api\validate\AddressNew;
use app\api\service\Token as TokenS;
use app\api\modle\User as UserModel;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\SuccessMessage;
use app\lib\exception\TokenException;
use app\lib\exception\UserException;
use think\Controller;

class Address extends BaseConitroller
{
    /**
     * @throws SuccessMessage
     * @throws UserException
     * @throws \app\lib\exception\IdException
     * @throws \app\lib\exception\ParameterException
     * @throws \think\exception\DbException
     */
    protected $beforeActionList = [
        'checkPrimaryScope'=>['only'=>'createOrUpdateAdress']
    ];

    public function createOrUpdateAdress()
    {

        $validate = new AddressNew();
        $validate ->goCheck();
        //根据token获取uid
        //根据uid来查找用户数据，判断用户是否存在，如果不存在抛出异常
        //获取用户从客户端传来的地址信息
        //看是否存在决定是否添加地址还是更新地址
        $uid = TokenS::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user)
        {
            throw new UserException();
        }
        $dataArray = $validate->getDataByRule(input('post.'));
        $userAddress = $user->address;
        if(!$userAddress)
        {
            $user->address()->save($dataArray);
        }
        else
            {
                $user->address->save($dataArray);
            }
       throw new SuccessMessage();
    }
}