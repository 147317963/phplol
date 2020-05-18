<?php

namespace app\validate;

use think\Validate;

class MatchValidate extends Validate
{
    protected $regex = [





    ];

    protected $rule = [

        'match_create_id'=>'require|number',




    ];

    protected $message  =   [
        'match_create_id.require'=>['code'=>500,'message' => 'match_create_id 不能为空'],
        'match_create_id.number'=>['code'=>500,'message' => 'match_create_id 必须是整数'],

    ];
    protected $scene = [
        //创建
        'create'=>['match_create_id'],

    ];
}
