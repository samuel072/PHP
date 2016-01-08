<?php

session_start();

header("Content-type: text/html; charset=utf-8");
require_once("config.php");
require_once(ykfile("source/commodity_service.php"));
	
$commService = new CommodityService();
$comm_list = $commService->get_commodity(0, 20);

$page_title = "积分商城";
	
require_once(ykfile("pages/commodity/commodityList.php"));
?>
