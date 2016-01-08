<?php

require_once(ykfile('source/user_service.php'));

$user_id = $_GET['user_id'];
$next_id = $_GET['next_id'];
$count = $_GET['count'];

$usrv = new UserService($user_id);
$count = $usrv->get_favors_count();
$acts = $usrv->get_favors($next_id, $count);

echo json_encode(array(
	"total" => $count,
	"favorites" => $acts));

?>
