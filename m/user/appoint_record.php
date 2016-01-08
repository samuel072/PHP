<?php

if(empty($_SESSION['current_user'])) {
    $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	echo "<script type='text/javascript'>alert('请您先登陆！');window.location.href='/m/user.php?mod=signin&url=$url'</script>";
}else {
	$user_id = unserialize($_SESSION['current_user'])->uuid;
	$userSer = new UserService($user_id);
	$appoint_list= $userSer->select_appoint_by_uuid($user_id, 3, 0, 10);
	
	$page_title = '我的预约';
	require_once(ykfile("pages/user/appoint_record.php"));
	
}
?>
