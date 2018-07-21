<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PageValidate.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/28 12:51
 *  文件描述 :  管理员登录数据验证器
 *  历史记录 :  -----------------------
 */
namespace app\page_module\working_version\v1\validator;
use think\Validate;

class PageValidate extends Validate
{
    /**
     * 名  称 : $rule => '静态属性'
     * 功  能 : 定义验证规则
     * 输  入 : (String) $post['adminPhone']    => '手机号';
     * 输  入 : (String) $post['adminPassword'] => '密码';
     * 创  建 : 2018/06/57 15:57
     */
    protected $rule = [
        'adminPhone'      =>  'require|min:11|max:11',
        'adminPassword'   =>  'require|min:6|max:18',
    ];
    /**
     * 名  称 : $message => '静态属性'
     * 功  能 : 定义错误返回信息
     * 创  建 : 2018/06/57 15:57
     */
    protected $message  =   [
        'adminPhone.require'      => '请输入手机号',
        'adminPhone.min'          => '请正确输入手机号',
        'adminPhone.max'          => '请正确输入手机号',
        'adminPassword.require'   => '请输入密码',
        'adminPassword.min'       => '密码不能少于6位',
        'adminPassword.max'       => '密码不能超过18位',
    ];
}