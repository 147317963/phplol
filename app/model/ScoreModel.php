<?php


namespace app\model;


use think\facade\Cache;
use think\Model;

class ScoreModel extends Model
{
    protected $name = 'score';



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