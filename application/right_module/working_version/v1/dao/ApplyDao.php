<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  ApplyDao.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 07:18
 *  文件描述 :  数据持久层,操作Apply：Model模型处理数据
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\dao;
use app\right_module\working_version\v1\model\ApplyModel;
use app\right_module\working_version\v1\model\AdminModel;

class ApplyDao implements ApplyInterface
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
	public function applyCreate($token,$applyName,$applyPassward,$applyPhone)
	{
	    return returnData('success','100544');
	}
}