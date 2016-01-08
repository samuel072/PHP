<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>个人信息</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
  <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="101208123" data-redirecturi="http://www.yikeyanjiang.com/m/qqlogin.php" charset="utf-8"></script>
  <link rel="stylesheet" href="/m/pages/css/commons.css"/>
  <link rel="stylesheet" href="/m/pages/css/header.css" />
  <link rel="stylesheet" href="/m/pages/css/user.css" />
</head>

<body>
  <?php include(ykfile('pages/header_detail.php')); ?>

  <div class="profile_body">
    <div class="avatar">
	<?php if(stristr(unserialize($_SESSION['current_user'])->avatar , 'http')) { ?>
      <img src="<?php echo unserialize($_SESSION['current_user'])->avatar; ?>" class="info_img"/>
	<?php }else {?>
      <img src="http://www.yueduke.com<?php echo unserialize($_SESSION['current_user'])->avatar; ?>" class="info_img"/>
	<?php }?>
    </div>	

    <div>
      <p class="summary_upd">
        <span><img src="/m/pages/images/user_black.png"/></span>
        <span><?php echo unserialize($_SESSION['current_user'])->name; ?></span>
        <a href="/m/user.php?mod=set_profile" class="right_a">
          <span>修改</span>
          <img class="right_span_gt" src="/m/pages/images/arrow_black.png"/>
        </a>
      </p>

      <p class="summary_upd">
        <span><img src="/m/pages/images/pwd_black.png"/></span>
        <span>登录密码</span>
        <a href="/m/user.php?mod=change_pwd" class="right_a">
          <span>修改</span>
          <img class="right_span_gt" src="/m/pages/images/arrow_black.png"/>
        </a>
      </p>

      <p class="summary_upd">
        <span><img src="/m/pages/images/phone_black.png"/></span>
        <span><?php echo substr(unserialize($_SESSION['current_user'])->mobile, 0, 3)?>****<?php echo substr(unserialize($_SESSION['current_user'])->mobile, 7)?></span>
      </p>

      <p class="logout">
        <a id="btn_logout">退出帐号</a>
      </p>

    </div>

  </div>

  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js" ></script>
  <script type="text/javascript" src="/m/pages/js/jquery.json.js" ></script>
  <script type="text/javascript" src="/m/pages/js/layer.js" ></script>
  <script type="text/javascript">
    $("#btn_logout").click(function() {
		layer.open({
			content: '亲，您确定要退出吗？',
			btn:['确定','取消'],
			shadeClose:false,
			yes:function(){
				$.ajax({
					url:"/m/api/user.php?mod=signout",
					type:"get",
					dataType:"json",
					success:function(data){
					  if(data.status == 0){
						// QQ退出
						QC.Login.signOut();
						window.location.href="/m/user.php";
					  } else {
						alert(data.message);
					  }
					}
				});
			}
		});
      
    });
  </script>
<?php include(ykfile("pages/footer.php"));?>
</body>

</html>
