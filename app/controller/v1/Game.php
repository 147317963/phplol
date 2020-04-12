<?php


namespace app\controller\v1;


use app\BaseController;
use app\model\GameModel;

class Game extends BaseController
{
   public function index(){

       $result = (new GameModel())->select()->toArray();

       $data=[
         'code'=>200,
         'datas'=>  $result
       ];

       return json($data);

   }
}