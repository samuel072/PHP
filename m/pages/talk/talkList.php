<!DOCTYPE html>
<html>

<head lang="en">
    <meta charset="UTF-8">
    <title>热门演讲</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
	<link rel="stylesheet" href="/m/pages/css/commons.css"/>
	<link rel="stylesheet" href="/m/pages/css/talk.css"/>
	<link rel="stylesheet" href="/m/pages/css/header.css" />
</head>

<body>
  <?php include(ykfile("pages/left.php")); ?>

  <div class="wrap">
	<?php include(ykfile("pages/header_category.php")); ?>

	<div class="content_div_talk">

      <?php if(!empty($talk_list)) { ?>
      <?php foreach($talk_list as $talk) { ?>
      <div class="con_header_div_talk">
        <img src="<?php echo $talk->guest_avatar; ?>" class="con_header_img_talk" />
      </div>
      <p class="con_name_talk"><?php echo $talk->guest_name; ?></p>
      <p class="con_summary_talk"><?php echo $talk->guest_intro; ?></p>
      <a href="/m/talk/detail.php?id=<?php echo $talk->id; ?>">
        <img src="<?php echo $talk->thumbnail; ?>" class="con_img_talk" />
      </a>

      <div class="con_click_talk">
        <a href="/m/talk/detail.php?id=<?php echo $talk->id; ?>"><img src="/m/pages/images/DEY.png"></a>
      </div>

      <div class="con_title_talk">
        <p class="con_title_summ_talk"><?php echo $talk->title; ?></p>
      </div>
      <p class="con_content_talk"><?php echo $talk->summary; ?></p>
      <div class="line_talk"><img src="/m/pages/images/line.png" width="100%"></div>
      <?php } ?>
      <?php } ?>
    </div>
  </div>

  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
  <script type="text/javascript" src="/m/pages/js/common.js"></script>
  <script type="text/javascript" src="/m/pages/js/layer.js"></script>
  <script type="text/javascript">
    //滚动条到达底部100像素时候
    $(window).scroll(function() { 
      // 当滚动到最底部以上100像素时， 加载新内容  
      if ($(document).height() - $(window).scrollTop() - $(window).height() < 100) {
        loadMessage();
        var to = setTimeout("", 10000);
      }
    });

    var num = 0;
    var next_id = 0;
    function loadMessage() {
      var html = "";
      if(num == 0) {
        next_id = next_id + 10;
        num = 1;
        $.ajax({
          url:"/m/api/talk.php?next_id=" + next_id + "&count=10",
          type:"get",
          dataType:"json",
          beforeSend:function() { // 执行之前
            layer.open({
              type: 2,
              content: "<img src='/m/pages/images/load.gif'>",
              style: 'width:80%;min-height:100px;max-height:200px;text-align:center;',
              shadeColse: false,
            });
          },
          success:function(data) {
            var talk_list = data.activities;
            if(talk_list.length != 0) {
              layer.closeAll();
              num = 0;
              for(var i = 0; i < talk_list.length; i ++) {
                html += "<div class='con_header_div_talk'>" +
                          "<img src=" + talk_list[i]['guest_avatar'] + " class='con_header_img_talk'/>" +
                        "</div>" +
                        "<p class='con_name_talk'>" + talk_list[i]['guest_name'] + "</p>" +
                        "<p class='con_summary_talk'>" + talk_list[i]['guest_intro'] + "</p>" +
                        "<a href='/m/talk/detail.php?id=" + talk_list[i]['id'] + "'><img src=" + talk_list[i]['thumbnail'] + "  class='con_img_talk' /></a>" +
                        "<div class='con_click_talk'>" +
                          "<a href='/m/talk/detail.php?id=" + talk_list[i]['id'] + "'>" +
                            "<img src='/m/pages/images/DEY.png'></a>" +
                        "</div>" +
                        "<div class='con_title_talk'>" +
                          "<p class='con_title_summ_talk'>" + talk_list[i]['title'] + "</p>" +
                        "</div>" +
                        "<p class='con_content_talk'>" + talk_list[i]['summary'] + "</p>" +
                        "<div class='line_talk'><img src='/m/pages/images/line.png' width='100%'></div>";
			  }
              $(".content_div_talk").append(html);
            } else {
              layer.closeAll();
              layer.open({
                content: '亲，已经没有更多信息哟',
                className: 'layer_tips_back',
                shadeClose: false,
                time: 2
            });
          }
        }
      });
    }
  }
  </script>
<?php include(ykfile("pages/footer.php"));?>
</body>
</html>
