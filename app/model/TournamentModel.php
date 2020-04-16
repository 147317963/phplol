<?php


namespace app\model;


use think\Model;

class TournamentModel extends Model
{
    protected $name = 'tournament';


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