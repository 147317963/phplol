<?php


namespace app\model;


use think\Model;

class AnnouncementModel extends Model
{
    protected $name = 'announcement';
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


        $result = $this->select();

        return $result;

    }
}