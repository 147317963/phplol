<?php


namespace app\model;


use think\Model;

class AnnouncementModel extends Model
{
    protected $name = 'announcement';

    public function index(){


        $result = $this->select();


        return $result;

    }
}