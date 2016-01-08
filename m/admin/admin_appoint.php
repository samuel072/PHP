<?php
//预约信息列表 带分页

require_once(ykfile('source/modules/appointment_module.php'));

$next_id = intval($_GET['next_id']);
$count = intval($_GET['count']);

$app_mod = new AppointmentModule();
$appoint_list = $app_mod->get_all($next_id, $count);

//分页的基本信息
$appoint_total = $app_mod->get_count();

// 以下4个参数，必须计算出来，分页器要使用
// page_cur: 当前页, 从1开始计算
// page_count: 总页数
// page_prefix: 点页数后，取数据的url前缀
// next_id: 下一页超始数据
$page_cur = intval(($next_id + 1 + 9) / 10) ;
$page_count = intval(($appoint_total + 9) / 10);
$page_prefix = "/m/admin.php?mod=appoint";
$next_id += $count;

require_once(ykfile("pages/admin/appoint_list.php"));
?>