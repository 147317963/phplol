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



/**获得到搜索目标的所在的key   成功返回key   失败返回-1
 * @param $target
 * @param array $array
 * @return int
 */
function find_index($target,array $array):int
{
    foreach($array as $key => $val){
        if(array_search($target, $val)) return (int)$key;
    }
    return -1;
}