<?php
// 添加或编辑机视频直播的基本信息内容
require_once(ykfile("source/video_live_service.php"));
require_once(ykfile("source/tag_service.php"));

$id = intval($_GET['id']);

$videoLiveSer = new VideoLiveService();
$video_live = $videoLiveSer->get_by_id($id);
// 标签
$tagSer = new TagService();
$tag_list = $tagSer->get_all();

$page_title = "视频直播信息";
include_once(ykfile("pages/admin/edit_video_live.php"));
?>