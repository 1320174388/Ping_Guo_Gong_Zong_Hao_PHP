<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  login_route.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/27 10:35
 *  文件描述 :  前台页面路由文件
 *  历史记录 :  -----------------------
 */

// +---------------------------------------------
// : 前台接口,判断前端是否是有Token值
// +---------------------------------------------
Route::group('v1/login_module/', function(){
    /**
     * 路由名称：login_route
     * 传值方式：GET,
     * 路由功能：公众号初始化接口
     */
    Route::get(
        'login_route',
        'login_module/v1.controller.LoginController/loginRoute'
    );
    /**
     * 路由名称：login_init
     * 传值方式：GET,
     * 路由功能：通过code换取网页授权access_token，显示首页
     */
    Route::get(
        'login_init',
        'login_module/v1.controller.LoginController/loginInit'
    );
});
//->middleware('Login_v1_IsToken');