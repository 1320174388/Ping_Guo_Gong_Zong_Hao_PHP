<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  page_route.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/20 16:27
 *  文件描述 :  后台路由文件
 *  历史记录 :  -----------------------
 */

// +---------------------------------------------
// : 前台接口
// +---------------------------------------------
Route::group('v1/page_module/', function(){

    // ---- 后台登录 ----

    /**
     * 路由名称：admin_preposition
     * 传值方式：GET,
     * 路由功能：管理员登录前置接口
     */
    Route::get(
        'admin_preposition',
        'right_module/v1.controller.PageController/adminPreposition'
    );

    /**
     * 路由名称：admin_login
     * 传值方式：GET,
     * 路由功能：显示管理员登录页面
     */
    Route::get(
        'admin_login',
        'right_module/v1.controller.PageController/applyLogin'
    );
});

// +---------------------------------------------
// : 功能接口,需要权限验证接口
// +---------------------------------------------
Route::group('v1/page_module/', function(){

})->middleware('Login_v1_IsToken');

// +---------------------------------------------
// : 后台接口,需要权限验证接口
// +---------------------------------------------
Route::group('v1/page_module/', function(){

})->middleware('Right_v1_IsAdmin');