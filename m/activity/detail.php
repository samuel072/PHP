<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	include_once("../config.php");
	include_once(ykfile("source/activity_service.php"));
	
	$id = $_GET['id'];
	$activityService = new ActivityService();
	//根据id查询到单条的活动对象
	$activity = $activityService->get_by_id($id);
	$page_title = "活动详情";

	include_once(ykfile("pages/activity/detail.php"));
?>
