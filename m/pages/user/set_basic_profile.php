<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>注册</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
	<link rel="stylesheet" href="/m/pages/css/commons.css"/>
	<link rel="stylesheet" href="/m/pages/css/header.css" />
	<link rel="stylesheet" href="/m/pages/css/user.css" />
</head>

<body class="signup_body">

  <?php include(ykfile('pages/header_account.php')); ?>

  <div class="set_basic_profile_div">
    <div class="line"><input class="basic" type="password" name="password" placeholder="请设置密码"/></div>
    <div class="line"><input class="basic" type="password" name="repassword" placeholder="请确认密码"/></div>
    <div class="line"><input class="basic" type="text" name="nick" placeholder="请设置昵称"/></div>
    <a href="javascript:void(0);" class="next">完成并进入个人中心</a>
  </div>

  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js" ></script>
  <script type="text/javascript" src="/m/pages/js/jquery.json.js" ></script>
	<script type="text/javascript" src="/m/pages/js/layer.js" ></script>
  <script type="text/javascript">

    $(".next").click(function() {
      var mobile = <?php echo $_GET['mobile']?>;
      var verify_code = <?php echo $_GET['verify_code']?>;
      var password = $("input[name='password']").val();
      var repassword = $("input[name='repassword']").val();
      var nick_name = $("input[name='nick']").val();

      if(check()) {
        var json_array = { "mobile":mobile, "nickname":nick_name, "password":password, "verify_code":verify_code };
        var json_data = $.toJSON(json_array);
        $.ajax({
          url:"/m/api/user.php?mod=signup",
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
							
							setTimeout("window.location.href='/m/user.php'", 2000);
            } else {
              alert(data.message);
            }
          }
        });
      }
    });

    function check() {
      var password = $("input[name='password']").val();
      var repassword = $("input[name='repassword']").val();
      var nick_name = $("input[name='nick']").val();
		
      if(password == '' || repassword == '' || nick_name == '') {
        layer.open({
					content:'亲，请设置你的密码',
					className: 'layer_tips_back',
					time:2
				});
				
        return false;
      }
      if(password != repassword) {
				layer.open({
					content:'亲，两次密码输入不一样！',
					className: 'layer_tips_back',
					time:2
				});
				
        return false;
      }

      return true;
    }
  </script>
<?php include(ykfile("pages/footer.php"));?> 
</body>
</html>
