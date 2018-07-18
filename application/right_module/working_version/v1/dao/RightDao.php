<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 07:18
 *  文件描述 :  数据持久层,操作Right：Model模型处理数据
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;
use app\right_module\working_version\v1\model\RightModel;

class RightDao implements RightInterface
{
    /**
     * 名  称 : rightSelect()
     * 功  能 : 获取所有权限信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/18 18:00
     */
    public function rightSelect()
    {
        // 获取所有的权限信息
        $rightList = RightModel::all();
        // 验证权限数据
        if($rightList['msg']=='error')
            return returnData('error','请联系开发者，添加权限');
        // 返回正确信息
        return returnData('success',$rightList);
    }
}