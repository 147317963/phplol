<?php


namespace app\model;


use think\facade\Cache;
use think\Model;

class UserModel extends Model
{
    protected $name = 'user';
    protected $autoWriteTimestamp = 'timestamp';   // 开启自动写入时间戳


    protected $insert = ['date'];//数据完成


    //数据完成
    protected function setDateAttr()
    {
        return date('Y-m-d',time());
    }


    //更新model数据后 把数据缓存到redis
    public static function onBeforeUpdate($user)
    {
        Cache::store('redis')->set(config('apicanche.user.info') . $user['username'], $user, config('apicanche.user.expire'));


    }

    /**
     * @param string $username
     * @return Model
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getCache(string $username):Model
    {
        //没有转换 实际储存的是模型对象
        $result = Cache::store('redis')->get(config('apicanche.user.info') . $username);

        if ($result == null) {
            $result = $this->where(['username' => $username])->find();
            if ($result != null) {
                //不是空的值就缓存
                Cache::store('redis')->set(config('apicanche.user.info') . $username, $result, config('apicanche.user.expire'));


            }
        }
        return $result;
    }

}