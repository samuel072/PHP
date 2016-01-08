<?php
	require_once("../config.php");
	require_once(ykfile("source/talk_service.php"));
	require_once(ykfile("source/comment_service.php"));

	/**
	* 演讲详情页
	*/
	$talk_id = intval($_GET['id']);
	$talkService = new TalkService();
	$talk = $talkService->get_by_id($talk_id);

	$page_title = "演讲详情";

	$comsrv = new CommentService();
	$comments = $comsrv->get_comments($talk_id, 0, 3); 

	require_once(ykfile("pages/talk/detail.php"));
?>
