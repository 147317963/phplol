<?php


namespace app\controller\middleware;


use app\BaseController;

class Validate extends BaseController
{
    /**
     * 默认返回资源类型
     * @var \think\Request $request
     * @var mixed $next
     * @var string $name
     * @throws \Exception
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $response = $next($request);
        //获取当前参数
        $params = $request->param();
        //获取访问模块

        //获取访问控制器
        $controller = ucfirst($request->controller());
        //获取操作名,用于验证场景scene
        $scene    = $request->action();
        $validate = "app\\"  . "\\validate\\" . $controller;
        //仅当验证器存在时 进行校验
        dump($validate);
        if (class_exists($validate)) {
            $v = $this->app->validate($validate);
            if ($v->hasScene($scene)) {
                //仅当存在验证场景才校验
                $result = $this->validate($params, $validate . '.' . $scene);
                if (true !== $result) {
                    //校验不通过则直接返回错误信息
                    return json(['code' => -1, 'msg' => $result]);
                }
            }
        }
        return $response;
    }
}