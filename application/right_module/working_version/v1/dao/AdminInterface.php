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
}