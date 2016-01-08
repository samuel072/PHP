<?php

$next_id = intval($_GET['next_id']);
$count = intval($_GET['count']);
if($count <= 0) {
	$count = 10;
}


$talkerSer = new TalkerService();
$talker_list = $talkerSer->get_all($next_id, $count);

$talker_total = $talkerSer->get_talk_count();

// 以下4个参数，必须计算出来，分页器要使用
// page_cur: 当前页, 从1开始计算
// page_count: 总页数
// page_prefix: 点页数后，取数据的url前缀
// next_id: 下一页超始数据
$page_cur = intval(($next_id + 1 + 9) / 10) ;
$page_count = intval(($talker_total + 9) / 10);
$page_prefix = "/m/admin.php?mod=talker";
$next_id += $count;

// 分页查询全部的点击人物


include(ykfile('pages/admin/talker_list.php'));
?>
