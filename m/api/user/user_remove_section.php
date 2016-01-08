<?php
require_once(ykfile('source/modules/activity_module.php'));

$sec_id = intval($_GET['sec_id']);

$mod = new ActivityModule();
$ret = $mod->remove_section($sec_id);

if($ret) {
	echo json_encode(array('status' => 0,
						'message' => '保存成功'));
} else {
	echo json_encode(array('status' => 1,
						'message' => '保存失败'));
}
?>
