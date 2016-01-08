<?php

require_once(ykfile('source/score_service.php'));

$rule = json_decode(file_get_contents('php://input'));

$scoresrv = new ScoreService();
$result = $scoresrv->save_rule($rule);

if($result !== false) {

	echo json_encode(array(
		"rule" => $scoresrv->get_rule_by_id($result),
		"status" => 0,
		"message" => "保存成功"
	));

} else {

	echo json_encode(array(
		"rule" => $rule,
		"status" => ERR_INTERNAL,
		"message" => "保存失败"
	));

}

?>
