<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PageInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/21 15:28
 *  文件描述 :  管理员登录数据接口申明
 *  历史记录 :  -----------------------
 */
namespace app\page_module\working_version\v1\dao;

interface PageInterface
{
    /**
     * 名  称 : adminSelect()
     * 功  能 : 声明：获取所有管理员信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['adminPhone']    => '手机号';
     * 输  入 : (String) $post['adminPassword'] => '密码';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/20 09:34
     */
    public function adminSelect($post);
}