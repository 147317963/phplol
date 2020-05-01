<?php
declare (strict_types = 1);
// 应用公共文件

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * @param int $code
 * @param string $message
 * @param array $data
 * @param int $httpStatus
 * @return \think\response\Json
 */
function show(int $code,string $message = 'error',array $data = null,int $httpStatus = 200){

    $result=[
        'code'=>$code,
        'message'=>$message,
        'result'=>$data
    ];
//    return json($result,$httpStatus);
    return json($result);
}