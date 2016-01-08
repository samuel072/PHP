<?php

$user_id = $_GET['user_id'];
$next_id = intval($_GET['next_id']);
$count = intval($_GET['count']);

$userSer = new UserService(@$user_id);
$total = $userSer->get_count_by_user_less($user_id, 3);
$appoint_list = $userSer->select_appoint_by_uuid($user_id, 3, $next_id, $count);
foreach($appoint_list as $appoint){
	$appoint->activity->start_time = date("Y年m月d日",strtotime($appoint->activity->start_time));
	$appoint->activity->end_time = date("H点i分", strtotime($appoint->activity->end_time));
	
}
echo json_encode(array(
	"total" => $total,
	"records" => $appoint_list));
?>
