<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>活动列表</title>
  <link rel="stylesheet" href="/m/pages/css/admin.css"/> 
  <link rel="stylesheet" href="/m/pages/css/admin_activity.css"/> 
<style>		  
.layer_in_txt {border:none; font-size:16px; outline:none; resize:none; margin-left:10px; margin-top:5px; font-family:'宋体';}
</style>
</head>

<body>

  <!-- 活动列表 -->
  <div class="act_list">
    <ul>
      <li class="header percent5">编码</li>
      <li class="header percent10">活动状态</li>
      <li class="header percent40">活动标题</li>
      <li class="header percent20">活动类型</li>
      <li class="header percent20">操作</li>
    </ul>

    <?php foreach($act_list as $activity) { ?>
    <ul>
      <li class="header percent5"><?php echo $activity->id; ?></li>
      <li class="header percent10"><?php if($activity->state == 0){?>审核中 <?php } else if($activity->state == 1){?>驳回 <?php } else if($activity->state == 2){; ?>发布<?php }?>
         
	  </li>
      <li class="header percent40"><?php echo $activity->title ?></li>

	  <?php if($activity->type == 0) { ?>
      <li class="header percent20">演讲</li>
      <?php } else if($activity->type == 1) { ?>
      <li class="header percent20">沙龙活动</li>
      <?php } else if($activity->type == 2) { ?>
      <li class="header percent20">公开课</li>
    <?php } ?>

      <li class="header percent20">
				<a href="javascript:void(0)" onclick="sub_edit">编辑</a> | 
				<a href="javascript:void(0)" onclick="audit(<?php echo $activity->id;?>, 2);">通过</a> |  
				<a href="javascript:void(0)" onclick="audit(<?php echo $activity->id;?>, 1);">驳回</a> 
			</li>
			
    </ul>
    <?php } ?>
  </div>

  <!-- 分页 -->
  <?php include(ykfile('pages/admin/pager.php')); ?>
<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/m/pages/js/layer.js"></script>
<script type="text/javascript">
	function audit(act_id, state) {
		if(state == 1) {
		  var page_one = layer.open({
				type:1,
				btn:['确定'],
				content:"<textarea rows='5' cols='100' class='layer_in_txt' name='messgae'></textarea>",
				shadeClose:false,
				yes:function() {
					$.ajax({
						url:'/m/api/user.php?mod=set_act_state',
						type:'get',
						data: {"act_id":act_id, "state":state, "reject":$(".layer_in_txt").val()},
						dataType:'json',
						success:function(data){
							layer.close(page_one);
							if(data.status == 0) {
								layer.open({
									content:'成功！',
									className:'layer_tips_back',
									time:1
								});
							setTimeout("location.reload();", 2000);
							} else {
								layer.open({
									content:'审核失败, 请重新审核',
									className:'layer_tips_back',
									time:2
								});
							}
						}

					});

				}
		  });
		}else {
			$.ajax({
				url:'/m/api/user.php?mod=set_act_state',
				type:'get',
				data: {"act_id":act_id, "state":state, "reject":""},
				dataType:'json',
				success:function(data){
					if(data.status == 0) {
						layer.open({
							content:'成功！',
							className:'layer_tips_back',
							time:2
						});
					} else {
						layer.open({
							content:'审核失败, 请重新审核',
							className:'layer_tips_back',
							time:2
						});
					}
				}

			});
		}
	}
</script>
</body>
</html>
