<?php
// 伪删除视频直播 根据视频直播的id

require_once(ykfile("source/video_live_service.php"));

$id = $_GET['id'];
$is_delete = $_GET['is_delete'];

$videoSer = new VideoLiveService();
$result = $videoSer->del($id, $is_delete);

if($result){
	echo json_encode(array("status"=>0, "message"=>"成功！"));
}else {
	echo json_encode(array("status"=>1, "message"=>"失败！"));
}


?>