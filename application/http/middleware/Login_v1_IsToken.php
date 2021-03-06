<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  Login_v1_IsToken.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/16 09:42
 *  文件描述 :  v1_权限管理模块中间件
 *  历史记录 :  -----------------------
 */
namespace app\http\middleware;
use think\facade\Session;
use think\Request;

class Login_v1_IsToken
{
    /**
     * 名  称 : handle()
     * 功  能 : 权限认证中间件
     * 变  量 : --------------------------------------
     * 输  入 : (string) $token => '用户标识';
     * 输  出 : {"errNum":102,"retMsg":"权限不足","retData":false}
     * 创  建 : 2018/06/23 10:23
     */
    public function handle(Request $request,\Closure $next)
    {
        // 获取域名独立Session信息
        $strMd5 = md5($_SERVER["SERVER_NAME"].'login_user_token');
        // 获取配置信息HttpKey值
        $httpKey = config('html_config.HTTP_KEY');
        // 获取请求头信息HttpKey值,判断Session信息是否存在
        $str = $request->header('http-key');
        if(($str!==$httpKey)
//            ||(!Session::get($strMd5))
        )
        {
            return redirect('/');
        }else{
            return $next($request);
        }
    }
}
