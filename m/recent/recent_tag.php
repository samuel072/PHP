<?php
	require_once("../config.php");
	require_once(ykfile("source/tag_service.php"));
	require_once(ykfile("source/recent_service.php"));
	
	$tag_id = $_GET['id'];

	// 获取活动类型对应的标签
	$tagService = new TagService();
	$tag_list = $tagService->get_defualt(RECENT_ACTIVITY_CHANNEL);
	
	$page_title = "约 · 活动";
	
	//通过标签和活动类型来取预告的列表
	$recentService = new RecentService();
	$recent_activity = $recentService->get_recent_by_tagId($tag_id, 0, 10);

	require_once(ykfile("pages/recent/recent_tag.php"));
?>
