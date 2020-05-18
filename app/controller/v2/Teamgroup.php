<?php
declare (strict_types=1);

namespace app\controller\v2;


use app\BaseController;
use app\model\TeamGroupModel;


class Teamgroup extends BaseController
{
    public function index()
    {

        $result = (new TeamGroupModel())->select();

        $data = [
            'code' => 200,
            'result' => $result
        ];

        return json($data);
//        "merchant_id":106301,
//        "user_id":3400706,
//        "user_level":1,
//        "currency":"RMB",
//        "total_stake":"80.00",
//        "total_bet_bonus":"142.40",
//        "order":[
//            {
//                "oddsId":37610608,
//                "title":"Khan - VS - Cyber Legacy"
//                ,"order_type":0,
//                "stake":"80",
//                "order_detail":{
//                "odds_group_id":16778,
//                "value":"",
//                "win":-1,
//                "status":1,
//                "bet_limit":[10, 1000],
//                "last_update":"1587475229",
//                "match_stage":"final",
//                "match_name":"Khan - VS - Cyber Legacy",
//                "group_name":"获胜者",
//                "group_short_name":"Winner",
//                "id":37610608,
//                "odds_id":37610608,
//                "team_id":28142394,
//                "name":"Khan",
//                "match_id":37186068,
//                "odds":"1.78",
//                "tag":"win",
//                "game_id":151,
//                "start_time":"2020-04-21 22:00:00",
//                "end_time":"2020-04-22 04:00:00",
//                "enable_parlay":0,
//                "groupName":"获胜者",
//                "short_title":"Khan",
//                "title":"获胜者 Khan",
//                "isLive":false,
//                "live":0
//            },
//                "minStake":10,
//                "maxStake":1000,
//                "overMaxStake":false,
//                "betTitle":"全场 获胜者"
//                ,"live":0
//            }]};

   }

    //创建比赛
    public function create(){

    }
    public function update(){

    }
}