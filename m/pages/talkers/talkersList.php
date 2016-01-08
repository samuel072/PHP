<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
	<title>点他来讲</title>
    <link rel="stylesheet" href="/m/pages/css/commons.css"/>
    <link rel="stylesheet" href="/m/pages/css/talker.css"/>
	<link rel="stylesheet" href="/m/pages/css/header.css"/>
</head>

<body >
  <?php include(ykfile("pages/left.php")); ?>
  <div class="wrap">

	<?php include(ykfile("pages/header_category.php")); ?>
    <div class="body_div">

      <?php foreach($talkers as $talker) { ?>
      <div class="content_div">
        <img src="<?php echo $talker->image ?>" class="ta_img"/>

        <div class="ta_comment">
          <span class="ta_font">
            <span class="name name_num"><?php echo $talker->name  ?></span>
            <!--span class="comm">已有</span-->
            <font class="name_num name_num_<?php echo $talker->id ?>" color="#FE8503"><?php echo $talker->points ?></font>
            <span class="comm">人点TA来讲</span>
          </span>

          <a class="ta_link" href="javascript:void(0)" data-uuid="<?php echo $talker->id ?>" onclick="tc_a(<?php echo $talker->id ?>)">
            <img src="/m/pages/images/ta.png" class="ta_click"/>
          </a>
        </div>
      </div>
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
      if($(document).height() - $(window).scrollTop() - $(window).height() < 100) {
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
          url:"/m/api/talkers.php?next_id=" + next_id + "&count=10",
          type:"get",
          dataType:"json",
          contentType: 'application/json',
          beforeSend:function() { // 执行之前
			layer.open({
				type: 2,
				content: "<img src='/m/pages/images/load.gif' />",
				style: 'width:80%;min-height:100px;max-height:200px;text-align:center;',
				shadeClose:false,
			});
          },
          success:function(data) {
            if(data.status != 0) {
			  layer.closeAll();
			  layer.open({
				  content : '亲，没有更多的信息哟',
				  className: 'layer_tips_back',
				  shadeClose: false,
				  time : 2
			  });
              return ;
            }

            var talker_list = data.talkers;
            if(talker_list.length != 0){
				layer.closeAll();
				num = 0;
			}

            for(var i = 0; i < talker_list.length; i ++) {
              html += "<div class='content_div'>" +
                        "<img src=" + talker_list[i]['image'] + " class='ta_img'/>" +
                        "<div class='ta_comment'>" +
                          "<span class='ta_font'>" +
                            "<span class='name name_num'>" + talker_list[i]['name'] + "</span>" +
                            "<!--span class='comm'>已有</span-->" +
                            "<font class='name_num name_num_" + talker_list[i]['id'] + "' color='#FE8503'>" + talker_list[i]['points'] + "</font>" +
                            "<span class='comm'>人点TA来讲</span>" +
                          "</span>" +
                          "<a href='javascript:void(0);' data-uuid=" + talker_list[i]['id'] + " onclick='tc_a(" + talker_list[i]['id'] + ")'>" +
                            "<img src='/m/pages/images/ta.png' class='ta_click'/>" +
                          "</a>" +
                        "</div>"+
                      "</div>";
            }
            $(".body_div").append(html);
		},
        error:function(data) {
          //alert(datas);
          console.log("data error");
        }
      });
    }
  }
		
		function tc_a(talker_id){
			$.ajax({
				url:"/m/api/user.php?mod=talker&talker_id="+talker_id,
				type:"get",
				dataType:"json",
				contentType: 'application/json',
				success:function(data){
					if(data.message == 'success'){
						$(".name_num_"+talker_id).html(data.points);
						layer.open({
							  content : '亲，姿势正确！',
							  className: 'layer_tips_back',
							  shadeClose: false,
							  time : 2
						});
					}else{
						var  message = data.message;
						layer.open({
							  content : message,
							  className: 'layer_tips_back',
							  shadeClose: false,
							  time : 2
						});
					}
					
				},
				error:function(){
					alert("系统内部错误");
				}
			});
		}
		
  </script>

<?php include(ykfile("pages/footer.php"));?>
</body>
</html>
