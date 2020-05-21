<?php


namespace app\controller\middleware;


use app\BaseController;

class Action extends BaseController
{
    /**
     * 默认返回资源类型
     * @var \think\Request $request
     * @var mixed $next
     * @throws \Exception
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        
        return $next($request);
    }
}