<?php

namespace app\validate;

use think\Validate;

class DepositValidate extends Validate
{
    protected $regex = [

        'remark'=>'/^[a-zA-Z0-9_-]{6,16}$/',

    ];

    protected $rule = [

        'money' => 'number|egt:100|elt:49999',

        'remark'=> 'require',




    ];

    protected $message  =   [

        'money.number'=>'存款金额必须是数字',
        'money.egt'=>'存款最小金额100元',
        'money.elt'=>'存款最大金额49999元',
        'remark.require' => '备注不能为空',

    ];
    protected $scene = [
        'deposit'    =>['money','remark'],//存款
    ];
}