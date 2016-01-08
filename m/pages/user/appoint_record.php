<?php
	
?>
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <title>我预约的</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
  <link rel="stylesheet" href="/m/pages/css/commons.css"/>
  <link rel="stylesheet" href="/m/pages/css/header.css"/>
  <link rel="stylesheet" href="/m/pages/css/activity.css"/>
  <link rel="stylesheet" href="/m/pages/css/recent.css"/>
</head>

<body>
  <div class="body_recent">
    <?php include(ykfile('pages/header_detail.php')); ?>

    <?php foreach($appoint_list as $appoint) { ?>
    <div class="body_div_recent_talk" >
      <div class="content_white_activity">
        <div class="content_div_activity">
          <img class="con_img_activity" src="<?php echo $appoint->activity->thumbnail; ?>"/>
          <div class="con_title_activity">
            <p class="con_title_summ_activity"><?php echo $appoint->activity->title; ?></p>
          </div>
          <p class="con_title_type_activity">嘉宾介绍</p>
          <p class="con_summary_activity"><?php echo $appoint->activity->guest_name; ?></p>
		
          <p class="con_title_type_activity">活动介绍</p>
          <p class="con_summary_activity"><?php echo $appoint->activity->guest_intro; ?></p>
									
          <p class="con_title_type_activity">活动时间</p>
          <p class="con_summary_activity"><?php echo date("Y年m月d日 H点i分", strtotime($appoint->activity->start_time)); ?>至<?php echo date("H点i分", strtotime($appoint->activity->end_time)); ?></p>
									
          <p class="con_title_type_activity">活动地点</p>
          <p class="con_summary_activity"><?php echo $appoint->activity->address; ?></p>
					
					<p class="con_title_type_activity">报名状态</p>
					<p class="con_summary_activity">
					<?php if($appoint->state == 0){ ?> 报名审核中，请您等待 <?php } ?>
					<?php if($appoint->state == 1){ ?> 报名已通过 <?php } ?>
					<?php if($appoint->state == 2){ ?> 您确认要来 <?php } ?>
					<?php if($appoint->state == 3){ ?> 已参加 <?php } ?>
					</p>				
        </div>
      </div>
    </div>
    <?php } ?>
	</div>

 	<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="/m/pages/js/layer.js"></script>

    <script type="text/javascript">
      //滚动条到达底部100像素时候
      $(window).scroll(function() { 
        // 当滚动到最底部以上100像素时， 加载新内容  
        if ($(document).height() - $(window).scrollTop() - $(window).height() < 100) {
          loadMessage();
          var to = setTimeout("",10000);
        }
      });

      var num = 0;
      var next_id = 0;
      function loadMessage() {
        var html="";
        if(num == 0) {
          next_id = next_id+10;
          num = 1;
          var user_id = "";
          <?php if(!empty($_SESSION['current_user'])) { ?>
          user_id = "<?php echo unserialize($_SESSION['current_user'])->uuid; ?>";
          <?php } ?>

          $.ajax({
            url:"/m/api/user.php?mod=appoint_record&next_id="+next_id+"&count=10&user_id="+user_id,
            type:"get",
            dataType:"json",
            beforeSend:function() { // 执行之前
				layer.open({
					type: 2,
					content: "<img src='/m/pages/images/load.gif'>",
					style: 'width:80%;min-height:100px;max-height:200px;text-align:center;',
					shadeColse: false,
				});
            },
            success:function(data) {
              var act_list = data.records;
				if(act_list.length != 0) {
					num = 0;
					layer.closeAll();
					for(var i = 0; i < act_list.length; i ++) {
					html += 
							"<div class='body_div_recent_talk'>" +
								"<div class='content_white_activity'>" +
									"<div class='content_div_activity'>" +
										"<img class='con_img_activity' src=" + act_list[i]['activity']['thumbnail'] + "/>" +
											"<div class='con_title_activity'>" +
												"<p class='con_title_summ_activity'>" + act_list[i]['activity']['title'] + "</p>" +
											"</div>" +
											"<p class='con_title_type_activity'>嘉宾介绍</p>"+
											"<p class='con_summary_activity'>" + act_list[i]['activity']['guest_name'] + "</p>" +
											"<p class='con_title_type_activity'>活动介绍</p>" +
											"<p class='con_summary_activity'>" + act_list[i]['activity']['guest_intro'] + "</p>" +
											"<p class='con_title_type_activity'>活动时间</p>"+
											"<p class='con_summary_activity'>" + act_list[i]['activity']['start_time'] + " 至 " + act_list[i]['activity']['end_time'] + "</p>" +
											"<p class='con_title_type_activity'>活动地点</p>" +
											"<p class='con_summary_activity'>" + act_list[i]['activity']['address'] + "</p>" +
									"</div>" +
								"</div>" +
							"</div>";
					}

					$(".body_recent").append(html);
				}else {
					layer.closeAll();
					layer.open({
						content: '亲，已经没有更多信息哟',
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
	<?php include("pages/footer.php");?>
  </body>
	
</html>
