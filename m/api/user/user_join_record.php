<?php
require_once(ykfile("source/dbtables/appointment_table.php"));

$user_id = $_GET['user_id'];
$next_id = intval($_GET['next_id']);
$count = intval($_GET['count']);
$state = 3;
$userSer = new UserService($user_id);
$total = $userSer->get_count_by_user($user_id, $state);
$appoints = $userSer->get_by_user($user_id, $state, $next_id, $count);

echo json_encode(array(
	"total" => $total,
	"records" => $appoints));
?>
