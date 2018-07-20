<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 15:37
 *  文件描述 :  用户申请管理员业务逻辑
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\service;
use app\right_module\working_version\v1\dao\AdminDao;
use app\right_module\working_version\v1\validator\AdminValidate;

class AdminService
{
    /**
     * 名  称 : adminAll()
     * 功  能 : 获取所有管理员信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/20 09:17
     */
    public function adminAll()
    {
        // 执行数据获取
        $res = (new AdminDao())->adminSelect();
        // 验证数据
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',$res['data']);
    }

    /**
     * 名  称 : adminEdit()
     * 功  能 : 修改管理员信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $put['adminToken']      => '管理员标识';
     * 输  入 : (String) $put['adminName']       => '管理员名称';
     * 输  入 : (String) $put['adminPassward']   => '管理员密码';
     * 输  入 : (String) $put['adminRePassword'] => '确认密码';
     * 输  入 : (String) $put['roleString']      => '职位标识';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/20 14:22
     */
    public function adminEdit($put)
    {
        // 引入Validate数据验证器
        $validate = new AdminValidate();
        // 验证请求数据
        if(!$validate->check($put))
            // 返回错误数据
            return returnData(1,$validate->getError());

        // 处理职位标识
        $roleArr = explode(',',$put['roleString']);

        // 执行数据获取
        $res = (new AdminDao())->adminUpdate($put,$roleArr);
        // 验证数据
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',$res['data']);
    }
}