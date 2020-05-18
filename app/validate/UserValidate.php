<?php

namespace app\validate;

use think\Validate;

class UserValidate extends Validate
{
    protected $regex = [
        'username' => '/^[a-zA-Z0-9_]{6,16}$/',

        'password'=>'/^[a-zA-Z0-9]{6,16}$/',


        'name'=>'/^([\xe4-\xe9][\x80-\xbf]{2}){2,4}$/',

        'qq'=>'/^[0-9]{5,20}$/',


        'email'=>'email'

    ];


    protected $rule = [
        'username'=> 'regex:username|require',
        'password'=> 'regex:password|require',
        'name'=> 'regex:name|require',
        'qq'=>'regex:qq|require',
        'email'=>'regex:email|require',
        'we_chat'=>'require',
    ];
    protected $message  =   [

        //账号
        'username.require' => ['code'=>500,'message' => '用户 不能为空'],
        'username.regex' => ['code'=>500,'message' => '帐号由6到16位只能是字母或数字_'],
        //密码
        'password.require' => ['code'=>500,'message' => '密码 不能为空'],
        'password.regex' => ['code'=>500,'message' => '密码(6-16位数字和字母)'],


        //姓名
        'name.require'     => ['code'=>500,'message' => '姓名不能为空'],
        'name.regex' => ['code'=>500,'message' => '必须填写真实姓名2-4位'],
        //QQ
        'qq.require'   => ['code'=>500,'message' => 'QQ 不能为空'],
        'qq.regex'   => ['code'=>500,'message' => '请输QQ号码5-20位'],


        //邮箱
        'email.require'        => ['code'=>500,'message' => '邮箱不能为空'],
        'email.email'        => ['code'=>500,'message' => '请填写正确邮箱'],

        //微信
        'we_chat.require' =>['code'=>500,'message' => '微信不能为空'],





    ];
    protected $scene = [
        'login'   =>  ['username','password'],//登录

        'register'  =>  ['username','password','name'],//注册

//        'editid'  =>  ['id'],//编辑账号信息
//
//        'editPwd'  =>  ['oldpwd','newpwd'],//修改密码
//
//
//        'editnPaypwd' => ['oldpwd','newpwd'],//修改支付密码



    ];
}