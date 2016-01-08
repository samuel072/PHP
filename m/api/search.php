<?php

require_once('../config.php');
require_once(ykfile('source/search_service.php'));

header("application/json;charset=utf-8");

$mod = $_GET['mod'];
if(!$mod) {
	$mod = 'result';
}

include("search/search_$mod.php");
	
?>
