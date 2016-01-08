<?php
require_once(ykfile('source/score_service.php'));

$srv = new ScoreService();
$rules = $srv->get_valid_rules();

include(ykfile('pages/commodity/integral_rules.php'));

?>
