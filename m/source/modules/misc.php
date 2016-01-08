<?php

//发送信息的工具类
class MiscUtil {

	const telconsend = "【悦读客】";
	const telconstart = "【一刻演讲】";

	// 发送短信息
	public static function send_mobile($mobile, $verify_code) {
		//$verify_code = self::get_math_by_random(100000, 999999);
 
		//调用发送手机验证码
		$content = urlencode(mb_convert_encoding($verify_code . self::telconstart . self::telconsend, "GBK", "UTF-8"));
		$tel_url = "http://10.172.222.187/service/sendmsg.php?mobile=$mobile&content=$content&vcode=$verify_code";
//		$tel_url = "http://www.yueduke.com/service/sendmsg.php?mobile=$mobile&content=$content&vcode=$verify_code";

		$header = array(
			"Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
			"Accept-Encoding:gzip,deflate",
			"Accept-Language:zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3",
			"Connection:keep-alive",
			"Host:localhost"
		);

		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $tel_url); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header); // 设置头部信息
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
		$data = curl_exec($ch);  
		curl_close($ch);

		$json_array = array("data" => $data, "verify_code" => $verify_code);
		return $json_array;
	}

	public static function get_math_by_random($min, $max) {
		return rand($min, $max);
	}
}
?>
