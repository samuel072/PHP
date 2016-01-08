<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>我参加的</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="/m/pages/css/commons.css"/>
		<link rel="stylesheet" href="/m/pages/css/header.css"/>
		<link rel="stylesheet" href="/m/pages/css/activity.css"/>
		<link rel="stylesheet" href="/m/pages/css/recent.css"/>
	</head>
	<body>
	<div class="body_recent">
		<?php include(ykfile('pages/header_detail.php')); ?>
		<div class="body_div_recent_talk" >
			<?php  foreach($record_list as $record){?>
				<div class="content_white_activity">
					<div class="content_div_activity">
						<img class="con_img_activity" src="<?php echo $record->activity->thumbnail ?> "/>
						<div class="con_title_activity">
							<p class="con_title_summ_activity"><?php echo $record->activity->title ?></p>
						</div>
						<p class="con_title_type_activity">嘉宾介绍</p>
						<p class="con_summary_activity"><?php echo $record->activity->guest_intro ?></p>
						
						<p class="con_title_type_activity">活动介绍</p>
						<p class="con_summary_activity"><?php echo $record->activity->summary ?></p>
						
						<p class="con_title_type_activity">活动时间</p>
						<p class="con_summary_activity"><?php echo $record->activity->start_time;?>--<?php echo $record->activity->end_time; ?></p>
						
						<p class="con_title_type_activity">活动地点</p>
						<p class="con_summary_activity"><?php echo $record->activity->address; ?></p>
						
						<p class="con_title_type_activity">报名状态</p>
						<p class="con_summary_activity">已参加</p>
					</div>
				</div>
				
			<?php
					}
			?>
			
			
			
		</div>

	</div>
	<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		 //滚动条到达底部100像素时候
		$(window).scroll(function(){ 
			// 当滚动到最底部以上100像素时， 加载新内容  
			if ($(document).height() - $(window).scrollTop() - $(window).height()<100){
					loadMessage();
					var to = setTimeout("",10000);
			}
		});
		var num = 0;
		var next_id = 0;
		function loadMessage(){
			var html="";
			if(num == 0){
				next_id = next_id+10;
				num = 1;
				var user_id = "";
				<?php
					if(!empty($_SESSION['current_user'])) {?>
						user_id = "<?php echo unserialize($_SESSION['current_user'])->uuid; ?>";
				<?php
					}
				?>
				$.ajax({
					url:"/m/api/user.php?mod=join_record&next_id="+next_id+"&count=10&user_id="+user_id,
					type:"get",
					dataType:"json",
					beforeSend:function(){ // 执行之前
//						$("#show_load").show();	
					},
					success:function(data){
						var act_list = data.records;
						for(var i=0;i<act_list.length;i++){
							html += "<div class='content_white_activity'>"+
									"<div class='content_div_activity'>"+
										"<img class='con_img_activity' src="+act_list[i]['thumbnail']+"/>"+
										"<div class='con_title_activity'>"+
										"<p class='con_title_summ_activity'>"+act_list[i]['title']+"</p>"+
									"</div>"+
									"<p class='con_title_type_activity'>嘉宾介绍</p>"+
									"<p class='con_summary_activity'>"+act_list[i]['guest_name']+"</p>"+
									"<p class='con_title_type_activity'>活动介绍</p>"+
									"<p class='con_summary_activity'>"+act_list[i]['guest_intro']+"</p>"+
									"<p class='con_title_type_activity'>活动时间</p>"+
									"<p class='con_summary_activity'>"+act_list[i]['start_time']+"---"+act_list[i]['end_time']+"</p>"+
									"<p class='con_title_type_activity'>活动地点</p>"+
									"<p class='con_summary_activity'>"+act_list[i]['address']+"</p>"
							html += "</div></div>";
						}
						$(".body_div_recent_talk").append(html);
						if(act_list.length != 0){
							num = 0;
						}
						
					}
					
				});
				
			}
		}		
	</script>
<?php include(ykfile("pages/footer.php"));?>
</body>
	
</html>
