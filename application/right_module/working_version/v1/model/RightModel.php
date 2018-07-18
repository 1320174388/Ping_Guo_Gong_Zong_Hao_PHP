<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RightModel.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 18:39
 *  文件描述 :  权限管理数据模型
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\model;
use think\Model;

class RightModel extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = '';

    // 设置当前模型对应数据表的主键
    protected $pk = 'right_index';

    // 加载配置数据表名
    protected function initialize()
    {
        parent::initialize();
        $this->table = config('v1_tableName.RightTable');
    }
}