<?php
// 事件定义文件
return [
    'bind'      => [
    ],

    'listen'    => [
        'AppInit'  => [],
        'HttpRun'  => [],
        'HttpEnd'  => [],
        'LogLevel' => [],
        'LogWrite' => [],
//        'swoole.websocket.Test'=>[
//            \app\listener\WebsocketTest::class
//        ]
    ],

    'subscribe' => [
    ],
];
