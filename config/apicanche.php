<?php
/**
 * Created by PhpStorm.
 * User: Zhu
 * Date: 2018/11/11
 * Time: 7:16
 */
return [
//    状态码	名称	含义
//200	OK	请求成功
//201	Created	请求成功，新资源建立
//202	Accept	请求成功
//204	No Content	请求成功,没有内容
//300	Multiple Choices	存在多个资源
//301	Moved Permanently	资源被永转移
//302	Found	请求的资源被暂时转移
//303	See Other	引用他处
//400	Bad Request	请求不正确
//401	Unauthorized	需要认证
//403	Forbidden	禁止访问
//404	Not Found	没有找到指定的资源
//429	Too Many Requests	访问次数过多
//500	Internal Server Error	服务器端发生错误
//503		服务器暂时停止运营
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