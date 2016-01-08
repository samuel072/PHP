<?php
require_once(ykfile("source/video_live_service.php"));

$params = json_decode(file_get_contents("php://input"));

$params->is_delete = 0;
$params->state = 2;
if(!$params->position) {
  $params->position = 0;
}

$videoSer = new VideoLiveService();
$result = $videoSer->save_video($params);

$status = 0;
$message = "";
if($result !== false) {
	$status = 0;
	$message = "发布成功,请等待审核";
	$video = $result;
} else {
	$status = ERR_INTERNAL;
	$message = "发布失败";
	$video = $param;
}

echo json_encode(array(
	"status" => $status,
	"message" => $message,
	"video" => $video
));


?>