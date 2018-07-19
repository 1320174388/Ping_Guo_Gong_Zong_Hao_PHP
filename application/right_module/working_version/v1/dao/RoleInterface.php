<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 20:28
 *  文件描述 :  数据持久层,操作Role：Model模型处理数据
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;

interface RoleInterface
{
    /**
     * 名  称 : roleSelect()
     * 功  能 : 声明：获取职位信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/19 10:37
     */
    public function roleSelect();

    /**
     * 名  称 : roleCreate()
     * 功  能 : 声明：添加职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['roleName'] => '职位名称';
     * 输  入 : (String) $post['roleInfo'] => '职位介绍';
     * 输  入 : (String) $post['rightStr'] => '权限标识';
     * 输  入 : (Array)  $rightArr         => '权限标识数组';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/18 20:29
     */
    public function roleCreate($post,$rightArr);

    /**
     * 名  称 : roleUpdate()
     * 功  能 : 声明：修改职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['roleIndex'] => '职位主键';
     * 输  入 : (String) $post['roleName']  => '职位名称';
     * 输  入 : (String) $post['roleInfo']  => '职位介绍';
     * 输  入 : (String) $post['rightStr']  => '权限标识';
     * 输  入 : (Array)  $rightArr          => '权限标识数组';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/19 11:03
     */
    public function roleUpdate($post,$rightArr);

    /**
     * 名  称 : roleDelete()
     * 功  能 : 声明：删除职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $roleIndex => '职位主键';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/19 16:23
     */
    public function roleDelete($roleIndex);
}