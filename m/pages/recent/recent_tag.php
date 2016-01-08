<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>约 · 活动</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="/m/pages/css/commons.css"/>
		<link rel="stylesheet" href="/m/pages/css/header.css"/>
		<link rel="stylesheet" href="/m/pages/css/activity.css"/>
		<link rel="stylesheet" href="/m/pages/css/recent.css"/>
	</head>

<body>
  <?php include(ykfile("pages/left.php")); ?>
  <div class="wrap">
	<div class="body_recent">
		<?php include(ykfile("pages/header_category.php")); ?>
		
	<!--沙龙-->
		<div class="body_div_activity">
			<div class="tag_div_activity">
				<ul class="tag_ul_activity">
					<?php 
						if(!empty($tag_list) && $tag_list != 1000){
							$index = 0;
							foreach($tag_list as $tag){
								$index++;
							?>	
							<li class="tag_type li<?php echo $index ?>"><a href="/m/recent/recent_tag.php?id=<?php echo $tag->id ?>" ><?php echo $tag->name; ?></a></li>
						<?php }
						}
					?>
				</ul>
			</div>
			
			<?php foreach($recent_activity as $recent_act){?>
						<div class="content_white_activity">
							<div class="content_div_activity">
								<img class="con_img_activity" src="<?php echo $recent_act->thumbnail; ?>"/>
								<div class="con_title_activity">
									<p class="con_title_summ_activity"><?php echo $recent_act->title; ?></p>
								</div>
								<p class="con_title_type_activity">嘉宾介绍</p>
								<p class="con_summary_activity"><?php echo $recent_act->guest_name; ?></p>
								
								<p class="con_title_type_activity">活动介绍</p>
								<p class="con_summary_activity"><?php echo $recent_act->summary; ?></p>
								
								<p class="con_title_type_activity">活动时间</p>
								<p class="con_summary_activity"><?php echo date("Y-m-d H:i", strtotime($recent_act->start_time)) ?> ~ <?php echo date("m-d H:i", strtotime($recent_act->end_time)); ?></p>
								
								<p class="con_title_type_activity">活动地点</p>
								<p class="con_summary_activity"><?php echo $recent_act->address; ?></p>
								<!--按钮-->
								<?php date_default_timezone_set("Asia/Shanghai"); $nowTime = date("Y-m-d");if($recent_act->allow != 0 && $recent_act->start_time >= $nowTime ) { ?>
		                        <?php if($recent_act->is_free != 0) {?>
								<a href="<?php echo $recent_act->link; ?>" class="con_activity_activity">报名参加</a>
	                            <?php }else{ ?>
								<a href="/m/user.php?mod=join_activity&act_id=<?php echo $recent_act->id; ?>" class="con_activity_activity">报名参加</a>
                                <?php } ?>
								<?php }else if($recent_act->start_time < $nowTime) { ?> 
								<a href="javascript:void" class="con_activity_activity">报名已结束</a>
								<?php } ?>
							</div>
						</div>
			<?php	}?>
			
		</div>
	</div>
  </div>	
<?php include_once(ykfile("pages/footer.php"));?>
</body>

	<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/m/pages/js/common.js"></script>
	<script type="text/javascript" src="/m/pages/js/layer.js"></script>
	<script type="text/javascript">
		$(".body_type_recent_talk").click(function(){
			window.location.href="/m/recent.php";
		});
		$(".body_type_recent_activtity").click(function(){
			$(".body_type_recent_activtity").attr('id','on');
			$(".body_div_activity").css('display','block');
			$(".body_type_recent_talk").removeAttr('id');
			$(".body_div_recent_talk").css('display','none');
		});
		
		//加载更多
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
				var tag = <?php echo $_GET['id'];?>;
				var url = "/m/api/recent.php?next_id="+next_id+"&count=10&tag="+tag;
				
				$.ajax({
					url:url,
					type:"get",
					dataType:"json",
					beforeSend:function(){ // 执行之前
						layer.open({
							type: 2,
							content: "<img src='/m/pages/images/load.gif' />",
							style: 'width:80%;min-height:100px;max-height:200px;text-align:center;',
							shadeClose:false,
						});	
					},
					success:function(data){
						var act_list = data.activities;
						if(act_list.length != 0){
							layer.closeAll();
							num = 0;
							for(var i=0;i<act_list.length;i++){
								html +="<div class='content_white_activity'>"+ 
										"<div class='content_div_activity'>"+
											"<img class='con_img_activity' src="+act_list[i]['thumbnail']+" />"+
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
										"<p class='con_summary_activity'>"+act_list[i]['address']+"</p>";
								var nowTime = new Date().toLocaleTimeString();
								if(nowTime <= act_list[i]['start_time'] && act_list[i]['allow'] != 0){
                                	if(act_list[i]['is_free'] != 0){
									  html += "<a href='" + act_list[i]['link'] + "' class='con_activity_activity'>报名参加</a>";
									}else{
									html += "<a href='/m/user.php?mod=join_activity&act_id=" + act_list[i]['id'] + "' class='con_activity_activity'>报名参加</a>";
									}
								}else if($act_list[i]['start_time'] < nowTime){
									html += "<a href='javascript:void(0);' class='con_activity_activity'>报名已结束</a>";
								}
									html += "</div></div>";
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
						
						
						
					}
					
				});
				
			}
		}
	</script>
</html>
