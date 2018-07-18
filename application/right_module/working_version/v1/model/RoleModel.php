<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleModel.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 20:33
 *  文件描述 :  职位管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\model;
use think\Model;

class RoleModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = 'role_index';

    // 加载配置数据表名
    protected function initialize()
    {
        parent::initialize();
        $this->table = config('v1_tableName.RoleTable');
    }
}