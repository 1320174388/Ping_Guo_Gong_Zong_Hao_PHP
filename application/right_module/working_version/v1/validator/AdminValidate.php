<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  AdminValidate.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/20 14:20
 *  文件描述 :  管理员修改验证器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\validator;
use think\Validate;

class AdminValidate extends Validate
{
    /**
     * 名  称 : $rule => '静态属性'
     * 功  能 : 定义验证规则
     * 输  入 : (String) $put['adminToken']      => '管理员标识';
     * 输  入 : (String) $put['adminName']       => '管理员名称';
     * 输  入 : (String) $put['adminPassward']   => '管理员密码';
     * 输  入 : (String) $put['adminRePassword'] => '确认密码';
     * 输  入 : (String) $put['roleString']      => '职位标识';
     * 创  建 : 2018/07/20 14:41
     */
    protected $rule = [
        'adminToken'      =>  'require|min:32|max:32',
        'adminName'       =>  'require|max:6',
        'adminPassward'   =>  'require|min:6|max:18',
        'adminRePassword' =>  'require|confirm:adminPassward',
        'roleString'      =>  'require',
    ];
    /**
     * 名  称 : $message => '静态属性'
     * 功  能 : 定义错误返回信息
     * 创  建 : 2018/07/20 14:41
     */
    protected $message  =   [
        'adminToken.require'      => '请发送管理标识',
        'adminToken.min'          => '请正确发送标识',
        'adminToken.max'          => '请正确发送标识',
        'adminName.require'       => '请输入管理员名称',
        'adminName.max'           => '管理员名称过长',
        'adminPassward.require'   => '请输入密码',
        'adminPassward.min'       => '密码不能少于6位',
        'adminPassward.max'       => '密码不能超过18位',
        'adminRePassword.require' => '两次输入密码不一致',
        'adminRePassword.confirm' => '两次输入密码不一致',
        'roleString.require'      => '请选择职位',
    ];
}