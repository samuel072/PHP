<?php
require_once(ykfile("source/modules/appointment_module.php"));


$appoint_id = intval($_GET['appoint_id']);
$state = intval($_GET['state']);

// 根据appoint_id  修改 state的值
$app_mod = new AppointmentModule();
$appoint = $app_mod->update_appoint($appoint_id, $state);
if($appoint) {
	echo json_encode(array("status"=>0, "message"=>"修改成功!"));
} else {
	echo json_encode(array("status"=>1, "message"=>"修改失败!"));
}
?>