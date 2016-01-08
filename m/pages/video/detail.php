<?php
require_once(ykfile("wxapi/jssdk.php"));
$jssdk = new JSSDK("wx1bd28c923d97ffdb", "d56aa861e47c0b2cd1787c77ad934ec6");
$signPackage = $jssdk->GetSignPackage();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<title><?php echo $video->title; ?></title>
<link href="/m/pages/css/style_comm.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/m/pages/css/style_540.css" />
<link href="/m/pages/css/idangerous.swiper.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="/m/pages/js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="/m/pages/js/idangerous.swiper.min.js"></script>
<script src="/m/pages/js/jq_aux.js" type="text/javascript"></script>

</head>
<body>
<header>
    <div class="head">
        <h4>一刻直播</h4>
        <div class="layer_return"><a href="javascript:history.go(-1);"></a></div>
      <!--  <div class="layer_out"><a href="javascript:void(0);" id="share"></a></div> -->
    </div>
</header>
<section>
    <div>
           <!-- http://www.quklive.com/q3/embed/a/<?php echo $video->video_id; ?>?autoPlay=true alt="img"/> http://cloud.quklive.com/cloud/a/embed/9437187408433913  -->
<iframe width="100%" height="235" src="http://cloud.quklive.com/cloud/a/embed/<?php echo $video->video_id; ?>"></iframe> 
    </div>    
</section>
<div class="clear"></div>
<!--
<section> 
    <div class="userinfo">
        <span class="user">
            <img src="/m/pages/images/l02.png" alt="img"/>
            <div class="infocase">
                <h4><div class="username">速写本子</div><div class="level"><img src="/m/pages/images/icon_girl.png" alt="level"/><img src="/m/pages/images/icon_bigV.png" alt="level"/></div></h4>
                <h5>18场活动直播</h5>
            </div>
        </span>
        <span class="focus"><a href="#"><img src="/m/pages/images/icon_focused.png" alt="focus"/></a></span>
    </div>
</section>
 
<section>
    <div class="userlist">
        <div class="carouselcase">
            <div class="swiper-container swiper-container-carousel">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l03.png"></a></div>
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l04.png"></a></div>
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l05.png"></a></div>
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l06.png"></a></div>
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l07.png"></a></div>
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l08.png"></a></div>
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l09.png"></a></div>
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l10.png"></a></div>
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l11.png"></a></div>
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l12.png"></a></div>
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l13.png"></a></div>
                    <div class="swiper-slide"><a href="#" target="_blank"><img src="/m/pages/images/l14.png"></a></div>
                </div>
            </div>  
        </div> 
    </div>
</section>-->
<section class="set_list">
    <div class="talklist">
        <div class="spiclecase">
            <a class="spicle-arrow-right" href="#"></a>
            <div class="swiper-container swiper-container-spicle">
                <div class="swiper-wrapper">
                    <div class="swiper-slide swiper-slide-spicle">
                       <ol>
                           <li class="date"><?php echo date("Y-m-d H:i", strtotime($video->start_time))?> ~ <?php echo date("m-d H:i", strtotime($video->end_time))?></li>
                           <li class="pl"><?php echo $video->address; ?></li>
                           <li class="sd"><?php echo $video->category->name; ?></li>
                           <li class="fr"><?php foreach ($video->tags as $tag){$str .= $tag->name ."、 " ; } echo substr($str, 0, strripos($str, "、")); ?></li>
                       </ol>
                    </div>
                    <div class="swiper-slide swiper-slide-spicle">
                       <a href="#" target="_blank"><img src="/m/pages/images/l15.jpg" alt="map"></a>
                    </div>
                    <div class="swiper-slide swiper-slide-spicle">
                       <p>
                   			<?php foreach($video->content as $section){ ?>
				<?php if($section->type == 0) { //段落类型  0：文字 1：图片 2：链接 3：视频 4：标题 ?>
				<p class="sec_con_content"><?php echo str_replace("\n", "<br/>", $section->detail); ?></p>
				<?php } else if($section->type == 1) { ?>
					<div class="sec_con_img_img">
						<a href="<?php echo $section->link; ?>" ><img src="<?php echo $section->image_path ?>"  class="sec_con_img" /></a>
					</div>
				<?php } else if($section->type == 2) { ?>
					<a class="sec_a_link" href="<?php echo $section->link; ?>"><?php echo $section->detail; ?></a>
				<?php } else if($section->type == 3) { ?>
					<a href="<?php echo $section->link ?>" class="sec_a_link" ><img src="<?php echo $section->image_path ?>"  class="sec_con_img" /></a>
					<div class="sec_con_click">
						<!-- 视频播放装置 start-->
						<a href="<?php echo $section->link ?>" class="sec_a_link" ><img src="/pages/images/DEY.png"></a>
						<!-- end -->
					</div>
					<div class="sec_con_title">
						<p class="sec_con_title_summ"><?php echo $activity->title ?></p>
					</div>
					<!--<p class="sec_con_content">播放<span class="cdt_font">1969</span>次|喜欢<span class="cdt_font">1246</span>次|评论<span class="cdt_font">699</span>次</p>-->
				<?php } else if($section->type == 4) { ?>
					<h3 class="sec_title"><?php echo $section->detail; ?></h3>
				<?php } ?>
			<?php } ?> 
                       </p>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</section>
<section>
    <div class="talkinfo_bar">
        <span class="putup" id="click"></span>
    </div>
    <div class="talkinfo">
        <p><?php foreach($video->content as $section){ ?>
				<?php if($section->type == 0) { //段落类型  0：文字 1：图片 2：链接 3：视频 4：标题 ?>
				<p class="sec_con_content"><?php echo str_replace("\n", "<br/>", $section->detail); ?></p>
				<?php } else if($section->type == 1) { ?>
					<div class="sec_con_img_img">
						<a href="<?php echo $section->link; ?>" ><img src="<?php echo $section->image_path ?>"  class="sec_con_img" /></a>
					</div>
				<?php } else if($section->type == 2) { ?>
					<a class="sec_a_link" href="<?php echo $section->link; ?>"><?php echo $section->detail; ?></a>
				<?php } else if($section->type == 3) { ?>
					<a href="<?php echo $section->link ?>" class="sec_a_link" ><img src="<?php echo $section->image_path ?>"  class="sec_con_img" /></a>
					<div class="sec_con_click">
						<!-- 视频播放装置 start-->
						<a href="<?php echo $section->link ?>" class="sec_a_link" ><img src="/pages/images/DEY.png"></a>
						<!-- end -->
					</div>
					<div class="sec_con_title">
						<p class="sec_con_title_summ"><?php echo $activity->title ?></p>
					</div>
					<!--<p class="sec_con_content">播放<span class="cdt_font">1969</span>次|喜欢<span class="cdt_font">1246</span>次|评论<span class="cdt_font">699</span>次</p>-->
				<?php } else if($section->type == 4) { ?>
					<h3 class="sec_title"><?php echo $section->detail; ?></h3>
				<?php } ?>
			<?php } ?> </p>
    </div>
</section>
<section>
    <div class="messagelist">
       <!-- comment list start -->
       <?php foreach ($video->comments as $comment){?>
        <div class="userinfo">
            <span class="user">
                <?php $domain = stristr($comment->user->avatar, 'http://q.qlogo.cn');
                      if($domain){ ?>
                <img src="<?php echo $domain?>" alt="img"/>

                <?php }else {?>
                <img src="http://www.yueduke.com<?php echo $comment->user->avatar; ?>" alt="img"/>
                <?php } ?>
                <div class="infocase">
                    <h4><div class="username"><?php echo $comment->user->name; ?></div></h4>
                </div>
            </span>
            <span class="time"><?php echo $comment->subtime?></span>
        </div>
        <div class="messagetext">
            <p><?php echo $comment->detail; ?></p>
        </div>
        <?php } ?>
        <!-- comment list end -->
        
        <!-- write comment start -->
        <div class="textinput">
            <span class="textcase">
                <textarea cols="" rows="" id="txtVal" placeholder="我来说两句"></textarea>
            </span>
            <span class="textbutton">
               <input type="submit" value="  " id="sub_com"/>
            </span>
        </div>
        <!-- write comment end -->
        
    </div>
</section>
<!-- apply and appoint start -->
<!--
<section>
    <div class="layer_action">
         <a href="javascript:void(0);"><img src="/m/pages/images/button01.png" alt="button"/></a>
         <a href="javascript:void(0);"><img src="/m/pages/images/button02.png" alt="button" class="lay_img" /></a>
    </div>
</section>
 -->
<!-- capply and appoint end -->
<nav>
     <div class="layer_nav"><a href="javascript:void(0);">思想</a> | <a href="javascript:void(0);">新知</a> | <a href="javascript:void(0);">价值</a> | <a href="javascript:void(0);">乐趣</a></div>
</nav>

<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
<script type="text/javascript" src="/m/pages/js/layer.js"></script>
<script type="text/javascript">
  // 填写评论
  $("#sub_com").click(function() {
    if(!check()) {
	  return ;
	}
    var user_id = "";
    <?php if(!empty($_SESSION['current_user'])) { ?>
    <?php $userinfo = unserialize($_SESSION['current_user']); ?>
    user_id = '<?php echo $userinfo->uuid; ?>';	
    <?php } ?>

	var video_id = <?php echo $video->id; ?>;
	var txtVal = $("#txtVal").val();
	var params = { "user_id": user_id, "video_id": video_id, "detail": txtVal };
	var json_data = $.toJSON(params);
	$.ajax({
	    url:"/m/api/user.php?mod=video_comment",
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
  });

  function check() {
    var txtVal = $("#txtVal").val();
    if(txtVal == "") {
      alert("请填写评论内容！");
      return false;
    }
    
    <?php if(empty($_SESSION['current_user'])) { ?>
    layer.open({
      content : '请您登陆！' ,
      btn:['确定', '取消'],
      shadeClose:false,
      yes: function(){
        var url = '<?php echo 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; ?>';
        window.location.href="/m/user.php?mod=signin&url="+url;
        return false;
      },
      no:function() {
        return false;
      }
    });  
    <?php } else { ?>
    return true;
    <?php } ?>
  }
</script>

<script style="javascript"> 
/**
 * 自适应高度
 */
function SetWinHeight(obj) 
{ 
    var win=obj; 
    if (document.getElementById) { 
      if (win && !window.opera) { 
        if (win.contentDocument && win.contentDocument.body.offsetHeight){ 
          win.height = win.contentDocument.body.offsetHeight; 
        }else if(win.Document && win.Document.body.scrollHeight){
          win.height = win.Document.body.scrollHeight;
        }               
      } 
    } 
} 
</script>
<!--
<script type="text/javascript">
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',
    timestamp: <?php echo $signPackage["timestamp"];?>,
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    signature: '<?php echo $signPackage["signature"];?>',

    jsApiList: [ 'onMenuShareTimeline', 'onMenuShareAppMessage']
  });

  wx.ready(function () {
    wx.onMenuShareAppMessage({
      title: '<?php echo $video->title; ?>',
      desc: '22222222',
      link: "http://www.yikeyanjiang.com/m/video/detail.php?id=<?php echo $video->id;?>",
      imgUrl: 'http://www.yikeyanjiang.com/<?php echo $video->thumbnail; ?>',
      type: 'link',
      dataUrl: '',
      success: function () {
        // 用户确认分享后执行的回调函数
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
      }
    });

    wx.onMenuShareTimeline({
      title: '<?php echo $video->title; ?>',
      desc: '22222222222',
      link: "http://www.yikeyanjiang.com/m/video/detail.php?id=<?php echo $video->id;?>",
      imgUrl: 'http://www.yikeyanjiang.com/<?php echo $video->thumbnail; ?>',
      type: 'link',
      dataUrl: '',
      success: function () {
        // 用户确认分享后执行的回调函数
      },
      cancel: function () {// 用户取消分享后执行的回调函数
      }
    });
      
  });

  $("#share").click(function() {
    wx.onMenuShareAppMessage({
      title: '<?php echo $video->title; ?>',
      desc: '<?php foreach($video->section as $section){if($section->type == 0){$section->detail;}}?>',
      link: "http://www.yikeyanjiang.com/m/video/detail.php?id=<?php echo $video->id;?>",
      imgUrl: 'http://www.yikeyanjiang.com/<?php echo $video->thumbnail; ?>',
      type: 'link',
      dataUrl: '',
      success: function () {
        // 用户确认分享后执行的回调函数
      },
      cancel: function () {
        // 用户取消分享后执行的回调函数
      }
    });
  });
</script> -->
</body>
</html>
