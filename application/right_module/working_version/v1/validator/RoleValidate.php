<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleValidate.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 13:24
 *  文件描述 :  职位验证器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\validator;
use think\Validate;

class RoleValidate extends Validate
{
    /**
     * 名  称 : $rule => '静态属性'
     * 功  能 : 定义验证规则
     * 输  入 : (String) $post['roleName'] => '职位名称';
     * 输  入 : (String) $post['roleInfo'] => '职位名称';
     * 输  入 : (String) $post['rightStr'] => '权限标识';
     * 创  建 : 2018/07/18 20:07
     */
    protected $rule = [
        'roleName'  =>  'require|max:20',
        'roleInfo'  =>  'require|max:2000',
        'rightStr'  =>  'require',
    ];
    /**
     * 名  称 : $message => '静态属性'
     * 功  能 : 定义错误返回信息
     * 创  建 : 2018/07/18 20:07
     */
    protected $message  =   [
        'roleName.require'  =>  '请输入职位名称',
        'roleName.max'      =>  '请输入不超过20个字的职位名称',
        'roleInfo.require'  =>  '请输入职位介绍',
        'roleInfo.max'      =>  '请输入不超过2000字的职位介绍',
        'rightStr.require'  =>  '请发送权限标识',
    ];
}