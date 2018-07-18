<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 07:18
 *  文件描述 :  数据持久层,操作Role：Model模型处理数据
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;
use app\right_module\working_version\v1\model\RoleModel;
use think\Db;

class RoleDao implements RoleInterface
{
    /**
     * 名  称 : roleCreate()
     * 功  能 : 声明：添加职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['roleName'] => '职位名称';
     * 输  入 : (String) $post['roleInfo'] => '职位名称';
     * 输  入 : (String) $post['rightStr'] => '权限标识';
     * 输  入 : (Array)  $rightArr         => '权限标识数组';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/18 20:29
     */
    public function roleCreate($post,$rightArr)
    {
        // 启动事务
        Db::startTrans();
        try {
            // 实例化RoleModel模型
            $roleModel = new RoleModel();
            // 生成职位主键
            $roleIndex = md5(uniqid());
            // 处理数据格式
            $roleModel->role_index = $roleIndex;
            $roleModel->role_name  = $post['roleName'];
            $roleModel->role_info  = $post['roleInfo'];
            $roleModel->role_time  = time();
            // 写入数据
            $save = $roleModel->save();
            // 验证数据是否保存成功
            if(!$save) return returnData('error','添加职位失败');
            // 处理权限数据格式
            $insertArr = [];
            foreach($rightArr as $k=>$v)
            {
                $insertArr[$k] = ['role_index'=>$roleIndex,'right_index'=>$v];
            }
            // 获取配置信息内，职位权限关联表数据
            $roleRight = config('v1_tableName.RoleRight');
            // 写入关联表数据
            $res = Db::name($roleRight)->insertAll($insertArr);
            // 返回数据
            if(!$res) return returnData('error','添加权限失败');
            // 提交事务
            Db::commit();
            return returnData('success','添加成功',true);
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return returnData('error','添加失败');
        }
    }
}