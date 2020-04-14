<?php


namespace app\model;


use think\facade\Cache;
use think\Model;

class OddsModel extends Model
{
    protected $name = 'odds';



    public function index(){


//        $result = Cache::store('redis')->get($this->name);
//
//
//
//        if($result == null){
            $result = $this->column('*','id');
//            Cache::store('redis')->set($this->name,$result,60);
//        }


        return $result;

    }
}