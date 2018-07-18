<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 18:28
 *  文件描述 :  权限管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\service;
use app\right_module\working_version\v1\dao\RightDao;

class RightService
{
    /**
     * 名  称 : rightAll()
     * 功  能 : 获取所有权限管理信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/18 17:58
     */
    public function rightAll()
    {
        // 执行数据写入
        $res = (new RightDao())->rightSelect();
        // 验证数据
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',$res['data']);
    }
}