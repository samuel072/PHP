<?php

require_once('../config.php');
require_once(ykfile('source/commodity_service.php'));

header("application/json;charset=utf-8");

$next_id = intval($_GET['next_id']);
$count = intval($_GET['count']);

$comsrv = new CommodityService();
$coms = $comsrv->get_commodity($next_id, $count);
$total = $comsrv->get_count();

echo json_encode(array(
	"total" => $total,
	"commodity" => $coms
));

?>
