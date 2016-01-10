<?php
require_once('config.php');

$c = $_GET['c'];
$modules = array('user', "department");
if(!in_array($c, $modules)) {
	include_once(zeroPath('/error/404.php'));
}else {
	$c = ucfirst($c);
	include_once(zeroPath('/controller/'.$c.'Controller.php'));
}
?>