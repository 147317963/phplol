<?php


namespace app\controller;


use app\BaseController;
use app\model\GameModel;
use app\model\UserModel;

use think\facade\Cache;

class Index extends BaseController
{
   public function index(){
       dump(Request()->header());

//       $user=Cache::store('redis')->hGetall(config('apicanche.game.hash'));
//        dump($user);



   }


}