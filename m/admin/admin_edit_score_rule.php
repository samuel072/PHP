<?php
require_once(ykfile('source/score_service.php'));

$rulesrv = new ScoreService();

$rule_id = intval($_GET['rule_id']);
if($rule_id > 0) {
	$rule = $rulesrv->get_rule_by_id($rule_id);
}

$points = $rulesrv->get_score_points();

$page_title = '编辑积分规则';

include(ykfile('pages/admin/edit_score_rule.php'));
?>
