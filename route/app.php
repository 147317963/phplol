<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});


//v1


//登录                    用户登录退出获取用户信息
Route::rule(':version/user/login', ':version.user/login');
//退出
Route::rule(':version/user/logout', ':version.user/logout');
//获得用户信息
Route::rule(':version/user/getInfo', ':version.user/getInfo');

//公告                      获得公告列表
Route::rule(':version/announcement/getList', ':version.announcement/getList');
//创建公告
Route::rule(':version/announcement/create',':version.announcement/create');
//更新更高
Route::rule(':version/announcement/update',':version.announcement/update');




//获得游戏列表                游戏列表
Route::rule(':version/game/getList', ':version.game/getList');
//创建游戏
Route::rule(':version/game/create',':version.game/create');
//更新游戏
Route::rule(':version/game/update',':version.game/update');


//获得比赛列表                  自己创建比赛列表
Route::rule(':version/match/getList',':version.match/getList');
//创建游戏
Route::rule(':version/match/create',':version.match/create');
//更新游戏
Route::rule(':version/match/update',':version.match/update');





//获得赛事名称列表            赛事名称  比如LPL春季赛
Route::rule(':version/tournament/getList',':version.tournament/getList');
//创建赛事
Route::rule(':version/tournament/create',':version.tournament/create');
//更新赛事
Route::rule(':version/tournament/update',':version.tournament/update');


//获得团队名称列表            团队    OMG
Route::rule(':version/teamgroup/getList',':version.teamgroup/getList');
//创建团队
Route::rule(':version/teamgroup/create',':version.teamgroup/create');
//更新团队
Route::rule(':version/teamgroup/update',':version.teamgroup/update');


//获得赔率列表        赔率
Route::rule(':version/odds/getList',':version.odds/getList');
//创建赔率
Route::rule(':version/odds/create',':version.odds/create');
//更新赔率
Route::rule(':version/odds/update',':version.odds/update');


//银行卡             绑定银行换银行卡
Route::rule(':version/odds/getList',':version.odds/getList');
//创建赔率
Route::rule(':version/odds/create',':version.odds/create');
//更新赔率
Route::rule(':version/odds/update',':version.odds/update');





//订单                下注订单
Route::rule(':version/order/getList',':version.order/getList');
//创建订单
Route::rule(':version/order/create',':version.order/create');
//更新订单
Route::rule(':version/order/update',':version.order/update');

















Route::rule(':version/history/index',':version.history/index');









Route::rule(':version/getdata/gamelist',':version.getdata/gamelist');




Route::rule(':version/getdata/team',':version.getdata/team');

Route::rule(':version/getdata/tournament',':version.getdata/tournament');

Route::rule(':version/getdata/oddsgroup',':version.getdata/oddsgroup');



//后台
