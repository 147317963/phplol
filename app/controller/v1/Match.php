<?php


namespace app\controller\v1;




use app\BaseController;
use app\model\MatchModel;
use app\model\OddsModel;
use app\model\ScoreModel;
use think\facade\Cache;

class Match extends BaseController
{
    /**获得比赛列表
     * @return \think\response\Json
     */
  public function index(){

     echo 123;


      $MatchModel = (new MatchModel())->index();


      $ScoreModel = (new ScoreModel())->index();

      $OddsModel = (new OddsModel())->index();


      $team = [];
      $odds = [];

      foreach ($MatchModel as $key=>$value){



          //获取匹配的比赛团队
          foreach ($ScoreModel as $k=>$v){

              if($value['id']===$v['match_id']){
                  $team[$v['pos']]=$v;
              }
          }
          //判断数组是否有下标
          if(count($team)){
              $MatchModel[$key]['team']=$team;
          }

          //获取匹配的比赛团队
          foreach ($OddsModel as $k=>$v){
              //匹配团队后 并且match_stage=final  全场
              if($value['id']===$v['match_id'] && $v['match_stage'] ==='final' ){
                  $odds[]=$v;
              }
          }
          //判断数组是否有下标
          if(count($odds)){
              $MatchModel[$key]['odds']=$odds;
          }




      }



//    dump(json($MatchModel));




     $data=[
       'code'=>200,
       'datas'=>  $MatchModel
     ];

//        dump($result);




      return json($data);

  }
}