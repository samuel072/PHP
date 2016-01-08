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
      <li class="header percent10">编号</li>
      <li class="header percent40">人物名称</li>
	  <li class="header percent10">点击数</li>
      <li class="header percent20">操作</li>
    </ul>

    <?php foreach($talker_list as $talker) { ?>
    <ul>
      <li class="percent10 header"><?php echo $talker->id; ?></li>
      <li class="percent40 header"><?php echo $talker->name; ?></li>
	  <li class="percent10 header"><?php echo $talker->points; ?></li>
	  <li class="percent20 header">
		<a href="/m/admin.php?mod=edit_talker&talker_id=<?php echo $talker->id; ?>" target="mainFrame">编辑</a>
      </li>
    </ul>
    <?php } ?>
  </div>
	
  <div class="buttons">
    <a href="/m/admin.php?mod=edit_talker" target="mainFrame">添加人物</a>
  </div>

  <!-- 分页 -->
  <?php include(ykfile('pages/admin/pager.php')); ?>
<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	//
/*	function del(act_id, type, is_delete) {
		$.ajax({
			url:'/api/user.php?mod=remove_activity&act_id='+act_id+'&type='+type+'&is_delete='+is_delete,
			type:'get',
			dataType:'json',
			success:function(data) {
				location.reload();
			}
		});
		
	}	*/
</script>

</body>
</html>
