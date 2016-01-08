<?php
require_once(ykfile('source/talk_service.php'));

$talker_id = intval($_GET['talker_id']);

$talkerSer = new TalkerService();
$talker = $talkerSer->get_by_id($talker_id);

/*if($talker == NULL) {
	$talker = new ActivityModule();
	$talk->type = ActivityModel::type_talk;
	$talk->author = new UserModel();
}*/
$talker = $talker[0];
$page_title = '编辑点TA来讲';
include(ykfile('pages/admin/edit_talker.php'));
?>
