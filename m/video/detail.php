<?php
/**
 * 根据id 查询出具体的视频直播信息
 */
require_once ("../config.php");
require_once(ykfile("source/video_live_service.php"));
require_once(ykfile("source/comment_service.php"));
session_start();

$id = $_GET['id'];
$videoSer = new VideoLiveService();

// 因为只有这个地方需要评论的类容 所以将评论的类容集成在这个地方
$video = $videoSer->get_by_id($id);
// 修改点击数量  
$videoSer->update_pv($video->pv, $id);

$commSer = new CommentService();
$comments = $commSer->get_comment_by_vid($video->id);
$video->comments = $comments;

// 该视频直播用户在我们这个平台上总共直播视频的数量
//$num = $videoSer->get_num($video->user->uuid);
include_once (ykfile("pages/video/detail.php"));
?>
