<?php

declare (strict_types = 1);

namespace app\listener;

use think\swoole\Websocket;

class SubTest
{
    protected  $websocket = null;

    //这里使用了连接websocket的另一种方式  管理类
    public function __construct(\think\Container $container)
    {
        //$this->websocket = app('think\swoole\Websocket');
        $this->websocket = $container->make(Websocket::class);
    }
    //需要注意的是方法前面要加on
    public function onConnect(){
        $this->websocket ->emit('sendfd', $this -> websocket->getsender());
    }

    public function onJoin($event){
        $this->websocket->join($event['room']);
        $this->websocket->emit('joincall', "这是我的加入成功");
    }

}
