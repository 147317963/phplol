<?php

namespace app\validate;

use think\Validate;

class HistoryValidate extends Validate
{


    protected $rule = [
        'type' => 'in:1,50,55,70,99|require',
        'date' => 'dateFormat:Y-m-d|require',
    ];

    protected $message  =   [
        'type.require'=>'彩种类型不能为空',
        'type.in'=>'彩种类型不正确',
        'date.require' => '日期不能为空',
        'date.dateFormat' => '日期错误',

    ];
    protected $scene = [

        'auto'=>['type','date']
    ];
}