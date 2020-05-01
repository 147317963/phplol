<?php
declare (strict_types = 1);

namespace app\controller\v2;




use app\BaseController;
use app\controller\Base;
use app\model\MatchModel;
use app\model\OddsModel;
use app\model\ScoreModel;
use app\model\TeamModel;
use think\facade\Cache;

class Match extends Base
{
    /**获得自身比赛
     * @return \think\response\Json
     */
  public function index(){

      $MatchModel = (new MatchModel())->getModelData();

      $ScoreModel = (new ScoreModel())->getModelData();

      $TeamModel = (new TeamModel())->getModelData();

      $OddsModel = (new OddsModel())->getModelData();



      foreach ($MatchModel as $key=>$value){

          $team = [];
          $odds = [];

          //获取匹配的比赛团队
          foreach ($TeamModel as $k=>$v){

              //获得匹配的比分
              foreach ($ScoreModel as $s=>$score){

                  if($value['id']===$score['match_id'] && $score['team_id'] == $score['team_id']){

                  }

              }

              if($value['id']===$v['match_id']){
                  $team[]=$v;
              }

          }
          //解决Josn后边对象问题
//          sort($team);
          //判断数组是否有下标
          if(count($team)){
              $MatchModel[$key]['team']=$team;
          }

          //获取匹配的比赛团队赔率
          foreach ($OddsModel as $k=>$v){
              //匹配团队后 并且match_stage=final  全场
              if($value['id']===$v['match_id'] && $v['match_stage'] ==='final' ){
//                  $odds[]=$v;
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
       'result'=> $MatchModel
     ];



      return json($data);


  }
  //创建比赛
  public function createMatch(){

  }
}