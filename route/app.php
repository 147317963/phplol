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


//登录
Route::rule(':version/user/login', ':version.user/login');
//退出
Route::rule(':version/user/logout', ':version.user/logout');
//获得用户信息
Route::rule(':version/user/getInfo', ':version.user/getInfo');
//公告
Route::rule(':version/announcement', ':version.announcement/index');


Route::rule(':version/game/index', ':version.game/index');

Route::rule(':version/match/index',':version.match/index');

Route::rule(':version/odds/index',':version.odds/index');

Route::rule(':version/odds/updateodds',':version.odds/updateodds');

Route::rule(':version/history',':version.history/index');









Route::rule(':version/getdata/gamelist',':version.getdata/gamelist');




Route::rule(':version/getdata/team',':version.getdata/team');

Route::rule(':version/getdata/tournament',':version.getdata/tournament');

Route::rule(':version/getdata/oddsgroup',':version.getdata/oddsgroup');



//后台
