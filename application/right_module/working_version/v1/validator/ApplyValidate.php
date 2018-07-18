<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ApplyValidate.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/28 12:51
 *  文件描述 :  用户申请数据验证器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\validator;
use think\Validate;

class ApplyValidate extends Validate
{
    /**
     * 名  称 : $rule => '静态属性'
     * 功  能 : 定义验证规则
     * 输  入 : (String) $post['applyToken']      => '身份令牌';
     * 输  入 : (String) $post['applyName']       => '用户名';
     * 输  入 : (String) $post['applyPassward']   => '申请密码';
     * 输  入 : (String) $post['applyRePassword'] => '申请密码';
     * 输  入 : (String) $post['applyPhone']      => '手机号';
     * 输  入 : (String) $post['']       => '验证码';
     * 创  建 : 2018/06/57 15:57
     */
    protected $rule = [
        'applyToken'      =>  'require|min:32|max:32',
        'applyName'       =>  'require|max:6',
        'applyPassward'   =>  'require|min:6|max:18',
        'applyRePassword' =>  'require|confirm:applyPassward',
        'applyPhone'      =>  'require|min:11|max:11',
        'applyCode'       =>  'require|min:6|max:6'
    ];
    /**
     * 名  称 : $message => '静态属性'
     * 功  能 : 定义错误返回信息
     * 创  建 : 2018/06/57 15:57
     */
    protected $message  =   [
        'applyToken.require'      => '请发送用户令牌',
        'applyToken.min'          => '请正确发送令牌',
        'applyToken.max'          => '请正确发送令牌',
        'applyName.require'       => '请输入用户名称',
        'applyName.max'           => '用户名称过长',
        'applyPassward.require'   => '请输入密码',
        'applyPassward.min'       => '密码不能少于6位',
        'applyPassward.max'       => '密码不能超过18位',
        'applyRePassword.require' => '两次输入密码不一致',
        'applyRePassword.confirm' => '两次输入密码不一致',
        'applyPhone.require'      => '请输入手机号',
        'applyPhone.min'          => '请正确输入手机号',
        'applyPhone.max'          => '请正确输入手机号',
        'applyCode.require'       => '请输入验证码',
        'applyCode.min'           => '验证码输入错误',
        'applyCode.max'           => '验证码输入错误',
    ];
}