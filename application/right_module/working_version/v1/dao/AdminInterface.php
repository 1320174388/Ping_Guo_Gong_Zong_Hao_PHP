<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/20 09:32
 *  文件描述 :  管理员模型数据处理声明接口
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;

interface AdminInterface
{
    /**
     * 名  称 : adminSelect()
     * 功  能 : 声明：获取所有管理员信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/20 09:34
     */
    public function adminSelect();

    /**
     * 名  称 : adminUpdate()
     * 功  能 : 声明：修改管理员信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $put['adminToken']      => '管理员标识';
     * 输  入 : (String) $put['adminName']       => '管理员名称';
     * 输  入 : (String) $put['adminPassward']   => '管理员密码';
     * 输  入 : (String) $put['adminRePassword'] => '确认密码';
     * 输  入 : (String) $put['roleString']      => '职位标识';
     * 输  入 : (String) $roleArr                => '职位数组';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/20 14:58
     */
    public function adminUpdate($put,$roleArr);

    /**
     * 名  称 : adminDelete()
     * 功  能 : 声明：删除管理员信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $adminToken => '管理员标识';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/20 15:36
     */
    public function adminDelete();
}