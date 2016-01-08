<?php
	header("Content-type: text/html; charset=utf-8");
    require_once("config.php");
	require_once(ykfile("source/talk_service.php"));
	$talkService = new TalkService();
	$talk_list = $talkService->get_talk_all(@$tag_id, @$next_id, @$pagesize, STAGE_INDEX);

	// 页面标题，显示在导航栏上
	$page_title = "热门演讲";

	if($talk_list != 1000 && count($talk_list) != 0){
		require_once(ykfile("pages/talk/talkList.php"));
	} else {
		echo "没有有效的数据！";
	}
?>
