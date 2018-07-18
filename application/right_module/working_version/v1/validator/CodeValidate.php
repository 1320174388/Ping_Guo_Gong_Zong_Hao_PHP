<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  CodeValidate.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 13:24
 *  文件描述 :  用户发送验证码验证器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\validator;
use think\Validate;

class CodeValidate extends Validate
{
    /**
     * 名  称 : $rule => '静态属性'
     * 功  能 : 定义验证规则
     * 输  入 : (String) $post['applyCode'] => '验证码';
     * 创  建 : 2018/06/57 15:57
     */
    protected $rule = [
        'applyPhone'      =>  'require|min:11|max:11',
    ];
    /**
     * 名  称 : $message => '静态属性'
     * 功  能 : 定义错误返回信息
     * 创  建 : 2018/06/57 15:57
     */
    protected $message  =   [
        'applyPhone.require'      => '请输入手机号',
        'applyPhone.min'          => '请正确输入手机号',
        'applyPhone.max'          => '请正确输入手机号',
    ];
}