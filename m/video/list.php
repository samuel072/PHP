<?php

require_once ("../config.php");
require_once(ykfile("source/video_live_service.php"));


$mod = $_GET['mod'];

if($mod == 'mp') { // 一刻演讲局
	$page_title = "一刻演讲局";
	$category_id = 2;
	
}else { // 创业路演汇
	$page_title = "创业路演汇";
	$category_id = 3;
	
}
// 根据演讲类型 查询出对应的list列表数据

$videoSer = new VideoLiveService();
$video_list = $videoSer->get_video_by_type($category_id, 0, 10);

include_once(ykfile("pages/video/list.php"));

?>