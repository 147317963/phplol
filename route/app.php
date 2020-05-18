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

//配合                      获得配置列表

Route::rule('/:version/config', ':version.Config/index');

//登录                    用户登录退出获取用户信息
Route::rule(':version/user/login', ':version.user/login');
//退出
Route::rule(':version/user/logout', ':version.user/logout');
//获得用户信息
Route::rule(':version/user/getInfo', ':version.user/getInfo');






//公告                      获得公告列表
//创建公告
Route::rule(':version/announcement/create',':version.Announcement/create');
//更新更高
Route::rule(':version/announcement/update',':version.Announcement/update');
//公告列表
Route::rule(':version/announcement', ':version.Announcement/index');




//               游戏列表
//创建游戏
Route::rule(':version/game/create',':version.Game/create');
//更新游戏
Route::rule(':version/game/update',':version.Game/update');
//获得游戏列表
Route::rule(':version/game', ':version.Game/index');

//                    admin创建比赛列表
//创建游戏
Route::rule(':version/matchcreate/create',':version.matchcreate/create');
//更新游戏
Route::rule(':version/matchcreate/update',':version.matchcreate/update');
//获得比赛列表
Route::rule(':version/matchcreate',':version.Matchcreate/index');

//                  自己创建比赛列表
//创建游戏
Route::rule(':version/match/create',':version.Match/create');
//更新游戏
Route::rule(':version/matchcreate/update',':version.Match/update');
//获得比赛列表
Route::rule(':version/match',':version.Match/index');






//                      赛事名称  比如LPL春季赛
//创建赛事
Route::rule(':version/tournament/create',':version.Tournament/create');
//更新赛事
Route::rule(':version/tournament/update',':version.Tournament/update');
//获得赛事名称列表
Route::rule(':version/tournament',':version.Tournament/index');

//                       团队    OMG
//创建团队
Route::rule(':version/teamgroup/create',':version.Teamgroup/create');
//更新团队
Route::rule(':version/teamgroup/update',':version.Teamgroup/update');
//获得团队名称列表
Route::rule(':version/teamgroup',':version.Teamgroup/index');


//                 赔率
//创建赔率
Route::rule(':version/odds/create',':version.Odds/create');
//更新赔率
Route::rule(':version/odds/update',':version.Odds/update');
//获得赔率列表
Route::rule(':version/odds',':version.Odds/index');







//                          下注订单
//创建订单
Route::rule(':version/order/create',':version.Order/create');
//更新订单
Route::rule(':version/order/update',':version.Order/update');
//订单列表
Route::rule(':version/order',':version.Order/index');

















Route::rule(':version/history/index',':version.history/index');









Route::rule(':version/getdata/gamelist',':version.getdata/gamelist');




Route::rule(':version/getdata/team',':version.getdata/team');

Route::rule(':version/getdata/tournament',':version.getdata/tournament');

Route::rule(':version/getdata/oddsgroup',':version.getdata/oddsgroup');



//后台
