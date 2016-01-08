<?php
include('config.php');
require_once(ykfile("source/talker_service.php"));
session_start();

$mod = @$_GET['mod'];
if(!$mod) {
	$mod = 'index';
}

if(empty($_SESSION['current_user'])) {
	if($mod == 'index') {
		include(ykfile('pages/admin/login.php'));
	} else {
		echo "<script type='text/javascript'>" .
				"parent.location.href = '/admin.php'" .
			"</script>";
	}

	return ;
}


$mods = array('index',	//管理页面
	'talker',			//点他来讲列表
	'talk',				//演讲列表
	'edit_talk',		//添加或编辑演讲
	'activity',			//活动列表
	'mooc',				//公开课列表
	'edit_activity',	//活动列表
	'edit_portal',		//配置首页
	'adv',				//广告位
	'appoint',			//预约信息
	'commodity',		//商品列表
	'comment',			//评论列表
	'exchange',			//兑换记录
	'edit_talker',		//点他来讲 添加或编辑
	'edit_mooc',		//公开课添加或者编辑
	'adv',				//广告列表
	'edit_adv',			//添加编辑广告
	'score_rule',		//积分规则
	'edit_score_rule',	//编辑积分规则
	'score_record',		//积分记录
	'sub_record',       //取发布列表 
	'edit_commodity',	//礼品信息  添加或编辑
	'recent',			//预告列表
	'video_live',       //视频直播
	'edit_video'        //视频添加或编辑
);

if(!in_array($mod, $mods)) {
	header('Location:/404.php');
	return ;
}

include(ykfile("/admin/admin_$mod.php"));
?>
