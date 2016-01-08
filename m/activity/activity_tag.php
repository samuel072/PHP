<?php
	header("Content-type: text/html; charset=utf-8");
	include_once("../config.php");
	include_once(ykfile("source/activity_service.php"));
	include_once(ykfile("source/tag_service.php"));
	
	$tag_id = $_GET['id'];
	//根据标签的id 查询到对应的文章----沙龙活动
	$activityService = new ActivityService();
	$act_list = $activityService->get_act_by_tag($tag_id,@$next_id,@$pagesize);
	// 第一次进入沙龙页面的时候 默认的5种标签
	$tagService = new TagService();
	$tag_list = $tagService->get_defualt(HOT_ACTIVITY_CHANNEL);
	
	$page_title = "热门活动";

	if($act_list != 1000 && !empty($act_list)){
		include_once(ykfile("pages/activity/activity_tag.php"));
	}else{
		echo "没有对象的文章";
	}

?>
