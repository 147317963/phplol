<?php


namespace app\model;


use think\facade\Cache;
use think\Model;


class UserModel extends Model
{
    protected $name = 'user';
    protected $autoWriteTimestamp = 'timestamp';   // 开启自动写入时间戳


    protected $insert = ['date'];//数据完成


    //数据完成
    protected function setDateAttr()
    {
        return date('Y-m-d',time());
    }

    //更新model数据后 把数据缓存到redis
    public static function onBeforeUpdate($data)
    {
        Cache::store('redis')->hSet(config('apicanche.user.hash'),$data['username'], $data);
    }



}