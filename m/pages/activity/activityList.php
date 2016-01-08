<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title><?php echo $page_title?></title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="/m/pages/css/commons.css"/>
		<link rel="stylesheet" href="/m/pages/css/header.css"/>
		<link rel="stylesheet" href="/m/pages/css/activity.css">
	</head>

	<body>
	<?php include(ykfile("pages/left.php")); ?>
	<div class="wrap">
		<div class="body_div_activity">
			<?php include(ykfile("pages/header_category.php")); ?>
			<div class="tag_div_activity">
				<ul class="tag_ul_activity">
						
					<?php 	
						if(!empty($tag_list) && $tag_list != 1000){
							$index =0; 
							foreach($tag_list as $tag){$index++; ?>	
						<li class="tag_type li<?php echo $index; ?>"><a href="/m/activity/activity_tag.php?id=<?php echo $tag->id; ?>" ><?php echo $tag->name; ?></a></li>
					<?php }	}?>
				</ul>
			</div>
			
			<?php 
				if($act_list != 1000){
					foreach($act_list as $act ){
			?> 
			<div class="content_white_activity">
				<div class="content_div_activity">
					<img class="con_img_activity" src="<?php echo $act->thumbnail; ?>"/>
					<div class="con_title_activity">
						<p class="con_title_summ_activity"><?php echo $act->title; ?></p>
					</div>
					<p class="con_title_type_activity">嘉宾介绍</p>
					<p class="con_summary_activity"><?php echo $act->guest_name; ?></p>
					
					<p class="con_title_type_activity">活动介绍</p>
					<p class="con_summary_activity"><?php echo $act->summary; ?></p>
					
					<p class="con_title_type_activity">活动时间</p>
					<p class="con_summary_activity">
						<?php $endTime = strtotime($act->start_time);echo date("Y-m-d H:i", $endTime); ?> ~ <?php $startTime = strtotime($act->end_time);echo date('m-d H:i', $startTime); ?>
					</p>
					
					<p class="con_title_type_activity">活动地点</p>
					<p class="con_summary_activity"><?php echo $act->address; ?></p>
					<!--按钮-->
					
					<?php if($act->allow != 0) {
						date_default_timezone_set("Asia/Shanghai");
						$nowTime = date("Y-m-d H:i:s");
						if($nowTime <= $act->end_time){ ?>
							<a href="/m/user.php?mod=join_activity&act_id=<?php echo $act->id ?>" class="con_activity_activity">报名参加</a>
					<?php
						}else{ ?>
							<a href="#" class="con_activity_activity">报名已结束</a>
					<?php
						}}
					?>
					
					
				</div>
			</div>
			<?php	}
				}

			?>
		</div>
	</div>
	<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
	<script type="text/javascript" src="/m/pages/js/common.js"></script>
	<script type="text/javascript" src="/m/pages/js/layer.js"></script>
	<script type="text/javascript">
//  加载
	
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
			$.ajax({
				url:"/m/api/activity.php?next_id="+next_id+"&count=10&tag=",
				type:"get",
				dataType:"json",
				beforeSend:function(){ // 执行之前
					layer.open({
						type: 2,
						content: "<img src='/m/pages/images/load.gif' />",
						style: 'width:80%;min-height:100px;max-height:200px;text-align:center;',
						shadeClose: false
					});
				},
				success:function(data){
					var act_list = data.activities;
					if(act_list.length != 0) {
						num=0;
						layer.closeAll();
						for(var i=0;i<act_list.length;i++){
							html += "<div class='content_white_activity'>"+
									"<div class='content_div_activity'>"+
										"<img class='con_img_activity' src="+act_list[i]['thumbnail']+">"+
										"<div class='con_title_activity'>"+
										"<p class='con_title_summ_activity'>"+act_list[i]['title']+"</p>"+
									"</div>"+
									"<p class='con_title_type_activity'>嘉宾介绍</p>"+
									"<p class='con_summary_activity'>"+act_list[i]['guest_name']+"</p>"+
									"<p class='con_title_type_activity'>活动介绍</p>"+
									"<p class='con_summary_activity'>"+act_list[i]['guest_intro']+"</p>"+
									"<p class='con_title_type_activity'>活动时间</p>"+
								    "<p class='con_summary_activity'>"+act_list[i]['start_time']+ ~ "+act_list[i]['end_time']+"</p>"+
									"<p class='con_title_type_activity'>活动地点</p>"+
									"<p class='con_summary_activity'>"+act_list[i]['address']+"</p></div>";
							if(act_list[i]['allow'] != 0 ) {
								var nowTime = new Date().toLocaleTimeString();
								if(nowTime <= act_list[i]['start_time']){
									html += "<a href='/m/user.php?mod=join_activity&act_id="+act_list[i]['id']+"' class='con_activity_activity'>报名参加</a>";
								}else{
									html += "<a href='#' class='con_activity_activity'>报名已结束</a>";
								}
							}
								html += "</div>";
						}
						$(".body_div_activity").append(html);
						
					}else {
						layer.closeAll();
						layer.open({
							content : '亲，没有更多的信息哟',
							className: 'layer_tips_back',
							shadeClose: false,
							time : 2
						});
					}
				},
				error:function(datas){
					console.log("data error");
				}
				
			});
			
		}
	}
	</script>

	<?php include(ykfile("pages/footer.php")); ?>
	</body>
</html>
