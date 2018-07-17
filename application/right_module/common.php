<?php
/**
 *  版权声明 :  地老天荒科技有限公司
 *  文件名称 :  common.php
 *  创 建 者 :  Shi Guang Yu
 *  创建日期 :  2018/06/12 17:18
 *  文件描述 :  模块公共文件
 *  历史记录 :  -----------------------
 */

/**
 * 名  称 : righeToken()
 * 功  能 : 生成Token标识字符串
 * 变  量 : --------------------------------------
 * 输  入 : --------------------------------------
 * 输  出 : 单一功能函数，只返回token字符串
 * 创  建 : 2018/06/13 15:09
 */
function righeToken()
{
    $str  = 'abcdefghijklmnopqrstuvwxyz';
    $str .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str .= '_123456789';

    $newStr = '';
    for( $i = 0; $i < 32; $i++) {
        $newStr .= $str[mt_rand(0,strlen($str)-1)];
    }
    $newStr .= time().mt_rand(100000,999999);

    return md5($newStr);
}