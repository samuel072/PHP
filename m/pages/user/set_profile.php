<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>修改名称</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
  <link rel="stylesheet" href="/m/pages/css/commons.css"/>
  <link rel="stylesheet" href="/m/pages/css/user.css"/>
  <link rel="stylesheet" href="/m/pages/css/header.css" />
</head>

<body class="resetname_body">
  <?php include(ykfile('pages/header_detail.php')); ?>

  <div class="resetname_body_div">
    <input type="text" name="name" value="<?php echo unserialize($_SESSION['current_user'])->name; ?>" class="resetname_name" />
    <div class="del_ico1"><a href="javascript:void(0);" class="del"><img src="/m/pages/images/del.png"/></a></div>

    <div class="save"><a href="javascript:void(0);" id="save_profile">保存</a></div>
  </div>

	
  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js" ></script>
  <script type="text/javascript" src="/m/pages/js/jquery.json.js" ></script>
  <script type="text/javascript" src="/m/pages/js/layer.js" ></script>
  <script type="text/javascript">
    /*清除文本框的内容*/
    $(".del").click(function() {
      $(".resetname_name").val("");
    });
	
	// 修改名称  set_profile
	$("#save_profile").click(function() {
		var json_array = {"name":$(".resetname_name").val()};
		var json_data = $.toJSON(json_array);
		$.ajax({
            url:"/m/api/user.php?mod=set_profile",
            type:'post',
            data:json_data,
            dataType:'json',
            success:function(data){
				if(data.status == 0) { // success
					layer.open({
						content:data.message,
						className:'layer_tips_back',
						time:2
					});
					setTimeout("window.location.href='/m/user.php?mod=profile'", 2000);
				}else {
					layer.open({
						content:data.message,
						className:'layer_tips_back',
						time:2
					});  
					$(".resetname_name").val("");
				}
            }
        });
		
	});
  </script>
<?php include(ykfile("pages/footer.php"));?>
</body>

</html>
