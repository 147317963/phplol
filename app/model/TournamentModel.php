<?php


namespace app\model;


use think\facade\Cache;
use think\Model;

class TournamentModel extends Model
{
    protected $name = 'tournament';

    protected $autoWriteTimestamp = 'timestamp';   // 开启自动写入时间戳


//    protected $insert = ['date'];//数据完成
//
//
//    //数据完成
//    protected function setDateAttr()
//    {
//        return date('Y-m-d',time());
//    }

//查询后
    public static function onAfterRead($data)
    {
        Cache::store('redis')->hSet(config('apicanche.tournament.hash'),$data['id'], $data);
    }


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
}