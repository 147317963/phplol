<?php


namespace app\model;


use think\facade\Cache;
use think\Model;

class MatchModel extends Model
{
    protected $name = 'match';







    public function getModelData(){

//        $result = Cache::store('redis')->get($this->name);



//        if($result == null){
         $result = $this->select();
//            Cache::store('redis')->set($this->name,$result,60);
//        }


        return $result;

    }
}