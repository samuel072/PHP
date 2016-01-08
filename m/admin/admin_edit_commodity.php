<?php
/*编辑或者添加商品信息*/
require_once(ykfile("source/commodity_service.php"));

$id = intval($_GET['comm_id']);

$comm_ser = new CommodityService();

$commodity = $comm_ser->get_by_id($id);

$page_title = "";
if($commodity) {
	$page_title = "商品信息编辑";
}else {
	$page_title = "添加商品信息";
}
require_once(ykfile("pages/admin/edit_commodity.php"));
?>
