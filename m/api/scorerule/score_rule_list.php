<?php

require_once(ykfile('source/score_service.php'));

$scoresrv = new ScoreService();
$rules = $scoresrv->get_rules();

echo json_encode(array(
	"rules" => $rules
));

?>
