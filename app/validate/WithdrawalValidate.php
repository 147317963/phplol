<?php

namespace app\validate;

use think\Validate;

class WithdrawalValidate extends Validate
{
    protected $regex = [

        'password'=>'/^[0-9]{6,6}$/',
        //银行卡号数字15-19位
        'card'  => '/^[0-9]{15,19}$/'

    ];

    protected $rule = [

        'money' => 'number|egt:100|elt:49999',

        'password'=> 'regex:password|require',

        'number'=>'regex:card|require',

        'address'=>'require',



    ];

    protected $message  =   [
        'number.regex'=>'银行卡格式错误！必须15或19位数字',
        'number.require' => '银行卡不能为空',
        'address.require'=>'开户地址不能为空',
        'money.number'=>'取款金额必须是数字',
        'money.egt'=>'取款最小金额100元',
        'money.elt'=>'取款最大金额49999元',


        'password.require' => '取款密码不能为空',
        'password.regex' => '取款密码为6位全数字',

    ];
    protected $scene = [
        'withdraw'   =>  ['money','password'],//取款


    ];
}