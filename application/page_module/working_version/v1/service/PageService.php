<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  PageService.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/07/21 15:17
 *  文件描述 :  后台逻辑层
 *  历史记录 :  -----------------------
 */
namespace app\page_module\working_version\v1\service;
use app\page_module\working_version\v1\dao\PageDao;
use app\page_module\working_version\v1\validator\PageValidate;

class PageService
{
    /**
     * 名  称 : adminGet()
     * 功  能 : 获取单个管理员信息，对比密码是否正确
     * 变  量 : --------------------------------------
     * 输  入 : (String) $post['adminPhone']    => '手机号';
     * 输  入 : (String) $post['adminPassword'] => '密码';
     * 输  出 : --------------------------------------
     * 创  建 : 2018/07/18 17:58
     */
    public function adminGet($post)
    {
        // 引入验证器验证数据
        $isPage =  new PageValidate();
        // 验证请求数据
        if(!$isPage->check($post))
            // 返回错误数据
            return returnData('error',$isPage->getError());

        // 获取单个管理员数据
        $data = (new PageDao())->adminSelect($post);
        // 判断数据是否正确
        if($data['msg']=='error') return returnData('error',$data['data']);

        // 判断密码是否正确
        if(md5($post['adminPassword'])!==$data['data']['admin_passward'])
            // 返回错误数据
            return returnData('error','密码输入错误');

        // 返回正确数据
        return returnData('success','登录成功');
    }
}