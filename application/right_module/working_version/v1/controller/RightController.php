<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 18:24
 *  文件描述 :  权限管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\controller;
use think\Controller;
use app\right_module\working_version\v1\service\RightService;

class RightController extends Controller
{
    /**
     * 名  称 : rightList()
     * 功  能 : 获取所有权限管理信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/18 18:25
     */
    public function rightList()
    {
        // 引入Service层代码，获取所有管理员权限
        $rightList = (new RightService())->rightAll();
        // 验证是否获取成功
        if($rightList['msg']=='error')
            return returnResponse(1,$rightList['data']);
        // 返回正确数据
        return returnResponse(0,$rightList['data'],true);

    }
}