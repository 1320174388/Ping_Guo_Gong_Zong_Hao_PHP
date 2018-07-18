<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 18:34
 *  文件描述 :  数据持久层,操作Right：Model模型处理数据
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;

interface RightInterface
{
    /**
     * 名  称 : rightSelect()
     * 功  能 : 声明：获取所有权限信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/18 18:00
     */
    public function rightSelect();
}