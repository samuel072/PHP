<?php
require_once ("config.php");
require_once (ykfile("source/video_live_service.php")); 
// 视频直播

// 查询   今天的直播 5个
// 查询   一刻演讲局 4个
// 查询  创业路演汇 4个

$videoSer = new VideoLiveService();

$video_live_list = $videoSer->get_video_by_type(1, 0, 10);

$one_talk_list = $videoSer->get_video_by_type(2, 0, 4);

$carve_out_list = $videoSer->get_video_by_type(3, 0, 4);

include_once(ykfile("pages/video/index.php"));

?>
