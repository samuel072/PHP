<?php
require_once(ykfile('source/modules/adv_module.php'));

$adv = json_decode(file_get_contents("php://input"));

$mod = new AdvModule();
$adv_id = $mod->save_adv($adv);

if($adv_id !== false) {
	$adv = $mod->get_by_id($adv_id);
	echo json_encode(array("status" => 0,
						"message" => "保存成功",
						"adv" => $adv));
} else {
	echo json_encode(array("status" => "1",
						"message" => "保存失败",
						"adv" => $adv));
}

?>
