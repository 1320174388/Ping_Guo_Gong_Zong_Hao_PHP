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
     * 输  出 : {"errNum":0,"retMsg":"请求成功","retData":"数据"}
     * 创  建 : 2018/07/19 10:28
     */
    public function roleGet()
    {
        // 引入Service逻辑层代码
        $res = (new RoleService())->roleAll();
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(1,$res['data']);
        // 返回正确数据
        return returnResponse(0,'请求成功',$res['data']);
    }

    /**
     * 名  称 : rolePost()
     * 功  能 : 添加职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['roleName'] => '职位名称';
     * 输  入 : (String) $post['roleInfo'] => '职位介绍';
     * 输  入 : (String) $post['rightStr'] => '权限标识';
     * 输  出 : {"errNum":0,"retMsg":"添加成功","retData":true}
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

    /**
     * 名  称 : rolePut()
     * 功  能 : 修改职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['roleIndex'] => '职位主键';
     * 输  入 : (String) $post['roleName']  => '职位名称';
     * 输  入 : (String) $post['roleInfo']  => '职位介绍';
     * 输  入 : (String) $post['rightStr']  => '权限标识';
     * 输  出 : {"errNum":0,"retMsg":"修改成功","retData":true}
     * 创  建 : 2018/07/19 10:59
     */
    public function rolePut(Request $request)
    {
        // 判断职位组件是否发送
        if(!$request->put('roleIndex'))
            // 返回错误数据
            return returnResponse(1,'请发送职位主键');

        // 引入Validate数据验证器
        $validate = new RoleValidate();
        // 验证请求数据
        if(!$validate->check($request->put()))
            // 返回错误数据
            return returnResponse(1,$validate->getError());

        // 处理权限标识
        $rightArr = explode(',',$request->put('rightStr'));

        // 引入Service逻辑层代码
        $res = (new RoleService())->roleEdit($request->put(),$rightArr);
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(1,$res['data']);
        // 返回正确数据
        return returnResponse(0,$res['data'],true);
    }

    /**
     * 名  称 : roleDelete()
     * 功  能 : 删除职位信息
     * 变  量 : --------------------------------------
     * 输  入 : (String) $roleIndex => '职位主键';
     * 输  出 : {"errNum":0,"retMsg":"删除成功","retData":true}
     * 创  建 : 2018/07/19 10:59
     */
    public function roleDelete(Request $request)
    {
        // 获取职位主键
        $roleIndex = $request->delete('roleIndex');
        // 判断职位组件是否发送,返回错误数据
        if(!$roleIndex) return returnResponse(1,'请发送职位主键');

        // 引入Service逻辑层代码
        $res = (new RoleService())->roleDel($roleIndex);
        // 验证返回数据
        if($res['msg']=='error') return returnResponse(1,$res['data']);
        // 返回正确数据
        return returnResponse(0,$res['data'],true);
    }
}