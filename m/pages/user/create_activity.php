<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>发布活动</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="/m/pages/css/commons.css"/>
		<link rel="stylesheet" href="/m/pages/css/header.css" />
		<link rel="stylesheet" href="/m/pages/css/activity.css" />
		<style>
			.span_txt{font-size:16px; font-weight:bold; color:#f00; display:block; width:80%; margin:10px auto;}
		</style>
	</head>
	<body>
		<?php include(ykfile("pages/header_detail.php")); ?>
		<div class="sub_activity_body">
			<div class="body_type_subactivity">
				<a href="#" class="body_type_recent_talk" id="on">演讲</a>
				<a href="#" class="body_type_recent_activtity"  >沙龙</a>
			</div>
			<div class="info_div_talk">
				<form action="" enctype="multipart/form-data">
					<input id="talk_title" type="text" placeholder="请输入演讲主题"/>
					<a href="javascript:void(0);" class="submit" onclick="create_talk($('#talk_title').val());">创建演讲</a>
				</form>
			</div>
			<div class="info_div_activity" style="display:none">
				<form action="" enctype="multipart/form-data">
					<input id="activity_title" type="text" placeholder="请输入沙龙主题"/>
					<a href="javascript:void(0);" class="submit" onclick="create_activity($('#activity_title').val());">创建活动</a>
				</form>
			</div>
			<span class="span_txt">建议使用Google浏览器、360浏览器上传</span>
			<a class="tishi">亲，试试去电脑发布吧!<br/>http://www.yikeyanjiang.com</a>
		</div>
	</body>
	<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
	<script type="text/javascript" src="/m/pages/js/layer.js"></script>
	<script type="text/javascript">
		$(".body_type_recent_talk").click(function(){
			$(".body_type_recent_activtity").removeAttr('id');
			$(".body_type_recent_talk").attr('id','on');
			$(".info_div_activity").css('display','none');
			$(".info_div_talk").removeAttr('style');
		});
		$(".body_type_recent_activtity").click(function(){
			$(".body_type_recent_activtity").attr('id','on');
			$(".body_type_recent_talk").removeAttr('id');
			$(".info_div_talk").css('display','none');
			$(".info_div_activity").removeAttr('style');
		});
	</script>

	<script type="text/javascript">
		function create_talk(title) {
			<?php  // 检测是否登陆
			  if(!unserialize($_SESSION['current_user'])) { ?>
					layer.open({
						content: '亲， 请您先登录！',
						className: 'layer_tips_back',
						time: 2
					});
			<?php echo "return;"; } ?>
			
			if(check_title(title)) {  // 登录后
				var user_id = '<?php echo unserialize($_SESSION['current_user'])->uuid; ?>' ;
				var json_array = {"title": title, "user_id": user_id, "type": 0 };
				
				$.ajax({
					url:"/m/api/user.php?mod=create_activity",
					type:"post",
					data:$.toJSON(json_array),
					dataType:"json",
					contentType:"application/json",
					
					success:function(data) {
						if(data.status == 0) {
							layer.open({
								content: '亲，成功迈出第一步了哟',
								className: 'layer_tips_back',
								shadeClose: false,
								time: 2
							});
							
							var url = window.location.href = "/m/user.php?mod=edit_activity&act_id="+data.activity['id'];
							setTimeout(url, 3000);

						} else {
							layer.open({
								content: data.message,
								className: 'layer_tips_back',
								shadeClose: false,
								time: 2
							});
						}
					},
					error:function(xhr, msg, err) {
						alert(msg);
					}
				});
			}
		}

		function create_activity(title) {
			<?php  // 检测是否登陆
			  if(!unserialize($_SESSION['current_user'])) { ?>
					layer.open({
						content: '亲， 请您先登录！',
						className: 'layer_tips_back',
						time: 2
					});
			<?php echo "return;"; } ?>
			
			if(check_title(title)) {  // 登录后
				var user_id = '<?php echo unserialize($_SESSION['current_user'])->uuid; ?>' ;
				var json_array = {"title": title, "user_id": user_id, "type": 1 };
				
				$.ajax({
					url:"/m/api/user.php?mod=create_activity",
					type:"post",
					data:$.toJSON(json_array),
					dataType:"json",
					contentType:"application/json",
					
					success:function(data) {
						if(data.status == 0) {
							layer.open({
								content: '亲，成功迈出第一步了哟',
								className: 'layer_tips_back',
								shadeClose: false,
								time: 2
							});
							var url = window.location.href = "/m/user.php?mod=edit_activity&act_id="+data.activity['id'];
							setTimeout(url, 3000);

						} else {
							layer.open({
								content: data.message,
								className: 'layer_tips_back',
								shadeClose: false,
								time: 2
							});
						}
					},
					error:function(xhr, msg, err) {
						alert(msg);
					}
				});
			}
		}
		
		// 检测talk 的标题是不是为空
		function check_title(title) {
			if(title == '' || undefined == title) {
				layer.open({
					content: '亲，请您填写标题',
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
