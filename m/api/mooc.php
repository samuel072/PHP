<?php
require_once("../config.php");
include_once(ykfile("source/mooc_service.php"));

header("application/json;charset=utf-8");

$next_id = intval($_GET['next_id']);
if(!$next_id) {
	$next_id = 0;
}

$count = intval($_GET['count']);
if($count <= 0 || $count > 500) {
	$count = 10;
}

$moocsrv = new MoocService();
$mooc = $moocsrv->get_all($next_id, $count, STAGE_INDEX);

echo json_encode(array(
	"activities" => $mooc
));

?>
