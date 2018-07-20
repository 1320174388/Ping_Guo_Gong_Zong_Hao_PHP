<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/20 01:07
 *  文件描述 :  权限管理：管理员控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\controller;
use think\Controller;
use app\right_module\working_version\v1\service\AdminService;

class AdminController extends Controller
{
    /**
     * 名  称 : adminList()
     * 功  能 : 获取所有管理员信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : {"errNum":1,"retMsg":"请求成功","retData":"数据"}
     * 创  建 : 2018/07/20 01:11
     */
    public function adminList()
    {
        // 引入AdminService代码,获取所有管理员信息
        $adminList = (new AdminService())->adminAll();
        // 验证写入数据
        if($adminList['msg']=='error')
            // 返回错误数据
            return returnResponse(1,$adminList['data']);
        // 返回正确数据
        return returnResponse(0,'请求成功',$adminList['data']);
    }
}