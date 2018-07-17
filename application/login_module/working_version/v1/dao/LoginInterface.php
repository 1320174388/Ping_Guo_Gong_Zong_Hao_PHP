<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  LoginInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/13 13:19
 *  文件描述 :  用户初始化登录数据处理声明接口
 *  历史记录 :  -----------------------
 */
namespace app\login_module\working_version\v1\dao;

interface LoginInterface{

    /**
     * 名  称 : loginCreate()
     * 功  能 : 声明：保存用户openid，及网页授权信息,返回admin_token主键
     * 变  量 : --------------------------------------
     * 输  入 : (Array) $wxArray = [
     *              'access_token'  => '网页授权令牌',
     *              'expires_in'    => '授权令牌过期时间',
     *              'refresh_token' => '令牌刷新标识',
     *              'openid'        => '用户openId',
     *              'scope'         => '这个字段没用，不用管',
     *          ];
     * 输  出 : ['msg'=>'success','data'=>'user_token主键']
     * 创  建 : 2018/07/13 13:19
     */
    public function loginCreate($wxArray);

    /**
     * 名  称 : loginUpdate()
     * 功  能 : 声明：修改用户网页授权信息,返回admin_token主键
     * 变  量 : --------------------------------------
     * 输  入 : (Array) $wxArray = [
     *              'access_token'  => '网页授权令牌',
     *              'expires_in'    => '授权令牌过期时间',
     *              'refresh_token' => '令牌刷新标识',
     *              'openid'        => '用户openId',
     *              'scope'         => '这个字段没用，不用管',
     *          ];
     * 输  出 : ['msg'=>'success','data'=>'admin_token主键']
     * 创  建 : 2018/07/13 13:50
     */
    public function loginUpdate($wxArray);

    /**
 * 名  称 : loginSelect()
 * 功  能 : 声明：获取用户数据
 * 变  量 : --------------------------------------
 * 输  入 : (Array) $wxArray = [
 *              'openid'        => '用户openId',
 *          ];
 * 输  出 : ['msg'=>'success','data'=>'数据']
 * 创  建 : 2018/07/13 14:05
 */
    public function loginSelect($wxArray);
}