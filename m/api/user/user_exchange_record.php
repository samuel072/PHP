<?php

require_once(ykfile("source/commodity_service.php"));

$user_id = $_GET['user_id'];
$next_id = intval($_GET['next_id']);
$count = intval($_GET['count']);

$comsrv = new CommodityService();
$total = $comsrv->get_exchange_record_count($user_id);
$record = $comsrv->get_exchange_record($user_id, $next_id, $count);

echo json_encode(array(
	"total" => $total,
	"records" => $record));
?>
