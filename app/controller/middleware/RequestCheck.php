<?php
declare (strict_types=1);
namespace app\controller\middleware;

// 应用请求对象类
class RequestCheck
{
    public function handle($request, \Closure $next)
    {


        return $next($request);
    }
}
