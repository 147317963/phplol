<?php


namespace app\model;


use think\facade\Cache;
use think\Model;

class MatchCreateModel extends Model
{
    protected $name = 'match_create';

    protected $autoWriteTimestamp = 'timestamp';   // 开启自动写入时间戳


//    protected $insert = ['date'];//数据完成
//
//
//    //数据完成
//    protected function setDateAttr()
//    {
//        return date('Y-m-d',time());
//    }







}