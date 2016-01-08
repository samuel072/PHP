<?php
// 进入登录页面

$page_title = "登录";
$page_title_right = "注册";
$header_link_right = "/m/user.php?mod=signup";

//$refer = $_SERVER['HTTP_REFERER'];
$refer = $_GET['url'];
if(strlen($refer) <= 0) {
	$refer = "/m/user.php";
}
// 判断是否登陆
if(empty($_SESSION['current_user'])){
	require_once(ykfile("pages/user/signin.php"));
} else {
	echo "<script>window.location.href='/m/user.php'</script>";
}
?>
