<html>
 
  <head lang="en">
    <meta charset="UTF-8">
    <title>报名参加</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" href="/m/pages/css/commons.css"/>
    <link rel="stylesheet" href="/m/pages/css/header.css" />
    <link rel="stylesheet" href="/m/pages/css/join.css" />
  </head>

  <body>
    <?php include(ykfile('pages/header_detail.php')); ?>

    <div class="join_body_div">
      <div class="body_div">
        <input type="text" placeholder="请输入您的姓名" name="name" value="<?php echo unserialize($_SESSION['current_user'])->name; ?>"/>
        <input type="tel" placeholder="请输入手机号" value="<?php echo unserialize($_SESSION['current_user'])->mobile; ?>" name="tel" class="tel_input" />
        <a href="javascript:void(0);" class="send_code">获取验证码</a>
        <input type="number" placeholder="请输入验证码" name="code"/>
        <input type="text" placeholder="请输入公司地址(不是必填项)" name="com_address"/>
        <a href="javascript:void(0);" class="sumbit">完成</a>
      </div>
    </div>
		
    <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
	<script type="text/javascript" src="/m/pages/js/layer.js"></script>

    <script type="text/javascript">
		// 发送数字验证码
	 	$(".send_code").click(function(){
			var name_txt = $("input[name='name']").val();
        	var tel_txt = $("input[type='tel']").val();
			var json_array = {"name":name_txt, "mobile":tel_txt};
        	$.ajax({
				url:'/m/api/misc.php?mod=send_msg',
				type:'get',
				data:json_array,
				dataType:'json',
				success:function(data){
					if(data.status != 0) {
						layer.open({
							content:'亲，填写的信息有误, 请重新填写！',
							className:'layer_tips_back',
							time: 2
						});
					}
				}
			});

		});


      // 验证码获取
      function send_content_code() {
		var name_txt = $("input[name='name']").val();
        var tel_txt = $("input[type='tel']").val();
		var json_array = {"name":name_txt, "mobile":tel_txt};
        $.ajax({
			url:'/m/api/misc.php?mod=send_content',
			type:'get',
			data:json_array,
			dataType:'json',
			success:function(data){
				if(data.status != 0) {
					layer.open({
						content:'亲，填写的信息有误！',
						className:'layer_tips_back',
						time: 2
					});
				}else {
					layer.open({
						content:'亲，预约成功！请到用户中心查看！',
						className:'layer_tips_back',
						time: 2
					});
					setTimeout("window.location.href=/m/user.php");
				}
			}
		});
		  
	  }
			
			
			
      // 提交到服务器
      $(".sumbit").click(function() {
        var name_txt = $("input[name='name']").val();
        var tel_txt = $("input[type='tel']").val();
		var tel_num = $("input[type='number']").val();
        var com_address = $("input[name='com_address']").val();
       
        if(check_validate()) { // 初步验证通过
          <?php if(!empty(unserialize($_SESSION['current_user'])->uuid)) { ?>
            var uuid = "<?php echo unserialize($_SESSION['current_user'])->uuid; ?>";
          <?php } else { ?>
            var uuid = "";
          <?php } ?>
          var json_array = { "act_id" : <?php echo $_GET['act_id'] ?>, "user": { "name":name_txt, "mobile":tel_txt, "uuid":uuid, "com_address" : com_address }, "code" : tel_num};
          var json_data = $.toJSON(json_array);

          $.ajax({
            url:"/m/api/user.php?mod=sub_appoint",
            type:'post',
            data:json_data,
            dataType:'json',
            success:function(data){
				if(data.status == 0){
					// 调用发短信的接口
					send_content_code();
					if(data.message_array != 0){
						var message = data.message_array;
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
						},1000);
									
					}else {
						layer.open({
							content: data.message,
							className: 'layer_tips_back',
							time:1
						});
						
					}
					setTimeout("window.location.href='/m/recent.php'", 2000);
				}else {
					layer.open({
						content: data.message,
						className: 'layer_tips_back',
						shadeClose:false,
						time:2,
					});
				}
			}
          });
        }
      });
			
      // 初步验证数据的完整性
     function check_validate() {
        var name_txt = $("input[name='name']").val();
        var tel_txt = $("input[type='tel']").val();
        
		if(name_txt == "" || tel_txt == "") {
		  layer.open({
		    content: '亲，请填写姓名和联系电话',
		    className: 'layer_tips_back',
		    shadeClose:false,
		    time:2,
		  });
          return false;
        }

        if(isNaN(tel_txt)) {
	      layer.open({
		    content: '请填写正确的电话号码',
			className: 'layer_tips_back',
			shadeClose:false,
			time:2,
		  });
          return false;
        }

        if(tel_txt.length != 11) {
					layer.open({
						content: '请填写正确的电话号码',
						className: 'layer_tips_back',
						shadeClose:false,
						time:2,
					});
          return false;
        }

        return true;
      }
    </script>
	<?php include(ykfile("pages/footer.php"));?>
  </body>

</html>
