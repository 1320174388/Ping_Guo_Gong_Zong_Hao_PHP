<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  RoleController.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/18 18:24
 *  文件描述 :  职位管理控制器
 *  历史记录 :  -----------------------
 */
namespace app\right_module\working_version\v1\controller;
use think\Controller;
use think\Request;
use app\right_module\working_version\v1\validator\RoleValidate;
use app\right_module\working_version\v1\service\RoleService;

class RoleController extends Controller
{
    /**
     * 名  称 : roleGet()
     * 功  能 : 获取所有职位信息
     * 变  量 : --------------------------------------
     * 输  入 : --------------------------------------
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/19 10:28
     */
    public function roleGet()
    {
        // 引入Service逻辑层代码
        $res = (new RoleService())->roleAll();
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(1,$res['data']);
        // 返回正确数据
        return returnResponse(0,$res['data'],true);
    }

    /**
     * 名  称 : rolePost()
     * 功  能 : 添加职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['roleName'] => '职位名称';
     * 输  入 : (String) $post['roleInfo'] => '职位介绍';
     * 输  入 : (String) $post['rightStr'] => '权限标识';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/18 19:59
     */
    public function rolePost(Request $request)
    {
        // 引入Validate数据验证器
        $validate = new RoleValidate();
        // 验证请求数据
        if(!$validate->check($request->post()))
            // 返回错误数据
            return returnResponse(1,$validate->getError());

        // 处理权限标识
        $rightArr = explode(',',$request->post('rightStr'));

        // 引入Service逻辑层代码
        $res = (new RoleService())->roleAdd($request->post(),$rightArr);
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(1,$res['data']);
        // 返回正确数据
        return returnResponse(0,$res['data'],true);
    }
}