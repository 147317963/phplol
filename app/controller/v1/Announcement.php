<?php
declare (strict_types = 1);

namespace app\controller\v1;


use app\BaseController;
use app\model\AnnouncementModel;

class Announcement extends BaseController
{
    
    public function index(){





        $result = (new AnnouncementModel())->select();

        $data=[
            'code'=>200,
            'result'=>  $result
        ];

        return json($data);
    }
}