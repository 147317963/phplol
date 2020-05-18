<?php
declare (strict_types = 1);

namespace app\controller\v1;


use app\BaseController;
use app\model\ConfigModel;

class Config extends BaseController
{

    public function index(){
        $result = (new ConfigModel())->select();
        $data = [
            'code' => config('apicanche.succeed'),
            'result' => $result
        ];


        return json($data);
    }


}