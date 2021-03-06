<?php
declare (strict_types = 1);
namespace app\controller;


use app\BaseController;
use app\model\UserModel;
use \Lcobucci\JWT\Parser;
use \Lcobucci\JWT\Signer\Hmac\Sha256;
use think\facade\Cache;

class Base extends BaseController
{
    //用户的UID
    public  $user_id;
    //用户名
    public  $username;
    //角色权限
    public $roles;


    //配置数据
//    public $webConfg;
    //当前数据执行时间
//    public int $nowTime;

    public function initialize()
    {
//        //redis缓存
//        $this->redis = Cache::store('redis')->handler();
        //获取执行时间1
//        $this->nowTime = time();
//
//        //读取网站配置
//        $this->webConfg = Cache::store('redis')->get('db_config_data');
//        if (!$this->webConfg) {
//            $config = load_config();
//            Cache::store('redis')->set('db_config_data',$config,config('code.time'));
//            $this->webConfg = $config;
//        }

//        //不验证token控制器
        $action = Request()->action();

//        $controller = Request()->controller();
//        dump($action);
//        dump(stripos('login logout',$action));
        if(stripos('login logout register',$action) !== false ){
            return;
        }

//        header('Access-Control-Allow-Origin: '.'*');
//        header('Access-Control-Allow-Credentials: true');
//        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
//        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

//        if(request()->isOptions())  exit();
//
//        dump(request()->header());







//        获取token
        $token = request()->header('Authorization') ??'';
//        $token = input('token');
        $data['code'] = config('apicanche.login.erro');
        if (!$token) {
            $data['message'] = '温馨提示:请登录后查看';
            throw new \think\exception\HttpException(200, $data['message'],null,[],$data['code']);
//            throw new \Swoole\ExitException(json_encode($data));

        }

        $parse = (new Parser())->parse($token);
        $signer  = new Sha256();
        //验证token合法性
        if (!$parse->verify($signer, config('apicanche.secret'))) {
            $data['message'] = '温馨提示:请登录后查看';
            throw new \think\exception\HttpException(200, $data['message'],null,[],$data['code']);
//            throw new \Swoole\ExitException(json_encode($data));

        }
        //验证是否已经过期
        if ($parse->isExpired()) {
            $data['message'] = '温馨提示:登录已失效';
            throw new \think\exception\HttpException(200, $data['message'],null,[],$data['code']);
//            throw new \Swoole\ExitException(json_encode($data));

        }
        $this->user_id = $parse->getClaim('user_id');
        $this->username = $parse->getClaim('username');
        //角色权限 需要获得实时权限
//        $this->roles = $parse->getClaim('roles');

        //验证唯一设备登录  把旧用户踢下线
//        $cache  =Cache::store('redis')->hGet(config('apicanche.user.hash'),$this->username);
//
//        if(md5($token) !== $cache['token']){
//            $data['message'] =  '温馨提示:您的会员账号已在其他终端登录。';
//            throw new \think\exception\HttpException(200, $data['message'],null,[],$data['code']);
//        }

        //获取储存数据数据




    }



}