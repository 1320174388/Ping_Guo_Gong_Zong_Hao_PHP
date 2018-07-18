<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ApplyModel.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/28 13:17
 *  文件描述 :  管理员申请表数据模型
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\model;
use think\Model;

class ApplyModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = 'apply_token';

    // 加载配置数据表名
    protected function initialize()
    {
        parent::initialize();
        $this->table = config('v1_tableName.ApplyTable');
    }
}