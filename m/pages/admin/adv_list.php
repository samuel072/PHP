<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>广告列表</title>

  <link rel="stylesheet" href="/m/pages/css/admin.css"/> 
  <link rel="stylesheet" href="/m/pages/css/admin_adv.css"/> 
</head>

<body>

  <div class="adv_list">
    <ul>
      <li class="list_header percent10">编号</li>
      <li class="list_header percent30">标题</li>
	  <li class="list_header percent30">链接</li>
	  <li class="list_header percent20">操作</li>
    </ul>

    <?php foreach($adv_list as $adv) { ?>
    <ul>
      <li class="percent10 header"><?php echo $adv->id; ?></li>
      <li class="percent30 header"><?php echo $adv->title; ?></li>
	  <li class="percent30 header"><?php echo $adv->link; ?></li>
	  <li class="percent20 header">
		<a href="/m/admin.php?mod=edit_adv&adv_id=<?php echo $adv->id; ?>" target="mainFrame">编辑</a>
      </li>
    </ul>
    <?php } ?>
  </div>
	
  <div class="buttons">
    <a href="/m/admin.php?mod=edit_adv" target="mainFrame">添加广告</a>
  </div>

  <!-- 分页 -->
  <?php include(ykfile('pages/admin/pager.php')); ?>

  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>

</body>
</html>
