<?php
/*伪删除礼品信息*/
require_once(ykfile("source/commodity_service.php"));

$id = intval($_GET['com_id']);
$is_delete = intval($_GET['is_delete']);

$comm_ser = new CommodityService();

$result = $comm_ser->is_remove_commodity($id, $is_delete);

echo json_encode(array(
	"status"=>0,
	"message"=>"success"
));

?>
