<?php
declare (strict_types = 1);

namespace app\controller\v1;


use app\controller\Base;
use app\model\UserModel;
use app\Request;
use app\validate\UserValidate;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use think\facade\Cache;

class User extends Base
{

    public function login(Request $request)
    {
        $nowTime = time();

        $username = $request->param('username');

        $password = $request->param('password');

        $password = openssl_decrypt(base64_decode($password), "AES-128-CBC", config('apicanche.key'), OPENSSL_RAW_DATA, config('apicanche.iv'));

        $validate = new UserValidate();

        $result = $validate->scene('login')->check(compact('username','password'));

        if (!$result) {

            return json($validate->getError());
        }

        //获取当前用户信息以便核实
        $user = (new UserModel())->where(['username'=>$username])->find();

        //判断密码正确和禁止登陆
        if (empty($user)) {
            $data['code'] = config('apicanche.erro');
            $data['message'] = '账号或密码错误';
            return json($data);
        } else if ($user['password'] != md5($password)) {
            $data['code'] = config('apicanche.erro');
            $data['message'] = '账号或密码错误';
            return json($data);
        } else if ($user['status'] == 2) {
            $data['code'] = config('apicanche.erro');
            $data['message'] = '账号禁止登录';
            return json($data);
        }
        //生成token
        $signer = new Sha256();
        //设置header和payload，以下的字段都可以自定义
        $Builder = (new Builder())->setIssuer('www.llgj.vip')//发布者
        ->setAudience('www.llgj.vip')//接收者
        ->setId("4f1g23a12aa", true)//对当前token设置的标识
        ->setIssuedAt($nowTime)//token创建时间
        ->setExpiration($nowTime + config('apicanche.login.expire'))//过期时间
        ->setNotBefore($nowTime)//当前时间在这个时间前，token不能使用
        ->set('uid', $user['id'])//自定义数据
        ->set('username', $user['username']) //自定义数据
        ->sign($signer, config('apicanche.secret'))//设置签名
        ->getToken();
        $token['token'] = (string)$Builder;//获取加密后的token，转为字符串

        //更新用户一些信息到缓存 以便使用
        $user->token = md5($token['token']);
        $user->update_time=date('Y-m-d H:i:s');
        $user->allowField(['token'])->save();



        //获取过期时间
        $data = [
            'code' => config('apicanche.succeed'),
            'token' => $token['token'],
            'message' => '登入成功!',
            'exp' => $nowTime + config('apicanche.login.expire'),
        ];
        return json($data);

    }
    public function register(Request $request)
    {

    }

    public function getInfo(){

        $result = (new UserModel())->where(['id'=>$this->uid])->find();
        $data = [
            'code' => config('apicanche.succeed'),
            'result' => $result
        ];


        return json($data);
    }
}