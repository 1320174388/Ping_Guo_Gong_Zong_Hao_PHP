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
use app\login_module\working_version\v1\model\LoginModel;

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
    public function applyCreate($post)
    {
        // 获取管理员申请数据
        $applyData  = ApplyModel::get($post['applyToken']);
        // 判断用户是否已经申请过管理员
        if($applyData) return returnData('error','以申请过，请等待审核');

        // 获取管理员信息数据
        $adminData  = AdminModel::get($post['applyToken']);
        // 判断用户是否已经成为管理员
        if($adminData) return returnData('error','您已经是管理员，不可申请');

        // 获取最高管理员信息数据
        $loginData  = LoginModel::get(1);
        // 判断用户是不是最高管理员
        if(($loginData)&&($post['applyToken']==$loginData['user_token']))
        // 返回错误数据
        return returnData('error','您已经是最高管理员，不可申请');

        // 判断管理员手机号是否已经被使用
        $Y = ApplyModel::where('apply_token',$post['applyPhone'])->find();
        $N = AdminModel::where('admin_token',$post['applyPhone'])->find();
        // 返回错误数据
        if($Y||$N) return returnData('error','你的手机号已被使用，不可申请');

        // 实例化数据库模型
        $applyModel = new ApplyModel();
        // 处理数据格式
        $applyModel->apply_token    = $post['applyToken'];
        $applyModel->apply_name     = $post['applyName'];
        $applyModel->apply_passward = md5($post['applyPassward']);
        $applyModel->apply_phone    = $post['applyPhone'];
        $applyModel->apply_time     = time();
        //　将数据写入到数据库
        $res = $applyModel->save();

        // 判断数据是否保存成功,返回错误数据
        if(!$res) return returnData('error','数据格式错误，申请失败');
        // 返回正确数据
        return returnData('success','申请成功');
    }

    /**
     * 名  称 : applySelect()
     * 功  能 : 声明：获取管理员申请信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : ['msg'=>'success','data'=>'数据']
     * 创  建 : 2018/07/18 18:00
     */
    public function applySelect()
    {
        // 获取所有管理员申请数据
        $all = ApplyModel::all();
        // 判断数据是否获取到
        if(!$all) return returnData('error','当前没有管理员申请');
        // 返回正确数据
        return returnData('success',$all);
    }
}