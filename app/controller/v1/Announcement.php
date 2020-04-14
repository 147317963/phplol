<?php


namespace app\controller\v1;


use app\BaseController;
use app\model\AnnouncementModel;


class Announcement extends BaseController
{

    public function index(){





        $result = (new AnnouncementModel())->select()->toArray();

        $data=[
            'code'=>200,
            'datas'=>  $result
        ];

        return json($data);
    }
}