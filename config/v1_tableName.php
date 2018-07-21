<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  v1_tableName.php
 *  创 建 者 :  Shi Guang
 *
 * u
 *  创建日期 :  2018/06/15 09:13
 *  文件描述 :  模块数据表配置文件
 *  历史记录 :  -----------------------
 */
return [
    // 用户表
    'LoginTable' => 'data_home_users',
    // 超级管理员用户表
    'UniqueTable'=> 'data_admin_unique',
    // 管理员申请表
    'ApplyTable' => 'data_admin_apply',
    // 管理员表
    'AdminTable' => 'data_admin_users',
    // 职位表
    'RoleTable'  => 'data_admin_roles',
    // 权限表
    'RightTable' => 'data_admin_rights',
    // 管理职位管理表
    'AdminRole'  => 'index_user_roles',
    // 职位权限关联表
    'RoleRight'  => 'index_role_rights'
];