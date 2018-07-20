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

    /**
     * 名  称 : adminUpdate()
     * 功  能 : 声明：修改管理员信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $put['adminToken']      => '管理员标识';
     * 输  入 : (String) $put['adminName']       => '管理员名称';
     * 输  入 : (String) $put['adminPassward']   => '管理员密码';
     * 输  入 : (String) $put['adminRePassword'] => '确认密码';
     * 输  入 : (String) $put['roleString']      => '职位标识';
     * 输  入 : (String) $roleArr                => '职位数组';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/20 14:58
     */
    public function adminUpdate($put,$roleArr)
    {
        // 启动事务
        Db::startTrans();
        try {
            // 获取申请的管理员信息
            $adminModel = AdminModel::get($put['adminToken']);

            // 判断此管理员是否申请
            if(!$adminModel) return returnData('error','没有此管理员');

            // 处理数据
            $adminModel->admin_name     = $put['adminName'];
            $adminModel->admin_passward = md5($put['adminPassward']);

            // 写入数据
            $adminModel->save();

            // 处理权限数据格式
            $insertArr = [];
            foreach($roleArr as $k=>$v)
            {
                $insertArr[$k] = [
                    'admin_token' => $put['adminToken'],
                    'role_index'  => $v
                ];
            }

            // 获取配置信息内，管理员职位关联表信息
            $adminRole = config('v1_tableName.AdminRole');

            // 删除原关联数据
            Db::table($adminRole)->where(
                'admin_token',
                $put['adminToken']
            )->delete();

            // 写入新关联表数据
            $res = Db::name($adminRole)->insertAll($insertArr);
            // 返回错误数据
            if(!$res) return returnData('error','设置职位失败');

            // 提交事务
            Db::commit();
            return returnData('success','修改成功');
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return returnData('error','修改失败');
        }
    }
}