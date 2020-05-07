<?php


namespace app\model;


use think\facade\Cache;
use think\Model;

class GameModel extends Model
{
    protected $name = 'game';

    protected $autoWriteTimestamp = 'timestamp';   // 开启自动写入时间戳

    //查询后
    public static function onAfterRead($data)
    {
        Cache::store('redis')->hSet(config('apicanche.game.hash'),$data['id'], $data);
    }


}