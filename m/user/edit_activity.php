<?php
require_once(ykfile('source/activity_service.php'));

$page_title = "提交活动";
$act_id = intval($_GET['act_id']);

// 没有有效的活动ID
if($act_id <= 0) {
	echo "<script type='text/javascript'>alert('亲，该功能正在月球上开发'); window.location.href='/m/'</script>";
}

$actsrv = new ActivityService();
$activity = $actsrv->get_by_id($act_id);

if($activity == NULL) {
	return ;
}

include(ykfile("pages/user/edit_activity.php"));
?>
