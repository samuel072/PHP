<html>

<head lang="en">
  <meta charset="UTF-8">
  <title>积分规则</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
  <link rel="stylesheet" href="/m/pages/css/commons.css"/>
  <link rel="stylesheet" href="/m/pages/css/header.css" />
  <link rel="stylesheet" href="/m/pages/css/user.css" />
</head>

<body>
  <?php $page_title = '积分规则'; ?>
  <?php include(ykfile('pages/header_detail.php')); ?>

  <div class="rules_body_div">
    <p class="rules_summary_title">什么是一刻积分</p>
    <p class="rules_summary">
      一刻积分是对用户使用一刻网站和客户端的回馈。用户成功使用一刻网站和客户端的某次活动即产生积分;
      一刻积分可以用来在积分商城里面兑换一些实物或虚拟奖品。
    </p>

    <p class="rules_summary_title">积分细则</p>
    <?php for($i = 0; $i < count($rules); $i ++) { ?>
    <p class="rules_detail"><?php echo ($i + 1) .  ". " . $rules[$i]->detail; ?></p>
    <?php } ?>
    <p class="rules_bottom">最终解释权归一刻演讲所有</p>
    <img src="/m/pages/images/line.png" width="100%" />
  </div>

  <?php include(ykfile('pages/footer.php')); ?>
</body>
</html>
