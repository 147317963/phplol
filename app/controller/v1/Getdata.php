<?php


namespace app\controller\v1;


use app\BaseController;
use app\model\GameModel;
use app\model\OddsGroupModel;
use app\model\TeamModel;
use app\model\TournamentModel;
use think\db\Where;

class Getdata extends BaseController
{
    public function gameList()
    {
        // 创建一个新cURL资源
        $ch = curl_init();
        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL, "https://incpgameinfo.esportsworldlink.com/v2/game");
        curl_setopt($ch, CURLOPT_HEADER, false);
        // 抓取URL并把它传递给浏览器
        $data = curl_exec($ch);
//        dump($data);
        //关闭cURL资源，并且释放系统资源
        curl_close($ch);

    }


    public function team()
    {


//        for ($i = 1; $i < 50; $i++) {

// 创建一个新cURL资源
            $ch = curl_init();
            // 设置URL和相应的选项
            curl_setopt($ch, CURLOPT_URL, "https://incpgameinfo.esportsworldlink.com/v2/match?page=1&match_type=2");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HEADER, false);
            // 抓取URL并把它传递给浏览器
            $result = curl_exec($ch);

            //关闭cURL资源，并且释放系统资源
            curl_close($ch);

            $data = json_decode($result, true);
//            if (!isset($data['result'])){
//
//            }

            foreach ($data['result'] as $key => $value) {
                $gamelist = (new GameModel())->Where(['game_name' => $value['game_name']])->find();

                foreach ($value['team'] as $k => $v) {

                    $result = (new TeamModel())->Where(['team_name' => $v['team_name']])->find();
//                dump($v);
//                exit;
                    if ($gamelist) {
                        if (!$result) {
                            $v['game_id'] = $gamelist['id'];
                            $v['game_name'] = $gamelist['game_name'];
                            $team = new TeamModel();
                            $team->allowField(['team_name', 'team_short_name', 'team_logo', 'game_id', 'game_name'])->save($v);

                        }
                    }


                }


            }
//        }



    }

    /**
     *比赛名称
     */
    public function tournament()
    {

        // 创建一个新cURL资源
        $ch = curl_init();
        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL, "https://incpgameinfo.esportsworldlink.com/v2/match?page=1&match_type=2");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HEADER, false);
        // 抓取URL并把它传递给浏览器
        $result = curl_exec($ch);

        //关闭cURL资源，并且释放系统资源
        curl_close($ch);

        $data = json_decode($result, true);


        foreach ($data['result'] as $key => $value) {


            $gamelist = (new GameModel())->Where(['game_name' => $value['game_name']])->find();

            $result = (new TournamentModel())->where(['tournament_name' => $value['tournament_name']])->find();

//

            if ($gamelist) {
                if (!$result) {
                    $value['game_id'] = $gamelist['id'];
                    $team = new TournamentModel();
                    $team->allowField(['game_id', 'game_name', 'tournament_name', 'tournament_short_name'])->save($value);


                }
            }


        }

    }

    /**
     * 添加玩法
     */
    public function oddsGroup()
    {

        // 创建一个新cURL资源
        $ch = curl_init();
        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL, "https://incpgameinfo.esportsworldlink.com/v2/odds?match_id=37181992");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_HEADER, false);
        // 抓取URL并把它传递给浏览器
        $result = curl_exec($ch);

        //关闭cURL资源，并且释放系统资源
        curl_close($ch);

        $data = json_decode($result, true);


        $gamelist = (new GameModel())->Where(['game_name' => $data['result']['game_name']])->find();


        if (isset($data['result']['odds'])) {
            foreach ($data['result']['odds'] as $k => $v) {
                $result = (new OddsGroupModel())->where(['odds_group_name' => $v['group_name'], 'game_name' => $gamelist['game_name']])->find();


                if (!$result) {
                    $v['odds_group_name'] = $v['group_name'];
                    $v['odds_group_short_name'] = $v['group_short_name'];
                    $v['game_id'] = $gamelist['id'];
                    $v['game_name'] = $gamelist['game_name'];
                    $oddsgroup = new OddsGroupModel();
                    $oddsgroup->allowField(['game_name', 'game_id', 'odds_group_name', 'odds_group_short_name'])->save($v);


                }

            }
        }


    }
}