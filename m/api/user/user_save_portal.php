<?php
/**
* 保存后台首页信息
*/
require_once(ykfile("source/portal_service.php"));

$params = json_decode(file_get_contents('php://input'));

$portalSer = new PortalService();
$adv_id = $params->adv_id;  // update  channel_adv  channel_id = 8
$adv_result = $portalSer->save_portal($adv_id, null, ChannelModel::channel_type_adv);

$talk_ids = $params->talk_ids;	// update  channel_activity  channel_id = 9
// 处理数据 id#number,id#number
$talk_id_number_list = explode(",", $talk_ids);
for($i=0; $i<count($talk_id_number_list); $i++){
	$talk_id_number = $talk_id_number_list[$i]; // id#number
	list($talk_id, $number) = explode("#", $talk_id_number);
	$talk_result = $portalSer->save_portal($talk_id, $number, ChannelModel::channel_type_talk);
}


$talker_ids = $params->talker_ids; // update channel_talker channel_id = 3
// 处理数据
$talker_id_number_list = explode(",", $talker_ids);
for($i=0; $i<count($talker_id_number_list); $i++){
	$talker_id_number = $talker_id_number_list[$i]; // id#number
	list($talker_id, $number) = explode("#", $talker_id_number);
	$talker_result = $portalSer->save_portal($talker_id, $number, ChannelModel::channel_type_talker);
}


$activity_ids = $params->activity_ids;	//update channel_activity channel = 10;
// 处理数据
$activity_id_number_list = explode(",", $activity_ids);
for($i=0; $i<count($activity_id_number_list); $i++){
	$activity_id_number = $activity_id_number_list[$i]; // id#number
	list($activity_id, $number) = explode("#", $activity_id_number);
	$activity_result = $portalSer->save_portal($activity_id, $number, ChannelModel::channel_type_activity);
}
if($adv_result && $talk_result && $talker_result && $activity_result){
	echo json_encode(array("message"=>"success"));
}else{
	echo json_encode(array("message"=>"fail"));
}
?>