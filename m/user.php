<?php

session_start();
header("Content-Type:text/html;charset=utf-8");
require_once("config.php");
require_once(ykfile("err.php"));
require_once(ykfile("source/user_service.php"));
require_once(ykfile('source/model/user_model.php'));
	
$page_title = "个人中心";

@$mod = $_GET['mod'];										
$mods = array('appoint_record',		// 预约记录
			'favorite',				// 收藏列表
			'join_record',			// 参加记录
			'sub_record',			// 创建活动记录
			'exchange',				// 兑换指定商品
			'exchange_record',		// 兑换记录
			'profile',				// 个人信息页
			'set_profile',			// 保存用户信息
			'resetpwd',				// 重置密码
			'change_pwd',			// 修改密码
			'signin',				// 登录
			'signup',				// 注册
			'create_activity',		// 创建活动
			'edit_activity',		// 编辑活动
			'join_activity',		// 活动报名
			'set_basic_profile',	// 设置用户昵称和密码
			'resetpwd_next',		// 重置密码的下一步
			'score_rules'			// 查看积分规则
			
);

if(empty($mod)) {
	require_once(ykfile("pages/user/index.php"));
} else if(!in_array($mod, $mods)) {
	return;
} else {
	require_once(ykfile("user/$mod.php"));
}

?>
