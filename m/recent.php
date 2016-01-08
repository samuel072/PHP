<?php
  require_once("config.php");
	require_once(ykfile("source/recent_service.php"));
	require_once(ykfile("source/tag_service.php"));
	//查询演讲预告的列表
	$rensrv = new RecentService();
	
	/**
	*   1. 先获得预告的内容
	*   2. 获得沙龙结束的内容
	*/
	// 获取沙龙和演讲的预告
	$rec_list = $rensrv->get_recent(0, 10);
	
	$tagService = new TagService();
	$tag_list = $tagService->get_defualt(RECENT_ACTIVITY_CHANNEL);

	$page_title = "约 · 活动";

	require_once(ykfile("pages/recent/recentList.php"));
?>
