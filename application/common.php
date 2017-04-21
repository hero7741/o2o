<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function status($status) {
    if($status==1){
        $str="<span class='label label-success radius'>正常</spam>";
    }elseif ($status==0){
        $str="<span class='label label-danger radius'>待审</spam>";
    }else {
        $str="<span class='label label-danger radius'>删除</spam>";
    }
    return $str;
}
/*
 * @param $url
 * @param int $type 0=>get 1=>post
 * @param array $data
 */
function doCurl($url,$type=0,$data=[]){
   $ch= curl_init();//初始化
   //设置选项
   curl_setopt($ch, CURLOPT_URL, $url);//返回句柄
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//返回文件流
   curl_setopt($ch, CURLOPT_HEADER,0);//将头文件作为信息流输出
   if($type==1){
       //post
       curl_setopt($ch, CURLOPT_POST, 1);//启用时会发送一个常规的POST请求，类型为：application/x-www-form-urlencoded，就像表单提交的一样。 
       curl_setopt($ch,CURLOPT_POSTFIELDS, $data);//全部数据使用HTTP协议中的"POST"操作来发送。要发送文件，在文件名前面加上@前缀并使用完整路径。
   }
   $output=curl_exec($ch);//获取内容
   curl_close($ch);
   return $output;
}