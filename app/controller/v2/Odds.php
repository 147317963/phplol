<?php
declare (strict_types=1);

namespace app\controller\v2;


use app\controller\Base;
use app\model\OddsModel;


class Odds extends Base
{
    /**获得自身比赛
     * @return \think\response\Json
     */
    public function index()
    { //开发完毕

        $paging = Request()->only(['page', 'limit', 'sort', 'status', 'odds_group_name']);

        $map[] = ['o.uid', '=', $this->uid];
        //判断该变量key是否存在            //判断该key是否为空
        if (isset($paging['status']) && !empty($paging['status'])) {
            $map[] = ['o.status', '=', $paging['status']];
        }
        //判断该变量key是否存在            //判断该key是否为空
        if (isset($paging['match_name']) && !empty($paging['match_name'])) {
            //模糊查询
            $map[] = ['o.match_name', 'like', '%' . $paging['match_name'] . '%'];
        }
        //如果key不存在      或者       key为空                       不是数字
        if (!isset($paging['page']) || empty($paging['page']) || !is_numeric($paging['page'])) {
            $paging['page'] = 1;
        }
        //如果key不存在      或者       key为空                       不是数字
        if (!isset($paging['limit']) || empty($paging['limit']) || !is_numeric($paging['limit'])) {
            $paging['limit'] = 20;
        }
        if (!isset($paging['sort']) || empty($paging['sort']) || !is_string($paging['limit'])) {
            $paging['sort'] = 'o.id';
        }else{
            $paging['sort'] = 'o.'.$paging['sort'];
        }

        $result = (new OddsModel())->alias('o')->field('o.*,m.game_name,m.tournament_name')
            ->leftJoin('think_match m','o.match_id = m.id')->where($map)->order("{$paging['sort']} desc")
            ->paginate([
                'list_rows' => $paging['limit'],
                'page' => $paging['page']
            ]);


        $data = [
            'code' => 200,
            'result' => $result
        ];


        return json($data);


    }

    //创建比赛
    public function create()
    {


    }

    public function update()
    {


    }
}