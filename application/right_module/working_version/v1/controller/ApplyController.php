<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ApplyController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/27 10:35
 *  文件描述 :  用户申请管理员控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\controller;
use think\Controller;
use think\Request;
use think\facade\Cache;
use app\login_module\working_version\v1\library\LoginLibrary;
use app\right_module\working_version\v1\validator\ApplyValidate;
use app\right_module\working_version\v1\validator\CodeValidate;
use app\right_module\working_version\v1\library\qcloudSmsLibrary;
use app\right_module\working_version\v1\service\ApplyService;

class ApplyController extends Controller
{
    /**
     * 名  称 : applyPreposition()
     * 功  能 : 管理员注册前置接口
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
        $projectUrl.= '/v1/right_module/login_register';
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
     * 名  称 : applyRegister()
     * 功  能 : 显示管理员注册页面
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/16 11:15
     */
    public function applyRegister(Request $request)
    {
        // 获取code
        $code = $request->get('code');
        // 通过code换取网页授权access_token显示首页
        $array = (new LoginLibrary())->loginLibrary($code);
        // 验证token值
        if($array['msg']=='error') return "<h1>{$array['data']}<h1>";
        // 获取用户申请管理员操作页面地址
        $url = config('html_config.HTTP_URL');
        $url.= config('html_config.Admin_Register');
        // 显示注册页面视图
        return "<script>
                    window.location.replace('{$url}?token={$array['data']}');
               </script>";
    }

    /**
     * 名  称 : applyInit()
     * 功  能 : 执行用户申请管理员操作
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['applyToken']      => '身份令牌';
     * 输  入 : (String) $post['applyName']       => '用户名';
     * 输  入 : (String) $post['applyPassward']   => '申请密码';
     * 输  入 : (String) $post['applyRePassword'] => '申请密码';
     * 输  入 : (String) $post['applyPhone']      => '手机号';
     * 输  入 : (String) $post['applyCode']       => '验证码';
     * 输  出 : {"errNum":1,"retMsg":"提示信息","retData":false}
     * 输  出 : {"errNum":0,"retMsg":"申请成功","retData":true}
     * 创  建 : 2018/07/18 13:10
     */
    public function applyInit(Request $request)
    {
        // 引入Validate数据验证器
        $validate = new ApplyValidate();
        // 验证请求数据
        if(!$validate->check($request->post()))
            // 返回错误数据
            return returnResponse(1,$validate->getError());
        // 获取缓存内验证吗
        $code = Cache::get($request->post('applyPhone'));
        // 判断验证码是否正确
        if($code !== $request->post('applyCode'))
        // 返回错误数据
        return returnResponse(1,'验证码错误');
        // 引入Service代码,写入数据
        $res = (new ApplyService())->applyAdd($request->post());
        // 验证写入数据
        if($res['msg']=='error')
        // 返回错误数据
        return returnResponse(0,$res['data']);
        // 返回正确数据
        return returnResponse(0,$res['data'],true);
    }

    /**
     * 名  称 : applyCode()
     * 功  能 : 给用户发送验证码
     * 变  量 : --------------------------------------
     * 输  入 : (String) $get['applyPhone']   => 手机号
     * 输  出 : {"errNum":1,"retMsg":"提示信息","retData":false}
     * 输  出 : {"errNum":0,"retMsg":"发送成功","retData":true}
     * 创  建 : 2018/07/10 10:54
     */
    public function applyCode(Request $request)
    {
        // 引入Validate数据验证器
        $validate = new CodeValidate();
        // 判断手机号是否发送
        if(!$validate->check($request->post()))
        // 返回错误数据
        return returnResponse(1,$validate->getError());
        // 生成验证码
        $code = mt_rand(111111,999999);
        $phoneNumber = $request->post('applyPhone');
        $textMessage = '您在中春果业平台做了申请管理员操作，验证码：';
        $textMessage.= $code;
        $textMessage.= '，请于5分钟之内填写。如非本人操作，请忽略本条短信。';
        $res = (new qcloudSmsLibrary())->sendMessige(
            $phoneNumber,
            $textMessage
        );
        if($res['msg']=='error') return returnResponse(1,'发送失败');
        // 写入文件缓存
        Cache::set($phoneNumber,$code,300);
        // 返回发送结果
        return returnResponse(0,'发送成功',true);
    }

    /**
     * 名  称 : applyList()
     * 功  能 : 获取所有管理员申请信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":1,"retMsg":"提示信息","retData":false}
     * 输  出 : {"errNum":0,"retMsg":"发送成功","retData":true}
     * 创  建 : 2018/07/18 17:09
     */
    public function applyList()
    {
        // 引入Service代码,写入数据
        $res = (new ApplyService())->applyAll();
        // 验证写入数据
        if($res['msg']=='error')
            // 返回错误数据
            return returnResponse(0,$res['data']);
        // 返回正确数据
        return returnResponse(0,$res['data'],true);
    }

    /**
     * 名  称 : applyPut()
     * 功  能 : 审核申请管理员接口
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":0,"retMsg":"设置成功","retData":true}
     * 创  建 : 2018/07/19 16:42
     */
    public function applyPut()
    {
        return "<h1>路由：apply_route，功能：审核申请管理员接口</h1>";
    }
}