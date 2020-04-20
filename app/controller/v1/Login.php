<?php
//declare (strict_types = 1);

namespace app\controller\v1;


use app\BaseController;
use app\model\UserModel;
use app\Request;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;


class Login extends BaseController
{
    //解密密码然后cmd5 加密
    public string $key ="1234567890654321";
    public string $iv ="1234567890123456";
    //用户登录
  public function user(){
      $nowTime = time();
//      request()->param('password');
//      $request->param('sid');
//      Request()->param();
      $username = request()->param('username');
      $password = request()->param('password');



      $password = openssl_decrypt(base64_decode($password), "AES-128-CBC", $this->key, OPENSSL_RAW_DATA, $this->iv);
      $user = (new UserModel())->where(['username' => $username])->find();
     //判断密码正确和禁止登陆
      if (empty($user) ) {
          $data['code'] = 500;
          $data['message'] = '账号或密码错误';
          return json($data);
      }else if ($user['password'] != md5($password)) {
          $data['code'] = 500;
          $data['message'] = '账号或密码错误';
          return json($data);
      } else if ($user['status'] == 2) {
          $data['code'] = 500;
          $data['message'] = '账号禁止登录';
          return json($data);
      }
      //生成token
      $signer = new Sha256();
      //设置header和payload，以下的字段都可以自定义
      $Builder = (new Builder())->setIssuer('www.llgj.vip')//发布者
      ->setAudience('www.llgj.vip')//接收者
      ->setId("abc", true)//对当前token设置的标识
      ->setIssuedAt($nowTime)//token创建时间
      ->setExpiration($nowTime + 300)//过期时间
      ->setNotBefore($nowTime)//当前时间在这个时间前，token不能使用
      ->set('uid', $user['id'])//自定义数据
      ->set('username', $user['username']) //自定义数据
      ->sign($signer,'lljg_key')//设置签名
      ->getToken();
      $token['token'] = (string) $Builder;//获取加密后的token，转为字符串

//     return

      //更新用户一些信息到缓存 以便使用
//      $user->token= md5($token['token']);
//      $user->allowField(['token'])->save();
      //有动作就更新
//        $user['update_time'] = date('Y-m-d h:i:s', $nowTime);




      //登录信息写入记录
//      $data = [
//          'os' => get_os(),
//          'browser' => get_broswer(),
//          'msg' => '登入成功!',
//          'uid' => $user['id'],
//          'username' => $user['username'],
//          'date' => date('Y-m-d', $nowTime),
//          'ip' => request()->ip(),
//          'address' => implode(",", Ip::find(request()->ip())),
//      ];
//      (new MemberLoginMsgModel())->data($data, true)->save();



      //获取过期时间
      $data = [
          'code' => 200,
          'token' => $token['token'],
          'message' => '登入成功!',
          'exp' => $nowTime + 300,
      ];
      return json($data);

  }

  public function register(){

  }
}