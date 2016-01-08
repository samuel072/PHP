<?php
unset($_SESSION['current_user']);

echo json_encode(array('status' => 0,
	'message' => '退出成功'
));

?>
