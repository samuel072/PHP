<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>发布活动</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="/m/pages/css/commons.css"/>
		<link rel="stylesheet" href="/m/pages/css/header.css" />
		<link rel="stylesheet" href="/m/pages/css/activity.css" />
		<link rel="stylesheet" href="/m/pages/css/index_edit_activity.css" />
	</head>

	<body>
		<?php include(ykfile("pages/header_detail.php")); ?>
		<div class="sub_activity_body">
			<?php if($activity->type == 0) { ?>
			<div class="info_div_talk">
				<form enctype="multipart/form-data">
					<input id="input_title" type="text" placeholder="请输入演讲主题" value="<?php echo $activity->title; ?>"/>
					<input id="input_guest_name" type="text" placeholder="请输入演讲嘉宾"/>
					<img class="talk_image" id="talk_avater_image" src="" />
					<div class="file-box"> 
						<input type="text" name="textfield" id="talk_path" class="txt" placeholder="上传嘉宾图片 (640 * 480)" />
						<input type="file" name="file" class="file" id="file_avater_talk" size="28" onchange="upload_image('file_avater_talk', '#talk_avater_image')" /> 
					</div>
					<input id="input_guest_intro" type="text" placeholder="请输入嘉宾介绍"/>
					<input id="input_talk_intro" type="text" placeholder="请输入演讲介绍"/>
					<input id="input_start_time" type="text" placeholder="开始时间(格式XXXX-XX-XX 00:00)"/>
					<input id="input_end_time" type="text" placeholder="结束时间(格式XXXX-XX-XX 00:00)"/>
					<input id="input_address" type="text" placeholder="请输入演讲地点"/>
					<img class="talk_image" id="talk_image" src="" />
					<div class="file-box"> 
						<input type="text" name="textfield" id="talk_path" class="txt" placeholder="上传活动图片 (640 * 480)" />
						<input type="file" name="file" class="file" id="file_talk" size="28" onchange="upload_image('file_talk', '#talk_image')" /> 
					</div>
					<a href="javascript:void(0);" id="talk_sub" class="submit">提交上传</a>
				</form>
			</div>
			<?php } else if($activity->type == 1) { ?>
			<div class="info_div_activity">
				<form action="" enctype="multipart/form-data">
<!--					<input type="text" placeholder="请左滑选择类型" class="type" >-->
					
					<input id="input_title_act" type="text" placeholder="请输入演讲主题" value="<?php echo $activity->title; ?>" /> 
					<input id="input_guest_name_act" type="text" placeholder="请输入演讲嘉宾"/>
					<input id="input_guest_intro_act" type="text" placeholder="请输入嘉宾介绍"/>
					<input id="input_talk_intro_act" type="text" placeholder="请输入演讲介绍"/>
					<input id="input_start_time_act" type="text" placeholder="开始时间(格式XXXX-XX-XX 00:00)"/>
					<input id="input_end_time_act" type="text" placeholder="结束时间(格式XXXX-XX-XX 00:00)"/>
					<input id="input_address_act" type="text" placeholder="请输入演讲地点"/>
					<img class="activity_image" id="activity_image" src="" />
					<div class="file-box"> 
						<input type="text" name="textfield" id="talk_path" class="txt" placeholder="上传活动图片 (640 * 480)" />
						<input type="file" name="file" class="file" id="file_activity" size="28" onchange="upload_image('file_activity', '#activity_image')" /> 
					</div>
					<a href="javascript:void(0);" id="activity_sub" class="submit">提交上传</a>
				</form>
			</div>
			<?php } ?>
			<a class="tishi">亲，试试去电脑发布吧!<br/>http://www.yikeyanjiang.com</a>
		</div>
	
	<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
	<script type="text/javascript" src="/m/pages/js/ajaxfileupload.js"></script>
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
	
		function upload_image(file, img_tag) {
      $.ajaxFileUpload({
        url:'/m/api/misc.php?XDEBUG_SESSION_START=1&mod=upload_image',
        secureuri:false,
        fileElementId:file,
        dataType:'json',
        success:function(data) {
          if(data.status == 0) {
						$(img_tag).attr("src", data.path);
          } else {
            alert(data.message);
          }
        },
        error: function(data) {
            alert("error");
        }
      });

      return false; 
    }
		
		//  添加演讲 
		$("#talk_sub").click(function() {
			
			var json_array = { "id": "",
                         "type" : 0,
                         "guest_name" : $("#input_guest_name").val(),
                         "guest_avatar": $("#img_avatar").attr("src"),
                         "guest_intro" : $("#input_guest_intro").val(),
                         "title": $("#input_title").val(),
                         "summary": $("#input_talk_intro").val(),
                         "seo_title": $("#input_seo_title").val(),
                         "thumbnail": $("#talk_image").attr("src"),
                         "seo_alt": $("#input_seo_alt").val(),
                         "start_time": $("#input_start_time").val(),
                         "end_time": $("#input_end_time").val(),
                         "address": $("#input_address").val(),
                         "seo_keywords": $("#input_seo_keywords").val(),
                         "holder": $("#input_holder").val(),
												 "state": 0
                       };
			var json_data = $.toJSON(json_array);
			
			// 添加基本信息
			 $.ajax({
        url:"/m/api/user.php?XDEBUG_SESSION_START=1&mod=save_activity",
        type:'post',
        data:json_data,
        dataType:'json',
        contentType:'application/json',
        success:function(data) {
					layer.open({
						content:'亲，请等待审核',
						className: 'layer_tips_back',
						time: 2
					});
          url = window.location.href = "/m/admin.php?mod=activity&next_id=0&count=10";
					
					setTimeout(url, 2000);
        },
        error:function(xhr, msg, obj) {
          alert(msg);
        }
      });
			
		});
		
		
		$("#activity_sub").click(function() {
			
			
			var json_array = { "id": "",
                         "type" : 1,
                         "guest_name" : $("#input_guest_name_act").val(),
                         "guest_avatar": $("#img_avatar").attr("src"),
                         "guest_intro" : $("#input_guest_intro_act").val(),
                         "title": $("#input_title_act").val(),
                         "summary": $("#input_talk_intro_act").val(),
                         "seo_title": $("#input_seo_title_act").val(),
                         "thumbnail": $("#activity_image").attr("src"),
                         "seo_alt": $("#input_seo_alt_act").val(),
                         "start_time": $("#input_start_time_act").val(),
                         "end_time": $("#input_end_time_act").val(),
                         "address": $("#input_address_act").val(),
                         "seo_keywords": $("#input_seo_keywords_act").val(),
                         "holder": $("#input_holder_act").val(),
												 "state": 0
                       };
			var json_data = $.toJSON(json_array);
			
			// 添加基本消息
			 $.ajax({
        url:"/m/api/user.php?mod=save_activity",
        type:'post',
        data:json_data,
        dataType:'json',
        contentType:'application/json',
        success:function(data) {
			layer.open({
				content:'亲，请等待审核',
				className: 'layer_tips_back',
				time: 2
			});
					
			setTimeout('/m/', 2000);
        },
        error:function(xhr, msg, obj) {
          alert(msg);
        }
      });
			
	});
		
	</script>
<?php include(ykfile("pages/footer.php"));?>
</body>
</html>
