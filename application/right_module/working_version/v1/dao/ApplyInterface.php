<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ApplyInterface.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/28 12:51
 *  文件描述 :  用户申请管理员数据声明
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;

interface ApplyInterface
{
    /**
     * 名  称 : applyCreate()
     * 功  能 : 声明：添加用户申请数据
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['applyToken']      => '身份令牌';
     * 输  入 : (String) $post['applyName']       => '用户名';
     * 输  入 : (String) $post['applyPassward']   => '申请密码';
     * 输  入 : (String) $post['applyRePassword'] => '申请密码';
     * 输  入 : (String) $post['applyPhone']      => '手机号';
     * 输  入 : (String) $post['applyCode']       => '验证码';
     * 输  出 : ['msg'=>'success','data'=>true]
     * 输  出 : [ 'msg' => 'success', 'data' => true ]
     * 输  出 : [ 'msg' => 'error',  'data' => false ]
     * 创  建 : 2018/6/28 15:15
     */
    public function applyCreate($post);

    /**
     * 名  称 : applyUpdate()
     * 功  能 : 声明：修改申请的管理员为正式管理员
     * 变  量 : --------------------------------------
     * 输  入 : (String) $applyToken => '管理员申请标识';
     * 输  入 : (Array)  $roleArr    => '职位标识数组';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/19 16:54
     */
    public function applyUpdate($applyToken,$roleArr);

    /**
     * 名  称 : applyDelete()
     * 功  能 : 声明：删除申请的管理员
     * 变  量 : --------------------------------------
     * 输  入 : (String) $applyToken => '管理员申请标识';
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/21 10:00
     */
    public function applyDelete($applyToken);
}