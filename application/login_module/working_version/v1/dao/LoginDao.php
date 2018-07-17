<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  LoginDao.php
 *  创 建 者 :  Qi Yun Hai
 *  创建日期 :  2018/07/13 14:24
 *  文件描述 :  用户初始化登录数据处理声明Dao层
 *  历史记录 :  -----------------------
 */
namespace app\login_module\working_version\v1\dao;

use app\login_module\working_version\v1\model\LoginModel;
use think\Db;

class LoginDao implements LoginInterface
{
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
     * 创  建 : 2018/07/13 14:30
     */
    public function loginCreate($wxArray)
    {
        // 启动事务
        Db::startTrans();
        try {
            // 实例化用户登陆model
            $loginModel = new LoginModel();
            // 获取用户登陆信息保存到数据库
            $loginModel->user_token    = md5(uniqid());
            $loginModel->user_openid   = $wxArray['openid'];
            $loginModel->user_time     = time();
            $loginModel->access_token  = $wxArray['access_token'];
            $loginModel->access_time   = time();
            $loginModel->refresh_token = $wxArray['refresh_token'];
            // 验证
            if(!$loginModel->save())
                return returnData('error',false);

            // 提交事务      // 返回数据格式
            Db::commit();   return returnData('success',true);

        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback(); return returnData('error',false);
        }
    }

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
     * 创  建 : 2018/07/13 14:53
     */
    public function loginUpdate($wxArray)
    {
        // 启动事务
        Db::startTrans();
        try {
            // 实例化用户登陆model
            $loginModel = new LoginModel();

            // 进行修改
            $res = $loginModel->save([
                $loginModel->access_token  = $wxArray['access_token'],
                $loginModel->access_time   = time(),
                $loginModel->refresh_token = $wxArray['refresh_token']
            ],['user_openid'=>$wxArray['openid']]);
            // 验证
            if(!$res)
                return returnData('error',false);

            // 提交事务
            Db::commit(); return returnData('success',true);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback(); return returnData('error',false);
        }
    }

    /**
     * 名  称 : loginSelect()
     * 功  能 : 声明：获取单条用户数据
     * 变  量 : --------------------------------------
     * 输  入 : (Array) $wxArray = [

     *              'openid'        => '用户openId',
     *          ];
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/13 15:30
     */
    public function loginSelect($wxArray)
    {
        // 查找并返回
        $list = LoginModel::where(
            'user_openid',
            $wxArray['openid']
        )->find();
        // 验证
        if(!$list) return returnData('error');
        // 返回数据格式
        return returnData('success',$list);
    }
}