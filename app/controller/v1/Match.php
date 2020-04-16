<?php
declare (strict_types = 1);

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




      $MatchModel = (new MatchModel())->getModelData();

      $ScoreModel = (new ScoreModel())->getModelData();

      $OddsModel = (new OddsModel())->getModelData();



      foreach ($MatchModel as $key=>$value){

          $team = [];
          $odds = [];

          //获取匹配的比赛团队
          foreach ($ScoreModel as $k=>$v){

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
       'datas'=> $MatchModel
     ];



      return json($data);


  }
}