<?php

if(empty($_SESSION['current_user'])) {
    $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	echo "<script type='text/javascript'>alert('请您先登陆！');window.location.href='/m/user.php?mod=signin&url=$url'</script>";
}else {
	$user_id = unserialize($_SESSION['current_user'])->uuid;
	$usrv = new UserService($user_id);
	$acts = $usrv->get_favors(0, 10);

	$page_title = "我的收藏";
	require_once(ykfile("pages/user/favorite.php"));
}
?>
