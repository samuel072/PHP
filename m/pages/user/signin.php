<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>登录</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
  <link rel="stylesheet" href="/m/pages/css/commons.css"/>
  <link rel="stylesheet" href="/m/pages/css/header.css" />
  <link rel="stylesheet" href="/m/pages/css/user.css" />
  <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="101208123" data-redirecturi="http://www.yikeyanjiang.com/m/qqlogin.php?redirecturl=<?php echo $refer; ?>" charset="utf-8"></script>
</head>

<body class="signin_body">
  <?php include(ykfile('pages/header_account.php')); ?>

  <div class="signin_body_div">

    <div class="line">
      <div class="input_ico1"><img src="/m/pages/images/user.png"/></div>
      <div class="input_wrapper"><input type="tel" placeholder="手机号/邮箱"/></div>
    </div>

    <div class="line">
      <div class="input_ico1"><img src="/m/pages/images/pwd.png"/></div>
      <div class="input_wrapper"><input type="password" placeholder="密码"/></div>
    </div>

    <a href="/m/user.php?mod=resetpwd" class="forgotpwd">忘记密码</a>
    <a href="javascript:void(0);" class="signin">登录</a>

    <div class="author_signin">
      <p>使用第三方账号登录</p>
      <ul>
        <li><a href="javascript:void(0);" id="qq_to_login"><img src="/m/pages/images/QQ.png"></a></li>
        <!--<li><span id="qq_to_login"><img src="/m/pages/images/QQ.png"></span></li>-->
        <li style="display:none;"><a href="javascript:void(0);"><img src="/m/pages/images/WeiXin.png"></a></li>
        <li style="display:none;"><a href="javascript:void(0);"><img src="/m/pages/images/sina.png"></a></li>
      </ul>
    </div>
	
	<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js" ></script>
	<script type="text/javascript" src="/m/pages/js/jquery.json.js" ></script>
	<script type="text/javascript" src="/m/pages/js/layer.js" ></script>
	<script type="text/javascript">
		$(".signin").click(function(){
			var mobile = $("input[type=tel]").val();
			var password = $("input[type=password]").val();
			var json_array = {"mobile":mobile,"password":password};
			var json_data = $.toJSON(json_array);
			$.ajax({
				url:"/m/api/user.php?&mod=signin",
				type:"post",
				data:json_data,
				dataType:"json",
				contentType:"application/json",
				beforeSend:function(){ // 执行之前
					layer.open({
						type: 2,
						content: "<img src='/m/pages/images/load.gif' />",
						style: 'width:80%;min-height:100px;max-height:200px;text-align:center;',
						shadeClose: false
					});
				},
				success:function(data) {
					layer.closeAll();
					if(data.status == 0) {
						var message = data.message;
						var i = 0;
						setInterval(function(){
							var msg = message[i];
							if(undefined != msg){
									layer.open({
									content: msg,
									className: 'layer_tips_back',
									time:1
								});
								if(i< message.length){
									i++;
								}
							}
						},1000)
						
						setTimeout("window.location.href='<?php echo $refer; ?>'", 2000);
					} else {
						
						layer.open({
							content:'亲，登陆失败！',
							className: 'layer_tips_back',
							time: 1
						});
						
					}
				},
				error:function(xhr, msg, obj) {
					alert(msg);
				}
			});
		});
		
	</script>
	

<script type="text/javascript">
$("#qq_to_login").click(function() {
	window.open('https://graph.qq.com/oauth2.0/authorize?client_id=101208123&response_type=token&scope=all&redirect_uri=http%3A%2F%2Fwww.yikeyanjiang.com%2Fm%2Fqqlogin.php%3Fredirecturl%3D%2Fm%2Fuser.php', 'oauth2Login_10384' ,'height=525,width=585, toolbar=no, menubar=no, scrollbars=no, status=no, location=yes, resizable=yes');
	
});
</script>

<?php include(ykfile("pages/footer.php"));?>
</body>
</html>
