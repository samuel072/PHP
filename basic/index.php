<?php
require_once('config.php');

$c = $_GET['c'];
$modules = array('user', "pdo");
if(!in_array($c, $modules)) {
	include_once(zeroPath('/error/404.php'));
}else {
	$c = ucfirst($c); // 首字母大写
	include_once(zeroPath('/controller/'.$c.'Controller.php'));
}
?>