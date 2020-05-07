<?php

namespace app\validate;

use think\Validate;

class LotteryValidate extends Validate
{


    protected $rule = [
        'type' => 'in:1,50,55,70,99|require',
        'id'=>'number|require',
        'page'=>'number|require'
    ];

    protected $message  =   [
        'type.require'=>'type不能为空',
        'type.in'=>'type不正确',
        'id.require'=>'ID不能为空',
        'id.number'=>'ID必须纯数字',
        'page.require'=>'page不能为空',
        'page.number'=>'page必须纯数字',

    ];
    protected $scene = [

        'auto'=>['type'],
        'AutoList'=>['type','page'],
        'DeleteOrder'=>['type','id']
    ];
}