<?php
/**
 *  版权声明 :  地老天荒科技（北京）有限公司
 *  文件名称 :  LoginLibrary.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 19:27
 *  文件描述 :  处理用户登录类，获取用户openid
 *  历史记录 :  -----------------------
 */
namespace app\login\library;

class LoginLibrary
{
    /**
     * 名  称 : userOpenid()
     * 功  能 : 获取用户openid
     * 变  量 : --------------------------------------
     * 输  入 : (string) $code      => '用户临时登录code凭证';
     * 输  入 : (string) $appId     => '小程序AppId';
     * 输  入 : (string) $appSecret => '小程序AppSecret秘钥';
     * 输  出 : [ 'msg' => 'success', 'data' => true ]
     * 输  出 : [ 'msg' => 'error',  'data' => false ]
     * 创  建 : 2018/06/12 21:48
     */
    public function userOpenid($code,$appId,$appSecret)
    {
        return returnData('success',['token'=>$code]);
    }
}