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
      <li class="header percent5">编号</li>
      <li class="header percent50">评论内容</li>
      <li class="header percent8">用户</li>
      <?php if($activity !== NULL) { ?>
      <li class="header percent8">位置</li>
      <?php } else { ?>
      <li class="header percent20">演讲</li>
      <?php } ?>
      <li class="header percent8">操作</li>
    </ul>

    <?php foreach($comments as $comment) { ?>
    <ul>
      <li class="percent5 header"><?php echo $comment->id; ?></li>
      <li class="percent50"><?php echo $comment->detail; ?></li>
      <li class="percent8"><?php echo $comment->user->name; ?></li>
      <?php if($activity !== NULL) { ?>
      <li class="header percent8"><?php echo $comment->position; ?></li>
      <?php } else { ?>
      <li class="percent20"><?php echo $comment->activity->title; ?></li>
      <?php } ?>
	  <li class="percent8 header">
		<a href="/m/admin.php?mod=edit_comment&com_id=<?php echo $comment->id; ?>" target="mainFrame">编辑</a>
		|
		<a href="javascript:void(0);" onclick="remove_comment(<?php echo $comment->id; ?>)" >删除</a>
      </li>
    </ul>
    <?php } ?>
  </div>
	
  <!-- 分页 -->
  <?php include(ykfile('pages/admin/pages.php')); ?>

  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript">
	function remove_comment(com_id) {
		$.ajax({
			url:'/m/api/user.php?mod=remove_comment&com_id=' + com_id,
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
