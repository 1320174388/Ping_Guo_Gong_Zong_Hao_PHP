<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  LoginLibrary.php
 *  创 建 者 :  Shi Rui
 *  创建日期 :  2018/07/06 18:46
 *  文件描述 :  通过code换取网页授权access_token类
 *  历史记录 :  -----------------------
 */
namespace app\login_module\working_version\v1\library;
use app\login_module\working_version\v1\dao\LoginDao;

class LoginLibrary
{
    /**
     * 名  称 : loginLibrary()
     * 功  能 : 通过code换取网页授权access_token，显示首页
     * 变  量 : --------------------------------------
     * 输  入 : (String) $code => '用户登录凭证code';
     * 输  出 : [ 'msg' => 'success', 'data' => $token ]
     * 创  建 : 2018/07/06 09:31
     */
    public function loginLibrary($code)
    {
        // 通过code换取网页授权access_token
        $access = 'https://api.weixin.qq.com/sns/oauth2/access_token';
        $access.= '?appid='.config('v1_config.AppID');
        $access.= '&secret='.config('v1_config.AppSecret');
        $access.= '&code='.$code;
        $access.= '&grant_type=authorization_code';
        // curl发送换取access_token
        $wxObject = $this->curlPost($access);
        // 解析wxArray
        $wxArray = json_decode($wxObject['data'],true);
        // 验证返回数据
        if(!empty($wxArray['errcode'])) {
            return returnData('error',json_encode($wxArray));
        }
        // 获取数据库数据
        $data = (new LoginDao())->loginSelect($wxArray);
        // 判断是否有数据
        if($data['msg']=='success'){
            // 修改access_token
            $res = (new LoginDao())->loginUpdate($wxArray);
        } else {
            // 保存access_token
            $res = (new LoginDao())->loginCreate($wxArray);
        }
        // 验证数据
        if($res['msg']=='error') return returnData('error');
        // 获取数据库数据
        $data = (new LoginDao())->loginSelect($wxArray);
        if($data['msg']=='error') return returnData('error');
        // 返回相应数据
        return returnData('success',$data['data']['user_token']);
    }

    /**
     * 名  称 : curlPost()
     * 功  能 : 通过curl换取网页授权access_token
     * 变  量 : --------------------------------------
     * 输  入 : (String) $code => '用户登录凭证code';
     * 输  出 : [ 'msg' => 'success', 'data' => $output ]
     * 创  建 : 2018/07/06 20:06
     */
    private function curlPost($access,$post_data = [])
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $access);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        $output = curl_exec($ch);
        curl_close($ch);

        // 返回相应数据
        return returnData('success',$output);
    }
}