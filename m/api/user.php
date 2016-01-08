<?php
require_once("../config.php");
require_once(ykfile("err.php"));
require_once(ykfile("source/talker_service.php"));
require_once(ykfile("source/talk_service.php"));
require_once(ykfile("source/mooc_service.php"));
require_once(ykfile("source/activity_service.php"));
require_once(ykfile("source/user_service.php"));

session_start();
header("application/json;charset=utf-8");

$mod = $_GET['mod'];

$mods = array('signin',			              // 登录
			'signout',			              // 退出
			'signup',			              // 注册
			'resetpwd',			              // 重置密码
			'changepwd',		              // 修改密码
			'qqlogin',			              // QQ登录
			'create_activity',	              // 创建活动
			'save_activity',	              // 保存活动信息
			'save_section',		              // 保存段落信息
			'remove_section',	              // 保存段落信息
			'remove_activity',	              // 删除活动信息
			'upload_image',		              // 上传图片
			'talker',			              // 点他来讲的人物列表
			'comment',			              // 评论列表
			'video_comment',                  // 视频直播评论
			'remove_comment',	              // 评论列表
			'sub_appoint',		              // 提交预约参加信息
			'get_profile',		              // 获取用户信息
			'set_avatar',		              // 保存头像
			'exchange',			              // 兑换商品
			'favorite',			              // 收藏记录 和 喜欢记录
			'add_favor',		              // 添加收藏 和 喜欢
			'join_record',		              // 参加记录
			'appoint_record',	              // 预约记录
			'sub_record',		              // 创建活动的记录
			'exchange_record',	              // 兑换商品的记录
			'save_adv',			              // 保存广告	
			'save_talker',		              // 保存点TA来讲
			'save_portal',		              // 保存首页
			'set_profile',		              // 基本信息修改
			'save_rule',		              // 保存积分规则
			'edit_appoint',		              // 编辑预约信息是否通过
			'set_act_state',                  // 设置审核状态
			'remove_commodity',	              // 伪删除商品
			'save_video',                     // 保存或编辑直播视频信息
			'save_section_video',             // 保存视频直播的内容
			'remove_video'                    // 伪删除视频直播
);

// 检查参数是否合法
if(!in_array($mod, $mods)) {
    return;
 }
if($mod=='talker'){
	$talkerId = $_GET['talker_id'];
	$talkerService = new TalkerService();
	$points = $talkerService->click_talker($talkerId);

	if(!$_SESSION['click' . $talkerId]){
		$_SESSION['click' . $talkerId] = 1;
		$array = array("status" => 0, "message" => "success", "points" => $points);
		echo json_encode($array);
	}else {
		$array = array("status" => 0, "message" => "亲，每个人只能投票一次哦");
		echo json_encode($array);
	}
	
}else if($mod=='get_profle'){
	//获取个人信息
	$userId=$_GET['user_id'];
	$user=array('id'=>'a3609f5e-ac4d-11e4-aadc-3065ec3f4e00','name'=>'ali','mobile'=>'18905678789','eamil'=>'','scores'=>'10','avatar'=>'./uplod/a.jpg');
	echo json_encode($user);
}else if($mod=='set_avatar'){
	$set_avatar=array('user'=>array('id'=>'a3609f5e-ac4d-11e4-aadc-3065ec3f4e00','name'=>'ali','mobile'=>'18905678789','eamil'=>'','scores'=>'10','avatar'=>'./uplod/a.jpg'),
						'status'=>0,'message'=>'头像修改成功');
	echo json_encode($set_avatar);	
} else {
	// 引入相应的功能模块
	include("user/user_$mod.php");
}

?>
