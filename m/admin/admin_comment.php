<?php
require_once(ykfile('source/comment_service.php'));
require_once(ykfile('source/talk_service.php'));

$next_id = intval($_GET['next_id']);

$count = intval($_GET['count']);
if($count <= 0) {
	$count = 10;
}

$talksrv = new TalkService();
$act_id = intval($_GET['act_id']);
if($act_id > 0) {
	$activity = $talksrv->get_by_id($act_id);
}

//评论的列表页
$comsrv = new CommentService();

if($act_id > 0) {
	$comments = $comsrv->get_comments($act_id, $next_id, $count);
} else {
	$comments = $comsrv->get_comments(NULL, $next_id, $count);
}

foreach($comments as $com) {
	if($activity !== NULL) {
		$com->activity = $activity;
	} else {
		$com->activity = $talksrv->get_by_id($com->activity->id);
	}
}

$com_total = $comsrv->get_count_by_act(NULL);

// 以下4个参数，必须计算出来，分页器要使用
// page_cur: 当前页, 从1开始计算
// page_count: 总页数
// page_prefix: 点页数后，取数据的url前缀
// next_id: 下一页超始数据
$page_cur = intval(($next_id + 1 + 9) / 10) ;
$page_count = intval(($com_total + 9) / 10);
$page_prefix = "/m/admin.php?mod=comment";
$next_id += $count;

include(ykfile('pages/admin/comment_list.php'));
?>
