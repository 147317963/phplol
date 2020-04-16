<?php


namespace app\model;


use think\Model;

class AnnouncementModel extends Model
{
    protected $name = 'announcement';

    public function getModelData(){


        $result = $this->select();

        return $result;

    }
}