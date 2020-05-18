<?php
declare (strict_types = 1);

namespace app\controller\v1;


use app\BaseController;
use app\model\UserModel;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use think\facade\Cache;


class Login extends BaseController
{

    //用户登录


    public function register()
    {

    }

    private function getCache(string $keys, string $username)
    {
        $result = Cache::store('redis')->get($keys . $username);

        if ($result == null) {
            $result = (new UserModel())->where(['username' => $username])->find();
            if ($result != null) {
                //不是空的值就缓存
                Cache::store('redis')->set($keys . $username, $result, config('apicanche.user.expire'));


            }
        }
        return $result;
    }

}