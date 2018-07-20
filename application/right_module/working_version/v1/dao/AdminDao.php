<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/20 09:36
 *  文件描述 :  数据持久层,操作Admin：Model模型处理数据
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;
use think\Db;
use app\right_module\working_version\v1\model\AdminModel;

class AdminDao implements AdminInterface
{
    /**
     * 名  称 : adminSelect()
     * 功  能 : 声明：获取所有管理员信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/20 09:34
     */
    public function adminSelect()
    {
        // 获取所有管理员数据
        $list = (new AdminModel())->all();
        // 判断数据是否正确，返回错误数据s
        if(!$list) return returnData('error','当前没有添加管理员');
        // 返回正确数据
        return returnData('success',$list);
    }
}