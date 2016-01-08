<?php
require_once(ykfile('source/modules/adv_module.php'));

if($_GET['adv_id']) {
	$adv_id = intval($_GET['adv_id']);
	$mod = new AdvModule();
	$adv = $mod->get_by_id($adv_id);

} else {

	$adv = new AdvModel();
	$adv->type = AdvModel::type_ext_web;
}

$page_title = '编辑演讲';
include(ykfile('pages/admin/edit_adv.php'));
?>
