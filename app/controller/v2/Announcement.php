<?php
declare (strict_types=1);

namespace app\controller\v2;


use app\controller\Base;

use app\model\AnnouncementModel;



class Announcement extends Base
{
    /**获得自身比赛
     * @return \think\response\Json
     */

    public function index()
    { //开发完毕

        $paging = Request()->only(['page', 'limit', 'sort']);



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

            $result = (new AnnouncementModel())->order("{$paging['sort']} desc")->paginate([
                'list_rows' => $paging['limit'],
                'page' => $paging['page']
            ]);




        $data = [
            'code' => 200,
            'result' => $result
        ];


        return json($data);


    }


}