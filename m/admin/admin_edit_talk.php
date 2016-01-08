<?php
require_once(ykfile('source/talk_service.php'));
require_once(ykfile('source/tag_service.php'));

$talk_id = intval($_GET['talk_id']);

$talksrv = new TalkService();
$talk = $talksrv->get_by_id($talk_id);
// 获取所有的标签对象
$tagSer = new TagService();
$tag_list = $tagSer->get_all();

if($talk == NULL) {
	$talk = new ActivityModel();
	$talk->type = ActivityModel::type_talk;
	$talk->author = new UserModel();
	
}
$page_title = '编辑演讲';
include(ykfile('pages/admin/edit_talk.php'));
?>
