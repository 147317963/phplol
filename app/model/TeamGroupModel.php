<?php


namespace app\model;


use think\Model;

class TeamGroupModel extends Model
{
    protected $name = 'team_group';

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
}