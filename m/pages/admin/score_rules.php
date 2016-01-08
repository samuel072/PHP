<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>积分规则</title>

  <link rel="stylesheet" href="/m/pages/css/admin.css"/> 
  <link rel="stylesheet" href="/m/pages/css/admin_score.css"/> 
</head>

<body>

  <div class="rule_list">
    <ul>
      <li class="header percent5">编号</li>
      <li class="header percent20">规则名</li>
      <li class="header percent8">每日上限</li>
      <li class="header percent8">小时上限</li>
      <li class="header percent30">有效期</li>
      <li class="header percent5">积分</li>
      <li class="header percent10">积分点</li>
      <li class="header percent5">操作</li>
    </ul>

    <?php foreach($rules as $rule) { ?>
    <ul>
      <li class="header percent5"><?php echo $rule->id; ?></li>
      <li class="header percent20"><?php echo $rule->title; ?></li>
      <li class="header percent8"><?php echo $rule->times_in_day; ?></li>
      <li class="header percent8"><?php echo $rule->times_in_hour; ?></li>
      <li class="header percent30"><?php echo $rule->start_time . " -- " . $rule->end_time; ?></li>
      <li class="header percent5"><?php echo $rule->amount; ?></li>
      <li class="header percent10"><?php echo $rule->point->title; ?></li>
	  <li class="percent5 header">
		<a href="/m/admin.php?mod=edit_score_rule&rule_id=<?php echo $rule->id; ?>" target="mainFrame">编辑</a>
      </li>
    </ul>
    <?php } ?>
  </div>

  <div class="buttons">
    <a href="/m/admin.php?mod=edit_score_rule" target="mainFrame">添加规则</a>
  </div>

  <!-- 分页 -->
  <?php include(ykfile('pages/admin/pager.php')); ?>

</script>

</body>
</html>
