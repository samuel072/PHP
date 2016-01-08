<?php
require_once("config.php");
require_once (ykfile("source/comment_service.php"));

session_start();
header("Content-Type:text/html;charset=UTF-8");

$next_id = intval($_GET['next_id']);
$count = intval($_GET['count']);
$act_id = intval($_GET['act_id']);

$commSer = new CommentService();
$comments = $commSer->get_comments($act_id, $next_id, $count);

$page_title = "演讲评论";

include(ykfile("pages/commentList.php"));
?>
