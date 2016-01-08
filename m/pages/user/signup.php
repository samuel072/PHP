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

  <div class="signup_body_div">
    <input type="tel" placeholder="请输入手机号" class="tel" name="tel"/>
    <span><a href="javascript:void(0);" class="verify_code">获取验证码</a></span>
        
    <div class="line"><input type="number" placeholder="请输入验证码" name="code"/></div>
    <a href="javascript:void(0);" class="next">下一步</a>   

  </div>
	
  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js" ></script>
  <script type="text/javascript">
    // 获取验证码
    $(".verify_code").click(function() {
      $.ajax({
        url:"/m/api/misc.php?mod=send_msg&mobile="+$(".tel").val(),
        type:"get",
        dataType:"json",
        success:function(data) {
          if(data.status == 0) {
            alert(data.message);
          }
        }
      });
    });

    // 注册
    $(".next").click(function() {
      var verify_code = $("input[type='number']").val();
      window.location.href = "/m/user.php?mod=set_basic_profile&mobile=" + $(".tel").val() + "&verify_code=" + verify_code;
   });
	
  </script>
<?php include(ykfile("pages/footer.php"));?>
</body>
</html>
