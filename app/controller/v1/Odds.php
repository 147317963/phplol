<?php
declare (strict_types = 1);

namespace app\controller\v1;


use app\BaseController;
use app\model\MatchModel;
use app\model\OddsModel;
use app\model\ScoreModel;

class Odds extends BaseController
{

    public function index()
    {
        $MatchModel = (new MatchModel())->index();


        $ScoreModel = (new ScoreModel())->index();

        $OddsModel = (new OddsModel())->index();


        $team = [];
        $odds = [];


        foreach ($MatchModel as $key => $value) {


            //获取匹配的比赛团队
            foreach ($ScoreModel as $k => $v) {

                if ($value['id'] === $v['match_id']) {
                    $team[$v['pos']] = $v;
                }
            }
            $MatchModel[$key]['team'] = $team;


            //获取匹配的比赛团队
            foreach ($OddsModel as $k => $v) {

                if ($value['id'] === $v['match_id']) {
                    $odds[] = $v;
                }
            }
            $MatchModel[$key]['odds'] = $odds;


        }


//    dump(json($MatchModel));


        $data = [
            'code' => 200,
            'datas' => $MatchModel
        ];

//        dump($result);


        return json($data);
    }

}