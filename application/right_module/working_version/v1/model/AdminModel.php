<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminModel.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/07/13 10:42
 *  文件描述 :  后台管理员模型
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\model;
use think\Model;

class AdminModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = 'admin_token';

    // 加载配置数据表名
    protected function initialize()
    {
        parent::initialize();
        $this->table = config('v1_tableName.AdminTable');
    }
}