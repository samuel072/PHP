<?php

require_once('../config.php');

header("application/json;charset=utf-8");

$mod = $_GET['mod'];
$mods = array('list', 'save');

if(!in_array($mod, $mods)) {
	$mod = 'list';
}

include('scorerule/score_rule_' . $mod . '.php');

?>
