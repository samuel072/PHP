<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>商品信息管理列表</title>

  <link rel="stylesheet" href="/m/pages/css/admin.css"/> 
  <link rel="stylesheet" href="/m/pages/css/admin_activity.css"/> 
</head>

<body>

  <!-- 商品列表 -->
  <div class="act_list">
    <ul>
      <li class="header percent10">编号</li>
      <li class="header percent20">商品名称</li>
	  <li class="header percent10">兑换积分</li>
	  <li class="header percent10">有效期</li>
	  <li class="header percent10">数量</li>
      <li class="header percent20">操作</li>
    </ul>

    <?php foreach($comm_list as $commodity) { ?>
    <ul>
      <li class="percent10 header"><?php echo $commodity->id; ?></li>
      <li class="percent20 header"><?php echo $commodity->name; ?></li>
	  <li class="percent10 header"><?php echo $commodity->price; ?></li>
	  <li class="percent10 header"><?php echo $commodity->duration; ?></li>
	  <li class="percent10 header"><?php echo $commodity->count; ?></li>
	  <li class="percent20 header">
		<a href="/m/admin.php?mod=edit_commodity&comm_id=<?php echo $commodity->id; ?>" target="mainFrame">编辑</a> 
      </li>
    </ul>
    <?php } ?>
  </div>
	
  <div class="buttons">
    <a href="/m/admin.php?mod=edit_commodity" target="mainFrame">添加商品</a>
  </div>

  <!-- 分页 -->
  <?php include(ykfile('pages/admin/pager.php')); ?>
<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	
/*	function del(com_id, is_delete) {
		$.ajax({
			url:'/api/user.php?mod=remove_commodity&is_delete='"+is_delete+"'&com_id='+com_id,
			type:'get',
			dataType:'json',
			success:function(data) {
				location.reload();
			}
		});
	}*/
</script>

</body>
</html>
