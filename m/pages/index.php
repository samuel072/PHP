<!DOCTYPE html>

<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>一刻演讲</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
  <link rel="stylesheet" href="/m/pages/css/commons.css"/>
  <link rel="stylesheet" href="/m/pages/css/header.css" />
  <link rel="stylesheet" href="/m/pages/css/talk.css" />
  <link rel="stylesheet" href="/m/pages/css/index.css" />
  <link rel="stylesheet" href="/m/pages/css/flexslider.css" />
  <?php include(ykfile('pages/header_common.php')); ?>
</head>

	<body style="background:#fff;">
		<!--?php include(ykfile("pages/search.php")) ?-->
		<?php include(ykfile("pages/left.php")); ?>
		<div class="wrap">
			<?php include(ykfile("pages/header_index.php")); ?>

		<?php foreach($channels as $channel) { ?>

		<?php if($channel->type == CHANNEL_TYPE_ADV) { ?>
		<!--广告-->
		<?php $con_advs = $channel->content; ?>
			<div class="flexslider"> 
				<ul class="slides"> 
		<?php foreach($con_advs as $adv) { ?>
				<li>
					<a href="<?php echo $adv->link;?>"><img src="<?php echo $adv->image; ?>" width="100%" /></a>
				</li> 
		<?php } ?>
				</ul>
			</div>
		<?php } else if($channel->type == CHANNEL_TYPE_TALK) { ?>
		<!--一刻演讲-->
		<?php $con_talk = $channel->content; ?>
		<?php foreach($con_talk as $talk) { ?>
		<div class="content_div_talk">
			<div class="con_header_div_talk">
				<img src="<?php echo $talk->guest_avatar; ?>" class="con_header_img_talk"/>
			</div>
			<p class="con_name_talk"><?php echo $talk->guest_name; ?></p>
			<p class="con_summary_talk"><?php echo $talk->guest_intro; ?></p>
			<a href="<?php echo '/m/talk/detail.php?id=' . $talk->id; ?>"><img src="<?php echo $talk->thumbnail; ?>"  class="con_img_talk" /></a>
			<div class="con_click_talk">
				<a href="<?php echo '/m/talk/detail.php?id=' . $talk->id; ?>"><img src="/m/pages/images/DEY.png"></a>
			</div>
			<div class="con_title_talk">
				<p class="con_title_summ_talk"><?php echo $talk->title; ?></p>
			</div>
			<p class="con_content_talk"><?php echo $talk->summary; ?></p>
			<div class="line_talk"><img src="/m/pages/images/line.png" width="100%"></div>
		</div>
		<?php } ?>

		<?php } else if($channel->type == CHANNEL_TYPE_TALKER) { ?>
		<!--点他来讲-->
		<?php $con_talker = $channel->content; ?>
		<div class="body_div">
			<?php foreach($con_talker as $talker) { ?>
			<div class="content_div">
				<img src="<?php echo $talker->image; ?>" class="ta_img"/>
				<div class="ta_comment">
					<span class="ta_font"><span class="name name_num"><?php echo $talker->name; ?></span><span class="name_num name_num_<?php echo $talker->id; ?>" ><?php echo $talker->points; ?></span><span class="comm">人点TA来讲</span></span>
					<a href="javascript:void(0)" data-uuid="<?php echo $talker->id; ?>" onclick="tc_a(<?php echo $talker->id; ?>)"><img src="/m/pages/images/ta.png" class="ta_click"/></a>
				</div>
			</div>
			<?php } ?>
		</div>

		<?php } else if($channel->type == CHANNEL_TYPE_ACTIVITY) { ?>
		<!--活动-->
		<div class="line_talk"><img src="/m/pages/images/line.png" width="100%"></div>
		<?php $con_acts = $channel->content; ?>
		<div class="index_activity">
			<div class="concrete_summary_small">
				<div class="summary_info">
					<a href="/m/activity/detail.php?id=<?php echo $con_acts[0]->id;?>"><img src="<?php echo $con_acts[0]->thumbnail; ?>" width="115" height="116" /></a>
					<div class="summary">
						<!--<p class="summary_title"><?php echo $con_acts[0]->guest_name; ?></p>-->
						<p class="summary_content"><?php echo $con_acts[0]->title; ?></p>
					</div>
				</div>	
					<?php if($con_acts[0]->is_expired()) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[0]->id; ?>" class="join_activity">精彩回顾</a> 
					<?php } else if($con_acts[0]->allow != 1) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[0]->id; ?>" class="join_activity">活动详情</a> 
					<?php }else { ?> 
					<a href="<?php echo '/m/user.php?mod=join_activity&act_id=' . $con_acts[0]->id; ?>" class="join_activity">报名参加</a>
					<?php } ?>
				
			</div>
			
			<!-- 第二个活动 -->
			<div class="concrete_summary_big">
				<div class="summary_info">
					<a href="/m/activity/detail.php?id=<?php echo $con_acts[1]->id;?>"><img src="<?php echo $con_acts[1]->thumbnail; ?>" width="115" height="116"/></a>
					<div class="summary">
						<!--<p class="summary_title"><?php echo $con_acts[1]->guest_name; ?></p>-->
						<p class="summary_content"><?php echo $con_acts[1]->title; ?></p>
					</div>
				</div>	
					<?php if($con_acts[1]->is_expired()) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[1]->id; ?>" class="join_activity">精彩回顾</a> 
					<?php } else if($con_acts[1]->allow != 1) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[1]->id; ?>" class="join_activity">活动详情</a> 
					<?php }else { ?> 
					<a href="<?php echo '/m/user.php?mod=join_activity&act_id=' . $con_acts[1]->id; ?>" class="join_activity">报名参加</a>
					<?php } ?>
				
			</div>
			
			<!-- 第三个活动 -->
			<div class="concrete_summary_small">
				<div class="summary_info">
					<a href="/m/activity/detail.php?id=<?php echo $con_acts[2]->id;?>"><img src="<?php echo $con_acts[2]->thumbnail; ?>" width="115" height="116"/></a>
					<div class="summary">
						<!--<p class="summary_title"><?php echo $con_acts[2]->guest_name; ?></p>-->
						<p class="summary_content"><?php echo $con_acts[2]->title; ?></p>
					</div>
				</div>	
					<?php if($con_acts[2]->is_expired()) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[2]->id; ?>" class="join_activity">精彩回顾</a> 
					<?php } else if($con_acts[2]->allow != 1) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[2]->id; ?>" class="join_activity">活动详情</a> 
					<?php }else { ?> 
					<a href="<?php echo '/m/user.php?mod=join_activity&act_id=' . $con_acts[2]->id; ?>" class="join_activity">报名参加</a>
					<?php } ?>
				
			</div>
			
			<!-- 第四个活动 -->
			<div class="concrete_summary_big">
				<div class="summary_info">
					<a href="/m/activity/detail.php?id=<?php echo $con_acts[3]->id;?>"><img src="<?php echo $con_acts[3]->thumbnail; ?>" width="115" height="116" /></a>
					<div class="summary">
						<!--<p class="summary_title"><?php echo $con_acts[3]->guest_name; ?></p>-->
						<p class="summary_content"><?php echo $con_acts[3]->title; ?></p>
					</div>
				</div>	
					<?php if($con_acts[3]->is_expired()) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[3]->id; ?>" class="join_activity">精彩回顾</a> 
					<?php } else if($con_acts[3]->allow != 1) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[3]->id; ?>" class="join_activity">活动详情</a> 
					<?php }else { ?> 
					<a href="<?php echo '/m/user.php?mod=join_activity&act_id=' . $con_acts[3]->id; ?>" class="join_activity">报名参加</a>
					<?php } ?>
				
			</div>
			
			<!-- 第五个活动 -->
			<div class="concrete_summary_small">
				<div class="summary_info">
					<a href="/m/activity/detail.php?id=<?php echo $con_acts[4]->id;?>"><img src="<?php echo $con_acts[4]->thumbnail; ?>" width="115" height="116"/></a>
					<div class="summary">
						<!--<p class="summary_title"><?php echo $con_acts[4]->guest_name; ?></p>-->
						<p class="summary_content"><?php echo $con_acts[4]->title; ?></p>
					</div>
				</div>	
					<?php if($con_acts[4]->is_expired()) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[4]->id; ?>" class="join_activity">活动详情</a> 
					<?php } else if($con_acts[4]->allow != 1) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[4]->id; ?>" class="join_activity">精彩回顾</a> 
					<?php }else { ?> 
					<a href="<?php echo '/m/user.php?mod=join_activity&act_id=' . $con_acts[4]->id; ?>" class="join_activity">报名参加</a>
					<?php } ?>
				
			</div>
			
			<!-- 第六个活动 -->
			<div class="concrete_summary_big">
				<div class="summary_info">
					<a href="/m/activity/detail.php?id=<?php echo $con_acts[5]->id;?>"><img src="<?php echo $con_acts[5]->thumbnail; ?>" width="115" height="116"/></a>
					<div class="summary">
						<!--<p class="summary_title"><?php echo $con_acts[5]->guest_name; ?></p>-->
						<p class="summary_content"><?php echo $con_acts[5]->title; ?></p>
					</div>
				</div>	
					<?php if($con_acts[5]->is_expired()) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[5]->id; ?>" class="join_activity">精彩回顾</a> 
					<?php } else if($con_acts[5]->allow != 1) { ?>
					<a href="<?php echo '/m/activity/detail.php?id=' . $con_acts[5]->id; ?>" class="join_activity">活动详情</a> 
					<?php }else { ?> 
					<a href="<?php echo '/m/user.php?mod=join_activity&act_id=' . $con_acts[5]->id; ?>" class="join_activity">报名参加</a>
					<?php } ?>
				
			</div>
		</div>
		<?php } ?>
		<?php } ?>

		<!--发布活动-->
		<div class="index_sub_activity">
			<a href="/m/user.php?mod=create_activity"><img src="/m/pages/images/sub_activity.png" class="sub_img"/></a>
		</div>
</div>
		<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="/m/pages/js/jquery.flexslider-min.js"></script>
		<script type="text/javascript" src="/m/pages/js/common.js"></script>
		<script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
		<script type="text/javascript" src="/m/pages/js/layer.js"></script>
		
		<script type="text/javascript">
		function tc_a(talker_id) {
			$.ajax({
				url:"/m/api/user.php?mod=talker&talker_id="+talker_id,
				type:"get",
				dataType:"json",
				contentType: 'application/json',
				success:function(data) {
					if(data.message == 'success'){
						$(".name_num_" + talker_id).html(data.points);
					} else {
						layer.open({
							content: '亲，每个人只能投一次票哟',
							time: 2,
							className: 'layer_tips_back',
							shadeClose: false
						});
					}
				},
				error:function(){
					alert("系统内部错误");
				}
			});
		}
		</script>
		
	<script type="text/javascript">
		$(function() {
			$(".flexslider").flexslider({
				slideshowSpeed: 2000, //展示时间间隔ms
				animationSpeed: 400, //滚动时间ms
				touch: true //是否支持触屏滑动
			});
		});	
	</script>
	<?php include(ykfile("pages/footer.php"));?>	
	</body>
</html>
