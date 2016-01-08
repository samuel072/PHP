<?php ?>
<!doctype html>
<html lang="en">
   <head>
	  <title></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="/m/pages/css/commons.css"/>
   		<link rel="stylesheet" href="/m/pages/css/header.css"/>
    	<link rel="stylesheet" href="/m/pages/css/activity.css"/>
    	<link rel="stylesheet" href="/m/pages/css/recent.css"/>
	</head>
	<style type="text/css">
	
		.body_recent {background:#fff;}
		.search {width:90%; height:45px; margin:2% auto;}
		.search ul {margin: 0 auto; display: block; width: 80%; height:45px; border: 1px solid #e6e6e6; background:#eee; border-radius: 5px;}
		.search ul li {float:left;}
		.search ul .li_txt {width:75%;}
		.search .s_img {float:right;	}
		.search ul li input {font-size:16px; padding-left:10px;border:none; height:45px;width:100%;}
		.search ul .s_img img {width:45px; padding-right:5%; padding-top:5px;}
	</style>
  <body>
    <div class="body_recent">
			<?php include(ykfile('pages/header_detail.php')); ?>
			
			<div class="search">
				<ul>
					<li class="li_txt">
						<input type="text" placeholder="keywords" value="<?php echo $keyword; ?>" />
					</li>
					<li class="s_img">
						<a href="javascript:void(0);"><img src="/m/pages/images/search.png"></a>
					</li>
				</ul>
			</div>
			<?php foreach($activity_list as $activity) { ?>
			<div class="body_div_recent_talk" >
				<div class="content_white_activity">
					<div class="content_div_activity">
						<img class="con_img_activity" src="<?php echo $activity->thumbnail ?>"/>
						<div class="con_title_activity">
							<p class="con_title_summ_activity"><?php echo $activity->title ?></p>
						</div>
						<p class="con_title_type_activity">嘉宾介绍</p>
						<p class="con_summary_activity"><?php echo $activity->guest_name ?></p>
			
						<p class="con_title_type_activity">活动介绍</p>
						<p class="con_summary_activity"><?php echo $activity->guest_intro ?></p>
										
						<p class="con_title_type_activity">活动时间</p>
						<p class="con_summary_activity"><?php echo date("Y年m月d日 H点i分", strtotime($activity->start_time)); ?>至<?php echo date("H点i分", strtotime($activity->end_time)); ?></p>
										
						<p class="con_title_type_activity">活动地点</p>
						<p class="con_summary_activity"><?php echo $activity->address ?></p>
						
						<p class="con_title_type_activity">报名状态</p>		
					</div>
				</div>
			</div>
    <?php } ?>
		
		</div>
		<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript">
			$(".s_img a").click(function() {
				var txt_in = $(".li_txt input").val();
				window.location.href="/m/search.php?keyword="+txt_in;
					
			});
			
			$(".li_txt input").focus(function() {
				$(".li_txt input").val("");
			});
			
			$(".li_txt input").blur(function() {
				var txt_va_len = $(".li_txt input").length;
				if(txt_va_len == 0) {
					$(".li_txt input").val(<?php echo $keyword;?>);
				}
			});
		</script>
	</body>
</html>
