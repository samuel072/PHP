<?php
require_once(ykfile('source/comment_service.php'));

$com_id = intval($_GET['com_id']);

$comsrv = new CommentService();
$ret = $comsrv->remove_comment($com_id);

if($ret) {
	echo json_encode(array('status' => 0,
						'message' => '删除成功'));
} else {
	echo json_encode(array('status' => 1,
						'message' => '删除失败'));
}
?>
