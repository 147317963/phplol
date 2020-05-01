<?php
/**
 * Created by PhpStorm.
 * User: Zhu
 * Date: 2018/11/11
 * Time: 7:16
 */
return [
    //解密密码然后cmd5 加密
    'key'=>'1234567890654321',
    'iv'=>'1234567890123456',
    //登录后加密key
    'secret'=>'lljg_key',
    //成功返回状态
    'succeed' => 200,
    //失败返回状态
    'erro' => 500,

    'conifg' =>[
        //配置缓存时间
        'expire' => 600
    ],

    'login' => [
        //超过expire 300秒 没有动静视为已经离线 强踢账户下线
        'expire'=>300,
        //需要登录返回状态
        'erro' =>403,
    ],
    'user'=>[
        //会员缓存 缓存
        'info'=>'user_info_',
        //缓存时间
        'expire'=>6000,
    ],


];