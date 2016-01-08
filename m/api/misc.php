<?php
  header("application/json;charset=utf-8");
	require_once("../config.php");
	require_once(ykfile("source/user_service.php"));
	require_once (ykfile("source/modules/misc.php"));
	
	$mod=$_GET['mod'];
	$mods = array(
		"upload_image",
		"send_msg",
		"send_content"
	);
	
	// 检查参数是否合法
	if(!in_array($mod, $mods)) {
			return;
	}
	if($mod=='send_msg'){
		//生成一个随机的6位数字
		$verify_code = rand(100000,999999);
		//发送验证码
		$mobile=$_GET['mobile'];

		send($mobile, $verify_code);	
		
	}else if($mod=='send_content'){
		$verify_code = "Dear小伙伴，您已经报名成功，请等待审核！";
		$mobile=$_GET['mobile'];
		send($mobile, $verify_code);
	}else {
		include_once("misc/$mod.php");
	}
	
	function send($mobile, $verify_code) {
		$userService = new UserService(@$user_id);
		$mobile_record = $userService->get_by_mobile($mobile, NULL);
		if($mobile_record != 1000 && !empty($mobile_record)){ // 查询到有数据
			$falg = $userService->del_check_code_by_mobile($mobile);
			if($falg){ // true 删除成功
				
				//调用发送手机验证码
				$result = MiscUtil::send_mobile($mobile, $verify_code);
				$status = 0;
				$message = "发送短信息成功！";
				if($result['data'] == 1) {
					$userService->add_verify_code($mobile,$result['verify_code']);
					$json_array = array(
							"status"=>$status,
							"message"=>$message
					);
					echo json_encode($json_array);
				}else {
					$status = 1;
					$message="发送短信息失败！";
					$json_array = array(
							"status"=>$status,
							"message"=>$message
					);
					echo json_encode($json_array);
				}
			}
		}else{// 没有查询到数据
			//调用发送手机验证码
			$result = MiscUtil::send_mobile($mobile, $verify_code);
			$status = 0;
			$message = "发送短信息成功！";
			if($result['data'] == 1) {
				// 插入发送的验证码和电话号码
				$userService->add_verify_code($mobile,$result['verify_code']);
				$json_array = array(
						"status"=>$status,
						"message"=>$message
				);
				echo json_encode($json_array);
			}else {
				$status = 1;
				$message="发送短信息失败！";
				$json_array = array(
						"status"=>$status,
						"message"=>$message
				);
				echo json_encode($json_array);
			}
		
		}
	}
	
?>
