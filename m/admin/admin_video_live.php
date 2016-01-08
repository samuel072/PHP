<?php
 // 后台视频直播
 // 2015-06-09  samuel
 
require_once(ykfile('source/video_live_service.php'));

$next_id = intval($_GET['next_id']);
$count = intval($_GET['count']);
$type = $_GET["type"];   // 直播视频的类型  categoryId  0  代表的是所有

if($count <= 0) {
	$count = 10;
}

if($type == 0){
	$type = NULL;
}
$videoLiveSer = new VideoLiveService();
$videoList = $videoLiveSer->get_all($type, $next_id, $count);
$video_total = $videoLiveSer->get_count($type);

// 以下4个参数，必须计算出来，分页器要使用
// page_cur: 当前页, 从1开始计算
// page_count: 总页数
// page_prefix: 点页数后，取数据的url前缀
// next_id: 下一页超始数据
$page_cur = intval(($next_id + 1 + 9) / 10) ;
$page_count = intval(($video_total + 9) / 10);
$page_prefix = "/m/admin.php?mod=video_live&type=$type";
$next_id += $count;

include(ykfile('pages/admin/video_live_list.php'));


?>
