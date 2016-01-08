<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>修改密码</title>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
	<link rel="stylesheet" href="/m/pages/css/commons.css"/>
	<link rel="stylesheet" href="/m/pages/css/header.css" />
	<link rel="stylesheet" href="/m/pages/css/user.css" />
</head>

<body class="changepwd_body">
  <?php include(ykfile('pages/header_detail.php')); ?>

  <div class="changepwd_body_div">
    <input type="password" name="oldpassword" placeholder="当前密码"/>
    <input type="password" name="newpassword" placeholder="新密码"/>
    <input type="password" name="repassword" placeholder="确认新密码"/>
    <a href="javascript:void(0);"  class="submit">修改密码</a>
  </div>
	
  <script type="text/javascript"  src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript"  src="/m/pages/js/jquery.json.js"></script>
  <script type="text/javascript"  src="/m/pages/js/layer.js"></script>

  <script type="text/javascript">
    $(".submit").click(function() {
      if(!check_validate()) {
        return ;
      }

      var oldpassword = $("input[name='oldpassword']").val();
      var newpassword = $("input[name='newpassword']").val();

      var json_array = { "userid":"<?php echo unserialize($_SESSION['current_user'])->uuid; ?>", "oldpassword":oldpassword, "newpassword":newpassword };
      var json_date = $.toJSON(json_array);
      $.ajax({
        url:"/m/api/user.php?mod=changepwd",
        type:"post",
        data:json_date,
        dataType:"json",
        contentType:"application/json",
        success:function(data) {
		   layer.open({
			content: data.message,
			className: 'layer_tips_back',
			shadeClose: false,
			time: 2
		  });
          if(data.status == 0) {
            window.location.href="/m/user.php";
          } 
        }
      });
    });

    // 验证数据的合法性
    function check_validate() {
      var oldpassword = $("input[name='oldpassword']").val();
      var newpassword = $("input[name='newpassword']").val();
      var repassword = $("input[name='repassword']").val();

      if(oldpassword == null || oldpassword.length == 0 || newpassword == null || newpassword.length == 0 || repassword == null || repassword.length == 0) {
		layer.open({
			content: '亲，请填下密码',
			className: 'layer_tips_back',
			shadeClose: false,
			time: 2
		});
        return false;
      } else if(newpassword != repassword) {
        layer.open({
			content: '亲，输入两次密码不一样哦',
			className: 'layer_tips_back',
			shadeClose: false,
			time: 2
		});
        return false;
      }
      return true;
    }
  </script>
<?php include(ykfile("pages/footer.php"));?>
</body>
</html>
