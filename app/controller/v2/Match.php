<?php
declare (strict_types=1);

namespace app\controller\v2;


use app\controller\Base;
use app\model\MatchModel;
use app\model\TeamModel;
use app\model\UserModel;
use app\validate\MatchValidate;
use think\facade\Cache;
use think\Request;


class Match extends Base
{
    /**获得自身比赛
     * @return \think\response\Json
     */
    public function getList()
    { //开发完毕

        $paging = Request()->only(['page', 'limit', 'sort', 'status', 'game_name']);
        $map[] = ['uid', '=', $this->uid];
        //判断该变量key是否存在            //判断该key是否为空
        if (isset($paging['status']) && !empty($paging['status'])) {
            $map[] = ['status', '=', $paging['status']];
        }
        //判断该变量key是否存在            //判断该key是否为空
        if (isset($paging['game_name']) && !empty($paging['game_name'])) {
            //模糊查询
            $map[] = ['game_name', 'like', '%' . $paging['game_name'] . '%'];
        }
        //如果key不存在      或者       key为空                       不是数字
        if (!isset($paging['page']) || empty($paging['page']) || !is_numeric($paging['page'])) {
            $paging['page']=1;
        }
        //如果key不存在      或者       key为空                       不是数字
        if (!isset($paging['limit']) || empty($paging['limit']) || !is_numeric($paging['limit'])) {
            $paging['limit']=20;
        }
        if (!isset($paging['sort']) || empty($paging['sort']) || !is_string($paging['limit'])) {
            $paging['sort']='id';
        }

            $result = (new MatchModel())->where($map)->order("{$paging['sort']} desc")->paginate([
                'list_rows' => $paging['limit'],
                'page' => $paging['page']
            ])->each(function ($item, $key){

                $item['team']=(new TeamModel())->where(['match_id'=>$item->id])->order('pos asc')->select();

            });




        $data = [
            'code' => 200,
            'result' => $result
        ];


        return json($data);


    }

    //创建比赛
    public function create()
    {

        $MatchModel = new MatchModel();
        $data = Request()->only(['game_id', 'game_name', 'round', 'start_time', 'end_time', 'status', 'tournament_id', 'tournament_name', 'tournament_short_name']);

        $validate = new MatchValidate();
        $result = $validate->scene('create')->check($data);
        if (!$result) {
            return json($validate->getError());
        }
        $gamelist = Cache::store('redis')->hGetall(config('apicanche.game.hash'));
        $tournamentlist = Cache::store('redis')->hGetall(config('apicanche.tournament.hash'));
        if (!isset($gamelist[$data['game_id']]) || $gamelist[$data['game_id']]['game_name'] != $data['game_name']) {
            return json(['code' => 500, 'message' => '参数1不匹配']);
        }
        if (!isset($tournamentlist[$data['tournament_id']]) || $tournamentlist[$data['tournament_id']]['tournament_name'] != $data['tournament_name'] || $tournamentlist[$data['tournament_id']]['tournament_short_name'] != $data['tournament_short_name']) {
            return json(['code' => 500, 'message' => '参数2不匹配']);
        }
//       dump($gamelist[$data['game_id']]);

//      $MatchModel->save($data);


    }

    public function update()
    {

        //自检测更新
        $data = Request()->only(['id', 'start_time', 'end_time', 'status']);

        $validate = new MatchValidate();

        $result = $validate->scene('update')->check($data);

        if (!$result) {

            return json($validate->getError());
        }

        $MatchModel = (new MatchModel())->where(['id' => $data['id'], 'username' => $this->username])->find();

        if ($MatchModel) {

            if ($MatchModel->status == 3) {

                return json(['code' => config('apicanche.erro'), 'message' => '赛事状态已经结束无法更新操作']);
            }
        } else {

            return json(['code' => config('apicanche.erro'), 'message' => '无法匹配到赛事']);
        }

        $MatchModel->allowField(['start_time', 'end_time', 'status'])->save($data);

        return json(['code' => config('apicanche.succeed'), 'message' => '更新比赛成功']);
    }
}