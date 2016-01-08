<?php
	header("Content-type: text/html; charset=utf-8");
	require_once("config.php");
	include_once(ykfile("source/activity_service.php"));
	include_once(ykfile("source/tag_service.php"));
	
	// 排名前十的沙龙活动
	$activityService = new ActivityService();
	$act_list = $activityService->get_all(0, @$next_id, @$pagesize, STAGE_INDEX);

	$page_title = '热门活动';	

	// 第一次进入沙龙页面的时候 默认的5种标签
	$tagService = new TagService();
	$tag_list = $tagService->get_defualt(HOT_ACTIVITY_CHANNEL);
	include_once(ykfile("pages/activity/activityList.php"));
?>
