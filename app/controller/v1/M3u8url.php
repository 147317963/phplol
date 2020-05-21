<?php


namespace app\controller\v1;


use app\BaseController;

class M3u8url extends BaseController
{
    public function raybet()
    {
        // 创建一个新cURL资源
        $url = Request()->param('url');


        $url = 'https://www.douyu.com/lapi/live/getH5Play/1203352';

        $header = [
            'origin:' . 'https://www.douyu.com',
            'referer:' . "{$url}",
            'accept:'.'application/json, text/plain, */*',
        ];

        //设置post数据

        $post_data = [
            'cdn' => '',
            'rate' => -1,
            'ver' => 'Douyu_220051805',
            'iar' => '1',
            'ive' => 0,
            'ct' => 0,
            'cr' => 0,
            'tr' => 8,
            'q' => '044cf96dcf90acc40dc4f1b06ad672525c37cc8bbe7315b3813e88178e0266c76e9646f08c5e64bd7aabcdda5bf0caef145c9ebb824b57604f738913756bb1c0611defb3a1f1a9881f445f2c4bc39a8dd72990be86bdda968859e005310a5b6186de95b3d8eb0e67dc3f8462b06193d322de1ffc6f048d19ecba556e7bb8a2f8f77f9a21befa4cad5022d46bbf7d7853d651346c653a896fed41bc0391933d9a',
            'e' => '0C6fcf2029a2972185bcc6640a1bcf84cbaf8c6a064c8963abe156200cfd9da54ae10d642e1ef92dc18015d8673658a40230efafc9a755daa93121347cd2ed94ef5dea2a59e830423b7565a5aa3401db6a5f5cea3c54af66ed0cd0859d6f182554c0657634a3a412571a0a9e3351b5537657b224ac5a64454caca9195ca7df982f4e70ccac237a8011ee8fab7346f962383f43f7587a746ba1b50f14c36f330e6481985626e42e614c461a6c614e3f1595c218b858f7295e61343e854c47e34bd49a945386a09ec3c25c3d075b1d2948296b7d1083b0cda5d01349d19fc5e5acb41b9fdc556ff352f4a3f7090ca0fdafdf',
            'sov' => 1,
            'tt' => time().'000',
            'did' => 'eb6adfb03cf347e221fd6e8300081501',
//            'sign'=>'71396c52306debff23efd8961d38d726'

        ];
        $ch = curl_init();
        // 设置URL和相应的选项
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_HEADER, false);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-FORWARDED-FOR:111.222.333.4', 'CLIENT-IP:111.222.333.4']);

//        curl_setopt($ch, CURLOPT_REFERER, "http://www.test.com");
//        curl_setopt($ch, CURLOPT_PROXY, "http://125.123.156.138:3000");
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/536.11 (KHTML, like Gecko) Chrome/20.0.1132.57 Safari/536.11");

        // POST数据

        curl_setopt($ch, CURLOPT_POST, 1);

        // 把post的变量加上
       curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        // 抓取URL并把它传递给浏览器
        $data = curl_exec($ch);
//        dump($data);
        //关闭cURL资源，并且释放系统资源
        curl_close($ch);
        $data = json_decode($data);

        dump ($data);
        echo $data->data->rtmp_url;
        echo $data->data->multirates[0]->name;

    }


}