<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ApplyService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 15:37
 *  文件描述 :  用户申请管理员业务逻辑
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\service;
use app\right_module\working_version\v1\dao\ApplyDao;

class ApplyService
{
    /**
     * 名  称 : applyAdd()
     * 功  能 : 执行用户申请管理员操作
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['applyToken']      => '身份令牌';
     * 输  入 : (String) $post['applyName']       => '用户名';
     * 输  入 : (String) $post['applyPassward']   => '申请密码';
     * 输  入 : (String) $post['applyRePassword'] => '申请密码';
     * 输  入 : (String) $post['applyPhone']      => '手机号';
     * 输  入 : (String) $post['applyCode']       => '验证码';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/18 15:39
     */
    public function applyAdd($post)
    {
        // 执行数据写入
        $res = (new ApplyDao())->applyCreate($post);
        // 验证数据
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',$res['data']);
    }

    /**
     * 名  称 : applyAll()
     * 功  能 : 获取所有管理员申请信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/18 17:58
     */
    public function applyAll()
    {
        // 执行数据写入
        $res = (new ApplyDao())->applySelect();
        // 验证数据
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',$res['data']);
    }

    /**
     * 名  称 : applyEdit()
     * 功  能 : 修改申请的管理员为正式管理员
     * 变  量 : --------------------------------------
     * 输  入 : (String) $applyToken => '管理员申请标识';
     * 输  入 : (Array)  $roleArr    => '职位标识数组';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/19 16:52
     */
    public function applyEdit($applyToken,$roleArr)
    {
        // 执行数据修改
        $res = (new ApplyDao())->applyUpdate($applyToken,$roleArr);
        // 验证数据
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',$res['data']);
    }

    /**
     * 名  称 : applyDel()
     * 功  能 : 删除申请管理员
     * 变  量 : --------------------------------------
     * 输  入 : (String) $applyToken => '管理员申请标识';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/1 09:59
     */
    public function applyDel($applyToken)
    {
        // 执行数据删除
        $res = (new ApplyDao())->applyDelete($applyToken);
        // 验证数据
        if($res['msg']=='error') return returnData('error',$res['data']);
        // 返回数据
        return returnData('success',$res['data']);
    }
}