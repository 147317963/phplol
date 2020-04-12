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

Route::get(':version/game', ':version.game/index');


Route::get(':version/game', ':version.game/index');

Route::get(':version/match',':version.match/index');

Route::get(':version/odds',':version.odds/index');


Route::get(':version/history',':version.history/index');









Route::get(':version/getdata/gamelist',':version.getdata/gamelist');




Route::get(':version/getdata/team',':version.getdata/team');

Route::get(':version/getdata/tournament',':version.getdata/tournament');

Route::get(':version/getdata/oddsgroup',':version.getdata/oddsgroup');


