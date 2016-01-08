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
  
</head>

<body>

  <!-- 活动列表 -->
  <div class="act_list">
    <ul>
      <li class="header percent10">编码</li>
      <li class="header percent40">活动标题</li>
      <li class="header percent20">活动类型</li>
      <li class="header percent20">操作</li>
    </ul>

    <?php foreach($act_list as $activity) { ?>
    <ul>
      <li class="header percent10"><?php echo $activity->id; ?></li>
      <li class="header percent40"><?php echo $activity->title ?></li>

	  <?php if($activity->type == 0) { ?>
      <li class="header percent20">演讲</li>
      <?php } else if($activity->type == 1) { ?>
      <li class="header percent20">沙龙活动</li>
      <?php } else if($activity->type == 2) { ?>
      <li class="header percent20">公开课</li>
      <?php } ?>

      <li class="header percent20">
		<a href="/m/admin.php?mod=edit_activity&act_id=<?php echo $activity->id; ?>" target="mainFrame">编辑</a> | 
		<?php
			if($activity->is_delete == 0){ ?>
				<a href="javascript:void(0);" onclick="del(<?php echo $activity->id; ?>, <?php echo $activity->type; ?>, 1);">删除</a>
				
	<?php	}else { ?>
				<a href="javascript:void(0);" onclick="del(<?php echo $activity->id; ?>, <?php echo $activity->type; ?>, 0);">已删除</a>
		
	<?php	}
		?>
		
	  </li>
    </ul>
    <?php } ?>
  </div>
	
  <div class="buttons">
    <a href="/m/admin.php?mod=edit_activity" target="mainFrame">添加</a>
  </div>

  <!-- 分页 -->
  <?php include(ykfile('pages/admin/pager.php')); ?>
<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	//
	function del(act_id, type, is_delete) {
		$.ajax({
			url:'/m/api/user.php?mod=remove_activity&act_id='+act_id+'&type='+type+'&is_delete='+is_delete,
			type:'get',
			dataType:'json',
			success:function(data) {
				location.reload();
			}
		});
		
	}	
</script>
</body>
</html>
