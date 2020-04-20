<?php
declare (strict_types = 1);

namespace app\controller\v1;


use app\BaseController;
use app\model\MatchModel;
use app\model\OddsModel;
use app\model\ScoreModel;
use think\Container;
use think\swoole\Websocket;

class Odds extends BaseController
{

    public $websocket = null;

    public function __construct(Container $container)
    {
        $this->websocket = $container->make(Websocket::class);
    }

    public function index()
    {
        $MatchModel = (new MatchModel())->getModelData();


        $ScoreModel = (new ScoreModel())->getModelData();

        $OddsModel = (new OddsModel())->getModelData();


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

    public function updateOdds(){
        $result = (new OddsModel())->select()->toArray();
        $data=[
            'source'=>'odds',
            'odds'=>$result
        ];

        $this->websocket->to('match')->emit('matchCallback',$data);
    }
}