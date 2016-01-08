<?php
require_once(ykfile('source/activity_service.php'));

$next_id = intval($_GET['next_id']);
$count = intval($_GET['count']);
if($count <= 0) {
	$count = 10;
}

//活动的列表页
$actSer = new ActivityService();
$act_list = $actSer->get_all(@$tag_id, $next_id, $count, STAGE_ADMIN);
$act_total = $actSer->get_activity_count(NULL);

// 以下4个参数，必须计算出来，分页器要使用
// page_cur: 当前页, 从1开始计算
// page_count: 总页数
// page_prefix: 点页数后，取数据的url前缀
// next_id: 下一页超始数据
$page_cur = intval(($next_id + 1 + 9) / 10) ;
$page_count = intval(($act_total + 9) / 10);
$page_prefix = "/m/admin.php?mod=activity";
$next_id += $count;

include(ykfile('pages/admin/activity_list.php'));
?>
