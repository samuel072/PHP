<?php
session_start();
header("Content-type:text/html;charset=utf-8");
require_once("../config.php");
require_once(ykfile("source/user_service.php"));

if(!empty($_SESSION['current_user'])){
	$role = unserialize($_SESSION['current_user'])->role;
	if($role == 'admin'){
		require_once (ykfile("pages/admin/index.php"));
		return ;
	}
}

//后台登陆
$mobile = $_POST['tel'];
$password = $_POST['password'];

$userSer = new UserService(@$user_id);
$user_info = $userSer->get_by_mobile_pass($mobile, $password);

if($user_info === NULL) {
		header("Location:/m/admin.php");
		return;
}

// 如果包含admin  才是后台该有的进入权限
if($user_info->role == 'admin') {
	unset($_SESSION['current_user']); // 成功登陆 干掉session中关于前一个用户信息
	$_SESSION['current_user'] = serialize($user_info); // 装载新的用户信息

	require_once (ykfile("pages/admin/index.php"));
} else {
	echo "您没有登陆后台的权限！";
}

?>
