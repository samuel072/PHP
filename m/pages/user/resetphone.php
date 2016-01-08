<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>修改手机号</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
	<link rel="stylesheet" href="/m/pages/css/commons.css"/>
	<link rel="stylesheet" href="/m/pages/css/header.css" />
	<link rel="stylesheet" href="/m/pages/css/user.css" />
</head>
<body class="resetphone_body">
	<ul class="header">
			<li class="h_nav">
				<a href="javascript:history.go(-1);"><img src="/m/pages/images/ico02.png" class="ico01"></a>
			</li>
			<li class="h_title_type">
			   修改手机号
			</li>
	</ul>
	<div class="resetphone_body_div">
		<input type="password" name="oldpassword" placeholder="请输入手机号" class="tel"/>
		<a href="javascript:void(0);"  class="code">获取验证码</a>
		<input type="password" name="repassword" placeholder="请输入验证码"/>
		<a href="javascript:void(0);"  class="submit">完成</a>
    </div>
<?php include(ykfile("pages/footer.php"));?>
</body>
</html>
