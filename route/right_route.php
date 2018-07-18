<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  right_route.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/27 10:35
 *  文件描述 :  权限管理路由文件
 *  历史记录 :  -----------------------
 */

// +---------------------------------------------
// : 前台接口
// +---------------------------------------------
Route::group('v1/right_module/', function(){
    /**
     * 路由名称：login_preposition
     * 传值方式：GET,
     * 路由功能：管理员注册前置接口
     */
    Route::get(
        'login_preposition',
        'right_module/v1.controller.ApplyController/applyPreposition'
    );
    /**
     * 路由名称：login_register
     * 传值方式：GET,
     * 路由功能：管理员注册页面
     */
    Route::get(
        'login_register',
        'right_module/v1.controller.ApplyController/applyRegister'
    );
});

// +---------------------------------------------
// : 功能接口,需要权限验证接口
// +---------------------------------------------
Route::group('v1/right_module/', function(){
    /**
     * 路由名称：apply_route
     * 传值方式：POST,
     * 路由功能：管理员申请接口
     */
    Route::post(
        'apply_route',
        'right_module/v1.controller.ApplyController/applyInit'
    );
    /**
     * 路由名称：apply_route
     * 传值方式：POST,
     * 路由功能：发送验证码
     */
    Route::post(
        'apply_code',
        'right_module/v1.controller.ApplyController/applyCode'
    );
})->middleware('Login_v1_IsToken');

// +---------------------------------------------
// : 后台接口,需要权限验证接口
// +---------------------------------------------
Route::group('v1/right_module/', function(){

    // ---- 申请管理 ----

    /**
     * 路由名称：apply_route
     * 传值方式：GET,
     * 路由功能：获取所有管理员申请信息
     */
    Route::get(
        'apply_route',
        'right_module/v1.controller.ApplyController/applyList'
    );

    // ---- 职位管理 ----

    /**
     * 路由名称：role_route
     * 传值方式：POST,
     * 路由功能：添加职位
     */
    Route::post(
        'role_route',
        'right_module/v1.controller.RoleController/rolePost'
    );

    // ---- 权限管理 ----

    /**
     * 路由名称：right_route
     * 传值方式：GET,
     * 路由功能：获取所有权限管理信息
     */
    Route::get(
        'right_route',
        'right_module/v1.controller.RightController/rightList'
    );
})->middleware('Right_v1_IsAdmin');