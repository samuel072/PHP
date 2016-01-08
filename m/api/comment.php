<?php
require_once('../config.php');
require_once(ykfile('source/comment_service.php'));

header("application/json;charset=utf-8");

$act_id = intval($_GET['act_id']);
if($act_id < 0) {
	$act_id = 0;
}

$next_id = intval($_GET['next_id']);
if($next_id < 0) {
	$next_id = 0;
}

$count = intval($_GET['count']);
if($count <= 0 || $count > 300) {
	$count = 10;
}

$comsrv = new CommentService();
$total = $comsrv->get_count_by_act($act_id);
$comments = $comsrv->get_comments($act_id, $next_id, $count);

echo json_encode(array("total" => $total, "comments" => $comments));

?>
