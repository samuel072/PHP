<?php

require_once(ykfile('source/activity_service.php'));

$user_id = $_GET['user_id'];
$next_id = intval($_GET['next_id']);
$count = intval($_GET['count']);

$actsrv = new ActivityService();
$acts = $actsrv->get_by_user($user_id, $next_id, $count);

echo json_encode(array(
	"records" => $acts
));

?>
