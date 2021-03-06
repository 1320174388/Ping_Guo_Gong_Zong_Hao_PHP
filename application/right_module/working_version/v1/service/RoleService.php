<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 20:23
 *  文件描述 :  职位管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\service;
use app\right_module\working_version\v1\dao\RoleDao;

class RoleService
{
    /**
     * 名  称 : roleAll()
     * 功  能 : 获取职位信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/19 10:35
     */
    public function roleAll()
    {
        // 引入Dao层代码，获取数据
        $res = (new RoleDao())->roleSelect();
        // 验证数据
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',$res['data']);
    }

    /**
     * 名  称 : roleAdd()
     * 功  能 : 添加职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['roleName'] => '职位名称';
     * 输  入 : (String) $post['roleInfo'] => '职位介绍';
     * 输  入 : (String) $post['rightStr'] => '权限标识';
     * 输  入 : (Array)  $rightArr         => '权限标识数组';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/18 20:25
     */
    public function roleAdd($post,$rightArr)
    {
        // 执行数据写入
        $res = (new RoleDao())->roleCreate($post,$rightArr);
        // 验证数据
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',$res['data']);
    }

    /**
     * 名  称 : roleEdit()
     * 功  能 : 添加职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['roleIndex'] => '职位主键';
     * 输  入 : (String) $post['roleName']  => '职位名称';
     * 输  入 : (String) $post['roleInfo']  => '职位介绍';
     * 输  入 : (String) $post['rightStr']  => '权限标识';
     * 输  入 : (Array)  $rightArr          => '权限标识数组';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/18 20:25
     */
    public function roleEdit($post,$rightArr)
    {
        // 执行数据修改
        $res = (new RoleDao())->roleUpdate($post,$rightArr);
        // 验证数据
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',$res['data']);
    }

    /**
     * 名  称 : roleDel()
     * 功  能 : 删除职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $roleIndex => '职位主键';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/19 14:43
     */
    public function roleDel($roleIndex)
    {
        // 执行数据删除
        $res = (new RoleDao())->roleDelete($roleIndex);
        // 验证数据
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',$res['data']);
    }
}