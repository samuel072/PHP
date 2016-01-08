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
      <li class="header percent20">用户名称</li>
      <li class="header percent8">波动积分</li>
      <li class="header percent8">规则名称</li>
			<li class="header percent8">总积分</li>
      <li class="header percent30">积分获取的方式</li>
    </ul>

    <?php foreach($score_list as $score_record) { ?>
    <ul>
      <li class="header percent5"><?php echo $score_record->id; ?></li>
      <li class="header percent20"><?php echo $score_record->user->name; ?></li>
      <li class="header percent8"><?php echo $score_record->amount; ?></li>
      <li class="header percent8"><?php echo $score_record->rule->title; ?></li>
			<li class="header percent8"><?php echo $score_record->user->scores; ?></li>
      <li class="header percent30"><?php if($score_record->type==1){echo "积分兑换" ;}else{echo "积分获取"; }?></li>
    </ul>
    <?php } ?>
  </div>
  <!-- 分页 -->
  <?php include(ykfile('pages/admin/pager.php')); ?>

</script>

</body>
</html>
