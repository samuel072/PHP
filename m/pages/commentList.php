<!DOCTYPE html>
<html>

<head lang="en">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
  <title>演讲评论</title>
  <link rel="stylesheet" href="/m/pages/css/commons.css"/>
  <link rel="stylesheet" href="/m/pages/css/comment.css"/>
  <link rel="stylesheet" href="/m/pages/css/header.css" />
</head>

<body style="background:#fff">
  <?php include(ykfile('pages/header_detail.php')); ?>

  <div class="comments_body_div">
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

    <!--做异步加载的时候，应该空出距屏幕底部60的距离-->
  </div>

  <div class="comment_footer">
    <input type="text" placeholder="添加评论" name="comment" class="comment_content"/>
    <a href="javascript:void(0)" onclick="send_comment();" class="send">发送</a>
  </div>

  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
  <script type="text/javascript" src="/m/pages/js/layer.js"></script>

  <script type="text/javascript">

    function send_comment() {
      if(!check()) {
        return ;
      }

      var user_id = "";
      <?php if(!empty($_SESSION['current_user'])) { ?>
      <?php $userinfo = unserialize($_SESSION['current_user']); ?>
      user_id = '<?php echo $userinfo->uuid; ?>';	
      <?php } ?>

	  var act_id = <?php echo $_GET['act_id']?>;
	  var detail = $(".comment_content").val();
	  var params = { "user_id": user_id, "act_id": act_id, "detail": detail };
	  var json_data = $.toJSON(params);

	  $.ajax({
	    url:"/m/api/user.php?mod=comment",
	    type:"post",
	    data:json_data,
	    dataType:"json",
	    contentType:"application/json",
	    success:function(data) {
          if(data.status == 0) {
			var message = data.message;
			var i = 0;
			setInterval(function() {
				var msg = message[i];
				if(undefined != msg) {
					layer.open({content:msg, className:'layer_tips_back', time:1});
					if(i< message.length) {
						i++;
					}
				}
			}, 1000);
			setTimeout('window.location.reload()', 3000);
          } else {
	      	layer.open({
			  content:'亲，评论失败哦！',
			  className:'layer_tips_back',
     		  time:1
			});
		  }   
	    },
        error:function() {
          alert("系统内部错误");
        }
      });	
    }

    // 数据校验
    function check() {
      var detail = $(".comment_content").val();
      if(detail == "") {
        alert("请填写评论内容！");
        return false;
      }

      <?php if(empty($_SESSION['current_user'])) { ?>
      alert("请您先登陆！");
      return false;
      <?php } else { ?>
      return true;
      <?php } ?>
    }

    // 加载, 滚动条到达底部100像素时候
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
          url:"/api/comment.php?next_id=" + next_id + "&count=10&act_id=<?php echo $_GET['act_id']?>",
          type:"get",
          dataType:"json",
          success:function(data) {
            if(data.status != 0) {
            	layer.open({
				  content: data.message,
				  className: 'layer_tips_back',
				  time:2
				});  
			
				return ;
            }

            var comment = data.comments;
            for(var i = 0; i < comment.length; i ++) {
              html += "<div class='comment'>" +
                        "<img src=\"comment[i]['user']['avatar']\" class='user_img'/>" +
                        "<div class='comment_summary'>" +
                          "<p class='data'>" + comment[i]['subtime'] + "</p>" +
                          "<p class='nick'>" + comment[i]['user']['name'] + "</p>" +
                          "<p class='summary'>" + comment[i]['detail'] + "</p>" +
                        "</div>"+
                      "</div>";
            }

            $(".comments_body_div").append(html)
            if(comment.length != 0) {
              num = 0;
            }	
          },
          error:function(xhr, data, status) {
          }
        });
      }
    }
</script>
<?php include(ykfile("pages/footer.php"));?>
</body>
</html>
