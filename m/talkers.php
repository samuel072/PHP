<?php
	session_start();// 开启session
	
	require_once("config.php");
    require_once(ykfile("source/talker_service.php"));

	$page_title = "点他来讲";

    $talker = new TalkerService();
    $talkers = $talker->get_all(0, 10);

    include(ykfile("pages/talkers/talkersList.php"));
?>
