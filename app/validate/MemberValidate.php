<?php

namespace app\validate;

use think\Validate;

class MemberValidate extends Validate
{
    protected $regex = [
        'username' => '/^[a-zA-Z0-9_]{6,16}$/',

        'password'=>'/^[a-zA-Z0-9]{6,16}$/',

        'cpassword'=>'/^[a-zA-Z0-9]{6,16}$/',

        'name'=>'/^([\xe4-\xe9][\x80-\xbf]{2}){2,4}$/',

        'qq'=>'/^[0-9]{5,20}$/',






//        'oldpwd'=>'/^[a-zA-Z0-9_-]{6,16}$/',
        'oldpwd'=>'/^[0-9]{6,6}$/',
        'newpwd'=>'/^[0-9]{6,6}$/',



        'email'=>'email'

    ];


    protected $rule = [
        'username'=> 'regex:username|require',
        'password'=> 'regex:password|require',
        'cpassword'=>'regex:cpassword|require|confirm:password',
        'name'=> 'regex:name|require',
        'qq'=>'regex:qq|require',
        'oldpassword'=>  'regex:password|require',
        'newpassword' => 'regex:password|require',
        'email'=>'regex:email|require',
    ];
    protected $message  =   [
        'id.number'=>'参数错误',

        //账号
        'username.require' => '用户不能为空',
        'username.regex' => '帐号由6到16位只能是字母或数字_',
        //密码
        'password.require' => '密码不能为空',
        'password.regex' => '密码(6-16位数字和字母)',

        //确认密码
        'cpassword.require' => '密码不能为空',
        'cpassword.regex'=> '确认密码(6-16位数字和字母)',
        'cpassword.confirm'=> '密码和确认密码不一致',

        //修改密码
        'oldpassword.confirm' => '旧密码',
        'oldpassword.confirm' => '密码和确认密码不一致',
        'newpassword.require' => '新密码不能为空',
        'newpassword.regex' => '新密码(6-16位数字和字母)',




        'name.require'     => '姓名不能为空',
        'name.regex' => '必须填写真实姓名2-3位,方便取款字',
        'qq.require'   => 'QQ不能为空',
        'qq.regex'   => '请输QQ号码5-20位',


        'oldpwd.require'  => '旧密码不能为空',
        'oldpwd.regex'  => '旧取款密码为6位数字',
        'newpwd.require'  => '新密码或新支付密码不能为空',
        'newpwd.regex'  => '密码由6到16位只能是字母、字母，数字，下划线，减号',
        //邮箱
        'email.require'        => '邮箱不能为空',
        'email.email'        => '请填写正确邮箱',



        'info.require'  =>'搜索参数错误',
        'uid.require'  =>'只能通过推广链接注册,请联系代理获取链接',
        'uid.number'  =>'代理链接参数错误',

    ];
    protected $scene = [
        'user'   =>  ['username','password'],//登录

        'register'  =>  ['username','password','cpassword','name','qq','uid'],//注册

//        'editid'  =>  ['id'],//编辑账号信息
//
//        'editPwd'  =>  ['oldpwd','newpwd'],//修改密码
//
//
//        'editnPaypwd' => ['oldpwd','newpwd'],//修改支付密码



    ];
}