<!DOCTYPE html>
<head lang="en">
  <meta charset="UTF-8">
  <title>个人中心</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
  <link rel="stylesheet" href="/m/pages/css/commons.css"/>
  <link rel="stylesheet" href="/m/pages/css/header.css" />
  <link rel="stylesheet" href="/m/pages/css/user.css" />
</head>

<body>
  <?php include(ykfile("pages/left.php")); ?>

  <div class="wrap">
    <?php include(ykfile("pages/header_category.php")); ?>

    <div class="index_body_div">
      <!--如果登录了-->
      <?php
      if(!empty($_SESSION['current_user'])) {
      $userInfo = unserialize($_SESSION['current_user']);
      ?>

      <div class="info_head_signin">
		<?php  if(stristr($userInfo->avatar, 'http')) { ?>
        <img src="<?php echo $userInfo->avatar; ?>" class="info_img"/>
		<?php }else {?>
        <img src="http://www.yueduke.com<?php echo $userInfo->avatar; ?>" class="info_img"/>
		<?php }?>
          <p class="info_summary_head">
            <span class="span_left_head">姓名：<?php echo $userInfo->name; ?></span>

            <span class="span_right_head">积分：<?php echo $userInfo->scores; ?></span>
            <span><a href="/m/user.php?mod=profile" class="gt_head"><img src="/m/pages/images/arrow_white.png"/></a></span>
         </p>
      </div>

      <?php } else { ?>
      <!--如果没有登录-->
      <div class="info_head_notsignin">
        <a href="/m/user.php?mod=signin" class="signin">
          <img width="70" height="70" src="/m/pages/images/signin_btn.png"/>
        </a>
      </div>
      <?php } ?>
			
      <div class="info_body">
        <p class="info_summary">
          <a href="/m/commodity.php">
            <span class="span_left">积分商城</span>
            <img class="span_right_gt" src="/m/pages/images/arrow_black.png" />
          </a>
        </p>
      </div>

      <div class="info_body">
        <p class="info_summary">
          <a href="/m/user.php?mod=appoint_record">
            <span class="span_left">我预约的</span>
            <img class="span_right_gt" src="/m/pages/images/arrow_black.png" />
          </a>
        </p>

        <p class="info_summary">
          <a href="/m/user.php?mod=favorite">
            <span class="span_left">我收藏的</span>
            <img class="span_right_gt" src="/m/pages/images/arrow_black.png" />
          </a>
        </p>

        <p class="info_summary">
          <a href="/m/user.php?mod=join_record">
            <span class="span_left">我参加的</span>
            <img class="span_right_gt" src="/m/pages/images/arrow_black.png" />
          </a>
        </p>

        <p class="info_summary">
          <a href="/m/user.php?mod=sub_record">
            <span class="span_left">我发布的</span>
            <img class="span_right_gt" src="/m/pages/images/arrow_black.png" />
          </a>
        </p>

        <p class="info_summary">
          <a href="/m/user.php?mod=exchange_record">
            <span class="span_left">我兑换的</span>
            <img class="span_right_gt" src="/m/pages/images/arrow_black.png" />
          </a>
        </p>
      </div>

      <div class="info_body">
        <p class="info_summary">
          <a href="http://www.wenjuan.com/s/jEzi2m">
            <span class="span_left">意见反馈</span>
            <img class="span_right_gt" src="/m/pages/images/arrow_black.png" />
          </a>
        </p>

        <p class="info_summary">
          <a href="http://wapbaike.baidu.com/item/%E4%B8%80%E5%88%BB%E6%BC%94%E8%AE%B2?adapt=1&fr=aladdin&bd_source_light=1701851">
            <span class="span_left">关于一刻演讲</span>
            <img class="span_right_gt" src="/m/pages/images/arrow_black.png" />
          </a>
        </p>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="/m/pages/js/common.js"></script>

  <?php include(ykfile("pages/footer.php"));?>
</body>
</html>
