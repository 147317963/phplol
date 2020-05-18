<?php
declare (strict_types = 1);

namespace app\controller\v1;




use app\BaseController;
use app\model\MatchModel;
use app\model\OddsModel;
use app\model\ScoreModel;
use app\model\TeamModel;
use think\facade\Cache;

class Match extends BaseController
{
    /**获得赛事列表
     * @return \think\response\Json
     */
  public function index(){
      $paging = Request()->only(['page', 'limit', 'sort']);

      //如果key不存在      或者       key为空                       不是数字
      if (!isset($paging['page']) || empty($paging['page']) || !is_numeric($paging['page'])) {
          $paging['page']=1;
      }
      //如果key不存在      或者       key为空                       不是数字
      if (!isset($paging['limit']) || empty($paging['limit']) || !is_numeric($paging['limit'])) {
          $paging['limit']=20;
      }
      if (!isset($paging['sort']) || empty($paging['sort']) || !is_string($paging['sort'])) {
          $paging['sort']='id';
      }
      $result = (new MatchModel())->alias('m')
          ->field('m.id as match_id ,m.uid,m.username,match_create_id,m.update_time,m.create_time,
            mc.id,
            game_id,game_name,live_url,match_name,match_short_name,round,status,start_time,end_time,tournament_id,
            tournament_name,tournament_short_name
            ')
          ->leftJoin('think_match_create mc','m.match_create_id = mc.id')->order("{$paging['sort']} desc")
          ->limit($paging['limit'])
          ->page($paging['page'])
          ->select()
          ->each(function ($item){
              $item['team']=(new TeamModel())
                  ->where(['match_create_id'=>$item->match_create_id])
                  ->order('pos asc')
                  ->select();
              //获得全场赔率 并且是获胜者
              $item['odds']=(new OddsModel())
                  ->where(['username'=>$item->username,'match_id'=>$item->match_id,'match_stage'=>'final','odds_group_name'=>'获胜者'])
                  ->limit(2)->select();
          });






     $data=[
       'code'=>200,
       'result'=> $result
     ];



      return json($data);


  }
}