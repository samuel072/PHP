<?php
require_once(ykfile("source/activity_service.php"));
require_once(ykfile("source/tag_service.php"));
// 判断是否有id  如果有  就是编辑  否则就是添加

$act_id = intval($_GET['act_id']);

$activitySer = new ActivityService();
// 获取所有的标签对象
$tagSer = new TagService();
$tag_list = $tagSer->get_all();

$activity = $activitySer->get_by_id($act_id);

if($activity == NULL) {
	$activity = new ActivityModule();
	$activity->type = ActivityModel::type_activity;
	$activity->author = new UserModel();
}
include(ykfile('pages/admin/edit_activity.php'));
?>
