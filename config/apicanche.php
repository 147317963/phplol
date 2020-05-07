<?php
/**
 * Created by PhpStorm.
 * User: Zhu
 * Date: 2018/11/11
 * Time: 7:16
 */
return [
    //解密密码然后cmd5 加密
    'key' => '1234567890654321',
    'iv' => '1234567890123456',
    //登录后加密key
    'secret' => 'lljg_key',
    //成功返回状态
    'succeed' => 200,
    //失败返回状态
    'erro' => 500,



    //数据库配置缓存


    'conifg' => [
        'all' => 'config_all',
        //配置缓存时间
        'expire' => 600
    ],

    'login' => [
        //超过expire 86400秒 没有动静视为已经离线 强踢账户下线
        'expire' => 86400,
        //需要登录返回状态
        'erro' => 403,
    ],
    //会员缓存
    'user' => [
        //会员缓存 缓存
        'hash' => 'user:hash:u:',//user:hash:id:$usernmae  以用户为后羿
        'own'=>'user_own_',//user_own_username
        'all' => 'user_all',
        //缓存时间
        'expire' => 6000,
    ],
    //游戏列表缓存
    'game' => [
        'hash' => 'game:hash:id:',//user_info_id
        'own'=>'game_own_',//game_own_username
        //游戏列表缓存
        'all' => 'game_all',
        //缓存时间
        'expire' => 6000,
    ],
    //游戏列表缓存
    'match' => [
        'hash' => 'match:hash:id:',//user_info_id
        'own'=>'match_own_',//match_own_username
        //游戏列表缓存
        'all' => 'match_all',
        //缓存时间
        'expire' => 6000,
    ],
    'teamgroup'=>[
        'hash' => 'teamgroup:hash:id:',//user_info_id
        'own'=>'teamgroup_own_',//match_own_username
        //游戏列表缓存
        'all' => 'teamgroup_all',
        //缓存时间
        'expire' => 6000,
    ],
    'tournament'=>[
        'hash' => 'tournament:hash:id:',//user_info_id
        'own'=>'tournament_own_',//match_own_username
        //游戏列表缓存
        'all' => 'tournament_all',
        //缓存时间
        'expire' => 6000,
    ],


];