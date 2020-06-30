<?php
declare (strict_types = 1);

namespace app\controller\v1;




use app\BaseController;
use app\model\MatchModel;
use app\model\OddsModel;
use app\model\ScoreModel;
use app\model\TeamModel;

class Match extends BaseController
{
    /**用户获得比赛列表
     * @return \think\response\Json
     */
  public function index(){
      $data = Request()->only(['page', 'limit', 'sort','tournament_id','match_id']);

      //如果key不存在      或者       key为空                       不是数字
      if (!isset($data['page']) || empty($data['page']) || !is_numeric($data['page'])) {
          $data['page']=1;
      }
      //如果key不存在      或者       key为空                       不是数字
      if (!isset($data['limit']) || empty($data['limit']) || !is_numeric($data['limit'])) {
          $data['limit']=20;
      }
      if (!isset($data['sort']) || empty($data['sort']) || !is_string($data['sort'])) {
          $data['sort']='id';
      }



      if (isset($data['tournament_id']) && !empty($data['tournament_id']) && is_numeric($data['tournament_id'])) {
          //根据赛事比赛查询
          $map[]=['mc.tournament_id','=',$data['tournament_id']];
      }
      if (isset($data['match_id']) && !empty($data['match_id']) && is_numeric($data['match_id'])) {
          //查找指定比赛
          $map[]=['m.match_id','=',$data['match_id']];
      }
      $result = (new MatchModel())->alias('m')
          ->field('m.id as match_id ,m.user_id,m.username,match_create_id,m.update_time,m.create_time,
            mc.id,
            game_id,game_name,enable_parlay,live_url,match_name,match_short_name,round,status,start_time,end_time,tournament_id,
            tournament_name,tournament_short_name
            ')
          //
          ->leftJoin('think_match_create mc','m.match_create_id = mc.id')->order("{$data['sort']} desc")
          ->limit($data['limit'])
          ->page($data['page'])
          ->select()
          ->each(function ($item){
              $item['team']=(new TeamModel())
                  ->where(['match_create_id'=>$item->match_create_id])
                  ->order('pos asc')
                  ->select()
                  ->each(function ($items){
                      $items['score']=(new ScoreModel())
                      ->where(['match_create_id'=>$items->match_create_id,'team_id'=>$items->id])
                      ->find();

                  });
              //获得全场赔率 并且是获胜者
              $item['odds']=(new OddsModel())
                  ->where(['username'=>$item->username,'match_id'=>$item->match_id,'match_stage'=>'final','odds_group_name'=>'获胜者'])
                  ->limit(2)->select();
          });






     $data=[
         'code' => config('apicanche.succeed'),
         'result'=> $result
     ];



      return json($data);


  }
}