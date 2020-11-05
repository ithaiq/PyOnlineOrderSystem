<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2017 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function get_client_ip()
{
	$ip = '';
	if(isset($_SERVER['HTTP_X_REAL_IP'])){//nginx 代理模式下，获取客户端真实IP
			$ip=$_SERVER['HTTP_X_REAL_IP'];     
		}elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {//客户端的ip
			$ip     =   $_SERVER['HTTP_CLIENT_IP'];  
		}elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {//浏览当前页面的用户计算机的网关
			$arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			$pos    =   array_search('unknown',$arr);
			if(false !== $pos) unset($arr[$pos]);
			$ip     =   trim($arr[0]);  
		}elseif (isset($_SERVER['REMOTE_ADDR'])) {
			$ip     =   $_SERVER['REMOTE_ADDR'];//浏览当前页面的用户计算机的ip地址  
		}else{
			$ip= 'unknown';  
		}
	 return $ip == '::1' ? '127.0.0.1' : $ip;
}

function check_ip_location($queryIP){
		if ($queryIP == '127.0.0.1' || $queryIP == '0.0.0.1') {
			return '本机地址';
		}
		$url = 'http://ip.qq.com/cgi-bin/searchip?searchip1='.$queryIP; 
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_ENCODING ,'gb2312'); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 10); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ; // 获取数据返回 
		$result = curl_exec($ch); 
		$result = mb_convert_encoding($result, "utf-8", "gb2312"); // 编码转换，否则乱码 
		curl_close($ch); 
		preg_match("@<span>(.*)</span></p>@iU",$result,$ipArray); 
		if ($ipArray[1]  == '目前暂时没有您的IP信息,  期待您的分享') {
			return '暂无IP地址信息';
		} else{
			return $ipArray[1];
		}
	}