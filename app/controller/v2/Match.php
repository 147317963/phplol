<?php
declare (strict_types=1);

namespace app\controller\v2;


use app\controller\Base;
use app\model\MatchCreateModel;
use app\model\MatchModel;
use app\model\TeamModel;
use app\validate\MatchValidate;
use think\facade\Cache;
use think\Request;


class Match extends Base
{
    /**获得自身比赛
     * @return \think\response\Json
     */
    public function index()
    {

        $paging = Request()->only(['page', 'limit', 'sort', 'status', 'search']);
        $map[] = ['m.uid', '=', $this->uid];
        //判断该变量key是否存在            //判断该key是否为空
        if (isset($paging['status']) && !empty($paging['status'])) {
            $map[] = ['mc.status', '=', $paging['status']];
        }
        //判断该变量key是否存在            //判断该key是否为空
        if (isset($paging['search']) && !empty($paging['search'])) {
            //模糊查询
            $map[] = ['mc.game_name', 'like', '%' . $paging['search'] . '%'];
        }
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


        //
        $result = (new MatchModel())->alias('m')
            ->field('m.*,
            game_id,game_name,live_url,match_name,match_short_name,round,status,start_time,end_time,tournament_id,
            tournament_name,tournament_short_name
            ')
            ->leftJoin('think_match_create mc','m.match_create_id = mc.id')->where($map)->order("{$paging['sort']} desc")
            ->paginate([
                'list_rows' => $paging['limit'],
                'page' => $paging['page']
            ])->each(function ($item, $key){

                $item['team']=(new TeamModel())->where(['match_create_id'=>$item->match_create_id])->order('pos asc')->select();

            });





        $data = [
            'code' => config('apicanche.succeed'),
            'result' => $result
        ];


        return json($data);


    }

    //接入总盘赛事
    public function create()
    {

        $data = Request()->only(['match_create_id']);
        $validate = new MatchValidate();
        $result = $validate->scene('create')->check($data);
        if (!$result) {
            return json($validate->getError());
        }
        //获取未开始 或者滚盘中的比赛
        $map[] = ['status', 'in', '1,2'];
        $map[] = ['id', '=', $data['match_create_id']];
       if (empty((new MatchCreateModel())->where($map)->whereTime('end_time', '>=', time())->find())){
           $data = [
               'code' => config('apicanche.erro'),
               'message' => '温馨提示:请核实赛事情况'
           ];
           return json($data);
       };
       if(!empty((new MatchModel())->where(['username'=>$this->username,'match_create_id'=>$data['match_create_id']])->find())){
           $data = [
               'code' => config('apicanche.erro'),
               'message' => '温馨提示:相同赛事只能建立一个'
           ];
           return json($data);
       }

        $MatchModel = new MatchModel();

        $MatchModel->uid = $this->uid;
        $MatchModel->username = $this->username;
        $MatchModel->match_create_id = $data['match_create_id'];
        $MatchModel->save();

        $data = [
            'code' => config('apicanche.succeed'),
            'message' => '创建赛事成功'
        ];
        return json($data);






    }

}