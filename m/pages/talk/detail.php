<html>
  <head lang="en">
    <meta charset="UTF-8">
    <title>演讲介绍</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
    <link rel="stylesheet" href="/m/pages/css/commons.css"/>
    <link rel="stylesheet" href="/m/pages/css/talk.css"/>
    <link rel="stylesheet" href="/m/pages/css/header.css" />
    <link rel="stylesheet" href="/m/pages/css/comment.css" />
  </head>

  <body>
    <?php include(ykfile("pages/header_detail.php")); ?>

    <div class="content_div_talk">
      <div class="con_header_div_talk">
        <img src="<?php echo $talk->guest_avatar ?>" class="con_header_img_talk"/>
      </div>

      <p class="con_name_talk"><?php echo $talk->guest_name ?></p>
      <p class="con_summary_talk"><?php echo $talk->guest_intro ?></p>
			
      <?php foreach($talk->content as $section){ ?>

      <?php if($section->type == 0) { //段落类型  0：文字 1：图片 2：链接 3：视频 4：标题 ?>
      <p class="sec_con_content"><?php echo str_replace("\n", "<br/>", $section->detail); ?></p>

      <?php } else if($section->type == 1) { ?>
      <div class="sec_con_img_img">
      <a href="<?php echo $section->link; ?>"><img src="<?php echo $section->image_path ?>" class="sec_con_img" /></a>
      </div>

      <?php } else if($section->type == 2) { ?>
      <a class="sec_a_link" href="<?php echo $section->link; ?>"><?php echo $section->detail; ?></a>

      <?php } else if($section->type == 3) { ?>
      <a href="<?php echo $section->link ?>"><img src="<?php echo $section->image_path ?>"  class="sec_con_img" /></a>
      <div class="sec_con_click">
        <!-- 视频播放装置 start-->
        <a href="<?php echo $section->link ?>" class="sec_a_link" ><img src="/m/pages/images/DEY.png"></a>
        <!-- end -->
      </div>
      <div class="sec_con_title">
        <p class="sec_con_title_summ"><?php echo $talk->title ?></p>
      </div>
      <!--<p class="sec_con_content">播放<span class="cdt_font">1969</span>次|喜欢<span class="cdt_font">1246</span>次|评论<span class="cdt_font">699</span>次</p>-->

      <?php } else if($section->type == 4) { ?>
        <h3 class="sec_title"><?php echo $section->detail; ?></h3>
      <?php } ?>
      <?php } ?>

      <div class="sec_con_img_logo">
        <img src="/m/pages/images/yike_logo.jpg"  class="sec_con_img" />
      </div>
    </div>

    <div class="comments_body_div comment-border">
      <?php foreach ($comments as $comment) {?>
      <div class="comment">
        <img src="<?php echo $comment->user->avatar; ?>" class="user_img"/>
        <div class="comment_summary">
          <p class="data"><?php echo $comment->subtime; ?></p>
          <p class="nick"><?php echo $comment->user->name; ?></p>
          <p class="summary"><?php echo $comment->detail; ?></p>
        </div>
      </div>
      <?php } ?>

      <a href="/m/comment.php?next_id=0&count=10&act_id=<?php echo $talk->id;?>" class="more_comment all_comment-left">全部评论</a>
      <a href="/m/comment.php?next_id=0&count=10&act_id=<?php echo $talk->id; ?>" class="more_comment all_comment-right">点击评论</a>
    </div>
	<?php include(ykfile("pages/footer.php"));?>
  </body>
</html>
