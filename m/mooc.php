<?php
    require_once("config.php");
    require_once(ykfile("source/mooc_service.php"));
	header("Content-type: text/html; charset=utf-8");
	
	$page_title = "公开课";

    $moocService = new MoocService();
    $mooc_list = $moocService->get_all(@$next_id, @$pagesize, STAGE_INDEX);

	if($mooc_list != 1000) {
		include(ykfile("pages/mooc/moocList.php"));
	} else {
		echo "没有有效的数据！";
	}
?>
