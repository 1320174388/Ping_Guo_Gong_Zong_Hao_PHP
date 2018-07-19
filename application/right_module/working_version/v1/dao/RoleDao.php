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
     * 名  称 : roleSelect()
     * 功  能 : 声明：获取职位信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/19 10:37
     */
    public function roleSelect()
    {
        // 获取所有职位信息
        $all = RoleModel::all();
        // 验证职位是否存在
        if(!$all) return returnData('error','当前没有添加职位');
        // 返回正确数据
        return returnData('success',$all);
    }

    /**
     * 名  称 : roleCreate()
     * 功  能 : 声明：添加职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['roleName'] => '职位名称';
     * 输  入 : (String) $post['roleInfo'] => '职位介绍';
     * 输  入 : (String) $post['rightStr'] => '权限标识';
     * 输  入 : (Array)  $rightArr         => '权限标识数组';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/18 20:29
     */
    public function roleCreate($post,$rightArr)
    {
        // 获取职位看是否存在
        $find = RoleModel::where('role_name',$post['roleName'])->find();
        // 验证职位是否存在
        if($find) return returnData('error','职位已存在');
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
            return returnData('success','添加成功');
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return returnData('error','添加失败');
        }
    }

    /**
     * 名  称 : roleUpdate()
     * 功  能 : 声明：修改职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['roleIndex'] => '职位主键';
     * 输  入 : (String) $post['roleName']  => '职位名称';
     * 输  入 : (String) $post['roleInfo']  => '职位介绍';
     * 输  入 : (String) $post['rightStr']  => '权限标识';
     * 输  入 : (Array)  $rightArr          => '权限标识数组';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/19 11:03
     */
    public function roleUpdate($post,$rightArr)
    {
        // 获取职位看是否存在
        $find = RoleModel::where('role_name',$post['roleName'])->find();
        // 验证职位是否存在,并且不是他自己
        if( ($find) && ($post['roleIndex']!==$find['role_index']) )
            return returnData('error','职位已存在');
        // 启动事务
        Db::startTrans();
        try {
            // 实例化RoleModel模型
            $roleModel = RoleModel::get($post['roleIndex']);
            // 处理数据格式
            $roleModel->role_name  = $post['roleName'];
            $roleModel->role_info  = $post['roleInfo'];
            // 写入数据
            $roleModel->save();
            // 处理权限数据格式
            $insertArr = [];
            foreach($rightArr as $k=>$v)
            {
                $insertArr[$k] = [
                    'role_index'=>$post['roleIndex'],
                    'right_index'=>$v
                ];
            }
            // 获取配置信息内，职位权限关联表数据
            $roleRight = config('v1_tableName.RoleRight');
            // 删除原关联数据
            Db::table($roleRight)->where(
                'role_index',
                $post['roleIndex']
            )->delete();
            // 写入关联表数据
            $res = Db::name($roleRight)->insertAll($insertArr);
            // 返回数据
            if(!$res) return returnData('error','修改权限失败');
            // 提交事务
            Db::commit();
            return returnData('success','修改成功');
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return returnData('error','修改失败');
        }
    }

    /**
     * 名  称 : roleDelete()
     * 功  能 : 声明：删除职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $roleIndex => '职位主键';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/19 16:23
     */
    public function roleDelete($roleIndex)
    {
        // 启动事务
        Db::startTrans();
        try {
            // 实例化RoleModel模型
            $roleModel = RoleModel::get($roleIndex);
            // 判断数据是否存在
            if(!$roleModel) returnData('error','职位不存在');
            // 删除数据
            $roleModel->delete();

            // 获取配置信息内，职位权限关联表数据
            $roleRight = config('v1_tableName.RoleRight');
            // 删除原关联数据
            Db::table($roleRight)->where(
                'role_index',
                $roleIndex
            )->delete();

            // 提交事务
            Db::commit();
            return returnData('success','删除成功');
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            return returnData('error','删除失败');
        }
    }
}