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
      <li class="header percent40">活动标题</li>
      <li class="header percent20">操作</li>
      <li class="header percent20">管理评论</li>
    </ul>

    <?php foreach($talk_list as $talk) { ?>
    <ul>
      <li class="percent10 header"><?php echo $talk->id; ?></li>
      <li class="percent40"><?php echo $talk->title ?></li>
	  <li class="percent20 header">
		<a href="/m/admin.php?mod=edit_talk&talk_id=<?php echo $talk->id; ?>" target="mainFrame">编辑</a>
		|
		<?php if($talk->is_delete == 0) { ?>
        <a href="javascript:void(0);" onclick="del(<?php echo $talk->id; ?>, <?php echo $talk->type; ?>, 1)" >删除</a>
		<?php } ?>
		<?php if($talk->is_delete != 0) { ?>
        <a href="javascript:void(0);" onclick="del(<?php echo $talk->id; ?>, <?php echo $talk->type; ?>, 0)" >已删除</a>
		<?php } ?>
      </li>
      <li class="header percent20">
        <a href="/m/admin.php?mod=comment&next_id=0&count=10&act_id=<?php echo $talk->id; ?>">管理评论</a>
      </li>
    </ul>
    <?php } ?>
  </div>
	
  <div class="buttons">
    <a href="/m/admin.php?mod=edit_talk" target="mainFrame">添加演讲</a>
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
