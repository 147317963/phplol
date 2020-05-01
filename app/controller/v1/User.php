<?php
declare (strict_types = 1);

namespace app\controller\v1;


use app\controller\Base;
use app\model\UserModel;

class user extends Base
{

    public function info(){

        $result = (new UserModel())->where(['id'=>$this->uid])->find();
        $data = [
            'code' => 200,
            'datas' => $result
        ];

//        dump($result);


        return json($data);
    }
}