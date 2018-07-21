<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PageController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/20 01:07
 *  文件描述 :  权限管理：管理员控制器
 *  历史记录 :  -----------------------
 */
namespace app\page_module\working_version\v1\controller;
use think\Controller;
use think\Request;
use app\login_module\working_version\v1\library\LoginLibrary;

class PageController extends Controller
{
    /**
     * 名  称 : applyPreposition()
     * 功  能 : 管理员登录前置接口
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/16 11:15
     */
    public function applyPreposition()
    {
        // 获取项目域名
        $projectUrl = $_SERVER["REQUEST_SCHEME"].'://';
        $projectUrl.= $_SERVER["SERVER_NAME"];
        $projectUrl.= '/v1/page_module/admin_login';
        // 处理项目域名
        $route = urlencode($projectUrl);
        // 拼接公众号登录地址
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize';
        $url.= '?appid='.config('v1_config.AppID');
        $url.= '&redirect_uri='.$route;
        $url.= '&response_type=code&scope=snsapi_base';
        $url.= '&state=STATE#wechat_redirect';
        // 跳转公众号后台登录页面
        return '<script>window.location.replace("'.$url.'");</script>';
    }

    /**
     * 名  称 : applyLogin()
     * 功  能 : 显示管理员登录页面
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/16 11:15
     */
    public function applyLogin(Request $request)
    {
        // 获取code
        $code = $request->get('code');
        // 通过code换取网页授权access_token显示首页
        $array = (new LoginLibrary())->loginLibrary($code);
        // 验证token值
        if($array['msg']=='error') return "<h1>{$array['data']}<h1>";
        // 获取用户申请管理员操作页面地址
        $url = config('html_config.HTTP_URL');
        $url.= config('html_config.Admin_Login');
        // 显示注册页面视图
        return "<script>
                    window.location.replace('{$url}?token={$array['data']}');
               </script>";
    }

    /**
     * 名  称 : moduleList()
     * 功  能 : 获取管理模块信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/21 10:29
     */
    public function moduleList()
    {
        return "<h1>获取管理模块信息</h1>";
    }
}