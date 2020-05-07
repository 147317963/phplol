<?php

namespace app\validate;

use think\Validate;

class MatchValidate extends Validate
{
    protected $regex = [





    ];

    protected $rule = [

        'game_id' => 'require|number',
        'game_name'=>'require',
        'tournament_id'=>'require|number',
        'tournament_name'=>'require',
        'tournament_short_name'=>'require',
        'round'=>'require|length:3',
        'start_time'=>'require|dateFormat:Y-m-d H:i:s',
        'end_time'=>'require|dateFormat:Y-m-d H:i:s',
        'status'=>'require|in:1,2,3',
        'id'=>'require|number',




    ];

    protected $message  =   [
        'id.require'=>['code'=>500,'message' => 'ID 不能为空'],
        'id.number'=>['code'=>500,'message' => 'ID 必须是整数'],

        'game_id.require' =>['code'=>500,'message' => '游戏ID 不能为空'],
        'game_id.number'=>['code'=>500,'message' => '游戏ID 必须是整数'],
        'game_name.require' => ['code'=>500,'message' => '游戏名称 不能为空'],
        'tournament_id.require' => ['code'=>500,'message' => '赛事ID 不能为空'],
        'tournament_id.number' => ['code'=>500,'message' => '赛事ID 必须是整数'],
        'tournament_name.require' => ['code'=>500,'message' => '赛事名称 不能为空'],
        'tournament_short_name.require' => ['code'=>500,'message' => '赛事短名称 不能为空'],
        'round.require'=>['code'=>500,'message' => 'bo 不能为空'],
        'round.length'=>['code'=>500,'message' => 'bo 只能bo1-bo9'],
        'start_time.require' => ['code'=>500,'message' => '开始时间 必填'],
        'start_time.dateFormat' => ['code'=>500,'message' => '开始时间 正确格式列如 2011-01-01 00:00:00'],
        'end_time.require' => ['code'=>500,'message' => '结束时间 必填'],
        'end_time.dateFormat' => ['code'=>500,'message' => '结束时间 正确格式列如 2011-01-01 00:00:00'],
        'status.require'=>['code'=>500,'message' => '赛事状态 必填'],
        'status.in'=>['code'=>500,'message' => '赛事状态 以数字1-3表示'],

    ];
    protected $scene = [
        //创建
        'create'=>['game_id','game_name','round','start_time','end_time','status','tournament_id','tournament_name','tournament_short_name'],
        //更新
        'update'  =>  ['id','start_time','end_time','status'],
    ];
}
