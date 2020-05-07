<?php


namespace app\model;


use think\facade\Cache;
use think\Model;

class OddsModel extends Model
{
    protected $name = 'odds';
    protected $autoWriteTimestamp = 'timestamp';   // 开启自动写入时间戳


//    protected $insert = ['date'];//数据完成
//
//
//    //数据完成
//    protected function setDateAttr()
//    {
//        return date('Y-m-d',time());
//    }


    public function getModelData(){


//        $result = Cache::store('redis')->get($this->name);
//
//
//
//        if($result == null){
             $result = $this->select();
//            Cache::store('redis')->set($this->name,$result,60);
//        }


        return $result;

    }

    //更新model数据后 把数据缓存到redis
    public static function onBeforeUpdate($odds)
    {
//        Cache::store('redis')->set(config('apicanche.user.info') . $user['username'], $user, config('apicanche.user.expire'));


    }
}