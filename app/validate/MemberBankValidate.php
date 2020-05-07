<?php

namespace app\validate;

use think\Validate;

class MemberBankValidate extends Validate
{
    protected $regex = [

        'card'=>'/^[0-9]{15,19}$/',

    ];


    protected $rule = [

        'card'=>'regex:card|require',
        'address'=>'require',
        'branch'=>'require',

    ];
    protected $message  =   [
        'id.number'=>'id必须为数字',
        'id.require'   => 'id不能为空',


        'card.require'   => '银行卡不能为空',
        'card.regex'     => '请正确输入银行卡15-19位',
        'address.require'=>'开户地址不能为空',
        'branch.require'=>'开户支行不能为空',


    ];
    protected $scene = [

        'addBankCard'  =>  ['card','address','branch'],//添加银行卡

        'delBankCard'  =>  ['id'],//删除银行卡

    ];
}