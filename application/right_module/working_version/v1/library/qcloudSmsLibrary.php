<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  qcloudSmsLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/10 11:25
 *  文件描述 :  用户申请管理员控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\library;

class qcloudSmsLibrary
{
    /**
     * 腾讯云短信配置信息
     */
    protected $config = [];

    /**
     * 初始化配置信息
     */
    public function __construct()
    {
        $this->config = [
            'appid' => config('qcloud_config.Appid'),
            'appkey' => config('qcloud_config.Appkey'),
        ];
    }

    /**
     * 名  称 : sendMessige
     * 功  能 : 发送短信接口
     * 变  量 : --------------------------------------
     * 输  入 : (String) $phoneNumber => '电话号码';
     * 输  入 : (String) $textMessage => '短信内容';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/10 15:21
     */
    public function sendMessige($phoneNumber,$textMessage)
    {
        // 单发短信
        try {
            // 获取配置信息
            $sender = new SmsSingleSender(
                $this->config['appid'],
                $this->config['appkey']
            );
            $result = $sender->send(
                0, "86",
                $phoneNumber,
                $textMessage,
                "", ""
            );
            $rsp = json_decode($result,true);
            // 返回数据
            return returnData('success',$rsp);
        } catch(\Exception $e) {
            // 返回错误
            return returnData('error',$e);
        }
    }
}