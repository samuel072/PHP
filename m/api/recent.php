<?php
require_once("../config.php");
require_once(ykfile("source/recent_service.php"));

header("application/json;charset=utf-8");

$next_id = intval($_GET['next_id']);
if($next_id < 0) {
	$next_id = 0;
}

$count = intval($_GET['count']);
if($count <= 0 || $count > 1000) {
	$count = 10;
}
$tag_id = $_GET['tag'];
$rensrv = new RecentService();
$acts = $rensrv->get_recent_by_tagId(@$tag_id, $next_id, $count);
foreach($acts as $act) {
	date_default_timezone_set("Asia/Shanghai");
	$act->start_time = date("Y-m-d H:i", strtotime($act->start_time));
	$act->end_time = date("m-d H:i", strtotime($act->end_time));
}
echo json_encode(array(
	"activities" => $acts
));
?>
