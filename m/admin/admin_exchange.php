<?php
/*礼品兑换记录*/

require_once(ykfile("source/commodity_service.php"));

$next_id = intval($_GET['next_id']);
$count = intval($_GET['count']);

if($count <= 0) {
	$count = 10;
}
$comm_ser = new CommodityService();

$comm_rec_list = $comm_ser->get_exchange_record_all($next_id, $count);
$comm_total = $comm_ser->get_count_all();

// 以下4个参数，必须计算出来，分页器要使用
// page_cur: 当前页, 从1开始计算
// page_count: 总页数
// page_prefix: 点页数后，取数据的url前缀
// next_id: 下一页超始数据
$page_cur = intval(($next_id + 1 + 9) / 10) ;
$page_count = intval(($comm_total + 9) / 10);
$page_prefix = "/m/admin.php?mod=commodity";
$next_id += $count;

require_once(ykfile("pages/admin/exchange_list.php"));
?>
