<?php
declare (strict_types=1);

namespace app\controller\v2;


use app\controller\Base;
use app\model\MatchCreateModel;
use app\model\TeamModel;
use app\validate\MatchValidate;
use think\facade\Cache;
use think\Request;


class Matchcreate extends Base
{
    /**获得自身比赛 管理开设的比赛
     * @return \think\response\Json
     */
    public function index()
    {
        $paging = Request()->only(['game_id']);

        //获得相应ID比赛
        if (isset($paging['game_id']) && !empty($paging['game_id'])) {
            $map[] = ['game_id', '=', $paging['game_id']];
        }
        //获取未开始 或者滚盘中的比赛
        $map[] = ['status', 'in', '1,2'];
//        $result = (new  MatchCreateModel())->where($map)->select();

        $result = (new  MatchCreateModel())->where($map)
            ->whereTime('end_time', '>=', time())
            ->select()
            ->each(function ($item, $key) {
                $item['team'] = (new TeamModel())->where(['match_create_id' => $item->id])->order('pos asc')->select();
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
//        https://tc-tct.douyucdn2.cn/dyliveflv1/60937r1lhk2UMP8m_550p.flv?wsAuth=7d57b38318c80d2c59d3b198ab1af2a0&token=web-h5-0-60937-28e3e2ddb065abb25a02c16f29ff30eb3a0a97520395a5c7&logo=0&expire=0&did=e87182f8dc206fd3f4a595c700041501&ver=Douyu_220051305&pt=2&st=0&origin=all&mix=0&isp=
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