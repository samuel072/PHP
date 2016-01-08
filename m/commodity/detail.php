<?php
	header("Content-Type:text/html; charset=UTF-8");
	require_once("../config.php");
	require_once(ykfile("source/commodity_service.php"));	
	
	$id = $_GET['id'];
	$commodSer = new CommodityService();
	$commodity = $commodSer->get_by_id($id);

	$page_title = "商品详情";
	
	require_once(ykfile("pages/commodity/detail.php"));
?>
