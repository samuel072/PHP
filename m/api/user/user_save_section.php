<?php
require_once(ykfile('source/model/section_model.php'));
require_once(ykfile('source/talk_service.php'));
require_once(ykfile('source/activity_service.php'));

$params = json_decode(file_get_contents('php://input'));
$type = intval($_GET['type']);

if($type == 0) {
	$talksrv = new TalkService();
	$ret = $talksrv->save_section($params);
} else {
	$srv = new ActivityService();
	$ret = $srv->save_section($params);
}

if($ret !== false) {
	echo json_encode(array("status" => "0",
					"message" => "保存成功",
					"section" => $ret
				));
} else {
	echo json_encode(array("status" => 0,
					"message" => "保存失败"
				));
}
