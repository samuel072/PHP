<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title><?php echo $page_title; ?></title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="/m/pages/css/commons.css"/>
		<link rel="stylesheet" href="/m/pages/css/activity.css"/>
		<link rel="stylesheet" href="/m/pages/css/header.css" />
		<link rel="stylesheet" href="/m/pages/css/talk.css"/>
		
		<script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&ak=AD752817284d396ab8b3e31b92040aff&v=1.0"></script>
		<style style="text/css">
			#allmap {height:320px; margin:0; overflow:hidden; display:none;}
		</style>
		</head>
	<body>
		<?php include(ykfile("pages/header_detail.php")); ?>

		<div class="detail_body_div">
				<img src="<?php echo $activity->thumbnail; ?>" class="detail_body_img"/>
				<div class="operate_article_div">
					<ul class="operate_article">
						<!--当点击喜欢和收藏时，图片变为likeafter.png和collectafter.png-->
					<!--<li><a href="javascript:void(0);" title="喜欢" id="click_like"><img src="/m/pages/images/like.png" /></a></li>-->
						<li><a href="javascript:void(0);" title="收藏" id="click_collect"><img src="/m/pages/images/collect.png" /></a></li>
						<li><a href="javascript:void(0);" title="评论" id="click_comment"><img src="/m/pages/images/comment.png" /></a></li>
						<li><a href="javascript:void(0);" title="分享" id="click_share"><img src="/m/pages/images/share.png" /></a></li>
					</ul>
				</div>
			<div class="con_content">
			<p class="con_title_type_activity">活动时间</p>
			<p class="con_summary_activity"><?php $startTime = strtotime($activity->start_time);echo date("Y年m月d日", $startTime); ?>至<?php $endTime = strtotime($activity->end_time);echo date('Y年m月d日', $endTime); ?></p>
			<p class="con_title_type_activity">活动地点</p>
			<!--http://api.map.baidu.com/staticimage?center=116.342127,39.99685&width=320&height=600&zoom=18中
				center:是地点坐标值;width和height返回图片的宽高；zoom是显示的级别,值越大越详细
				"http://api.map.baidu.com/staticimage?center=116.342127,39.99685&width=320&height=600&zoom=18
			-->
			<p class="con_summary_activity"><a href="javascript:void(0);" class="con_summary_activity_a"><span><img src="/m/pages/images/mapico.png" width="14px" height="18px" /></span><?php echo $activity->address; ?></a></p>
			<div id="allmap" style="display:none;"></div>
			<p class="con_title_type_activity">主办单位</p>
			<p class="con_summary_activity"><?php echo $activity->holder; ?></p>
			<p class="con_title_type_activity">活动主题</p>
			<p class="con_summary_activity"><?php echo $activity->title; ?></p>
			<p class="con_title_type_activity">活动嘉宾</p>
			<p class="con_summary_activity"><?php echo $activity->guest_name; ?></p>
			<p class="con_title_type_activity">嘉宾介绍</p>
			<p class="con_summary_activity"><?php echo $activity->guest_intro; ?></p>
			<p class="con_title_type_activity">活动介绍</p>
			<p class="con_summary_activity"><?php echo $activity->summary; ?>
			<?php foreach($activity->content as $section){ ?>
				<?php if($section->type == 0) { //段落类型  0：文字 1：图片 2：链接 3：视频 4：标题 ?>
				<p class="sec_con_content"><?php echo str_replace("\n", "<br/>", $section->detail); ?></p>
				<?php } else if($section->type == 1) { ?>
					<div class="sec_con_img_img">
						<a href="<?php echo $section->link; ?>" ><img src="<?php echo $section->image_path ?>"  class="sec_con_img" /></a>
					</div>
				<?php } else if($section->type == 2) { ?>
					<a class="sec_a_link" href="<?php echo $section->link; ?>"><?php echo $section->detail; ?></a>
				<?php } else if($section->type == 3) { ?>
					<a href="<?php echo $section->link ?>" class="sec_a_link" ><img src="<?php echo $section->image_path ?>"  class="sec_con_img" /></a>
					<div class="sec_con_click">
						<!-- 视频播放装置 start-->
						<a href="<?php echo $section->link ?>" class="sec_a_link" ><img src="/pages/images/DEY.png"></a>
						<!-- end -->
					</div>
					<div class="sec_con_title">
						<p class="sec_con_title_summ"><?php echo $activity->title ?></p>
					</div>
					<!--<p class="sec_con_content">播放<span class="cdt_font">1969</span>次|喜欢<span class="cdt_font">1246</span>次|评论<span class="cdt_font">699</span>次</p>-->
				<?php } else if($section->type == 4) { ?>
					<h3 class="sec_title"><?php echo $section->detail; ?></h3>
				<?php } ?>
			<?php } ?> 
			</p>
				<div class="sec_con_img_logo">
						<img src="/m/pages/images/yike_logo.jpg"  class="sec_con_img" />
				</div>
			</div>
		</div>				
	<!-- <a href="#" class="con_activity_activity">报名参加</a> -->
	<?php include(ykfile("pages/footer.php")); ?>
	<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
	<script type="text/javascript" src="/m/pages/js/layer.js"></script>
	
	<script type="text/javascript">
		
		$("#click_like").click(function() { // 收集用户的id  和 该活动的id
			if(check_validata()) {
				var type = 0;
				add_favorite(type)
			}
		});

		$("#click_collect").click(function() {
			if(check_validata()) {
				var type = 1;
				add_favorite(type)
			}
		});
		$("#click_comment").click(function() {

		});
		$("#click_share").click(function() {
			//if(check_validata()) {
			//	var type = 2;
			//	add_favorite(type)
			//}
		});
		function add_favorite(type) {
			user_id = '<?php echo unserialize($_SESSION['current_user'])->uuid; ?>';
			act_id = <?php echo $activity->id; ?>;
			var json_data = {"user_id": user_id, "act_id": act_id, "type":type}
			
			$.ajax({
				url: '/m/api/user.php?XDEBUG_SESSION_START=1&mod=add_favor',
				data:json_data,
				type:'get',
				dataType:'json',
				success:function(data) {
					if(data.status == 0 ) {
						$("#click_collect img").attr("src", "/m/pages/images/collectafter.png")
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
					}else {
						layer.open({
							content: data.message,
							className: 'layer_tips_back',
							time:2
						});
					}
				}
			});
		}
		
		var check_validata = function() {
			<?php if(unserialize($_SESSION['current_user'])){ ?>
				return true;
			<?php }else { ?> 
				layer.open({
					content: '亲，请您先登录！',
					className: 'layer_tips_back',
					time: 2
				});
				return false;
			<?php }?>
		}
	</script>
	
	<!--  获取坐标点  -->
	<script type="text/javascript">
		$(".con_summary_activity_a").click(function() {
			$("#allmap").css("display", "block");
			var address = $(".con_summary_activity_a").text();
			var map = new BMap.Map("allmap");
			var point = new BMap.Point(116.331398,39.897445);
			map.centerAndZoom(point,12);
			map.addControl(new BMap.ZoomControl());          
			// 创建地址解析器实例
			var myGeo = new BMap.Geocoder();
			// 将地址解析结果显示在地图上,并调整地图视野
			myGeo.getPoint(address, function(point){
				if (point) {
			//		var lng = point.lng;
			//		var lat = point.lat;
			//		var url = "http://api.map.baidu.com/staticimage?center="+lng+","+lat+"&width=320&height=620&zoom=18";
			//		window.location.href=url;
					map.centerAndZoom(point, 16);
					map.addOverlay(new BMap.Marker(point));
				}
			}, "北京市");
			
		});
		
	</script>
	</body>
</html>
