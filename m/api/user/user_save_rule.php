<?php
require_once(ykfile('source/score_service.php'));

$rule = json_decode(file_get_contents("php://input"));

$scoresrv = new ScoreService();
$rule_id = $scoresrv->save_rule($rule);

if($rule_id !== false) {
	$rule = $scoresrv->get_rule_by_id($rule_id);
	echo json_encode(array("status" => "0",
						"message" => "保存成功",
						"rule" => $rule));
} else {
	echo json_encode(array("status" => "1",
						"message" => "保存失败",
						"rule" => $rule));
}

?>
