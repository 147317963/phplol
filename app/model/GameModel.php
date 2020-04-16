<?php


namespace app\model;


use think\Cache;
use think\Model;

class GameModel extends Model
{
    protected $name = 'game';

    public function getModelData(){
//        $result = Cache::store('redis')->get($this->name);



//        if($result == null){
        $result = $this->select();
//            Cache::store('redis')->set($this->name,$result,60);
//        }


        return $result;
    }
}