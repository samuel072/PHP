<?php
require_once(ykfile("source/mooc_service.php"));
require_once(ykfile("source/tag_service.php"));
// 判断是否有id  如果有  就是编辑  否则就是添加

$mooc_id = intval($_GET['mooc_id']);

$moocSer = new MoocService();
$mooc = $moocSer->get_by_id($mooc_id);

// 获取所有的标签对象
$tagSer = new TagService();
$tag_list = $tagSer->get_all();



if($mooc == NULL || $mooc == 3001) {
	$mooc = new ActivityModule();
	$mooc->type = ActivityModel::type_mooc;
	$mooc->author = new UserModel();
}

include(ykfile('pages/admin/edit_mooc.php'));
?>
