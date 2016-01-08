<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
	<title>公开课</title>
	<link rel="stylesheet" href="/m/pages/css/header.css"/>
	<link rel="stylesheet" href="/m/pages/css/mooc.css"/>
	<link rel="stylesheet" href="/m/pages/css/commons.css"/>
</head>

<body>
  <?php include(ykfile("pages/left.php")); ?>
  <div class="wrap">
    <?php include(ykfile("pages/header_category.php")); ?>

    <div class="body_div_mooc"> 
      <?php 
      foreach($mooc_list as $mooc){ 
      ?>
      <div class="bg_white_mooc">
      <div class="content_div_mooc">
        <img src="<?php echo $mooc->thumbnail; ?>" class="con_img_mooc"/>
        <!--播放按钮，如果没有视频连接地址，此图则不显示-->
        <?php
        foreach($mooc->content as $section) {
          if(!empty($section->link)){
        ?>
        <div class="player_mooc">
          <a href="<?php echo $section->link ?>"><img src="/m/pages/images/DEY.png" /></a>
        </div>
        <?php
        }
        }
        ?>
        <div class="con_title_mooc">
          <p class="con_title_summ_mooc"><?php echo $mooc->title ?></p>
        </div>
        <p class="title_mooc">课程介绍</p>
        <p class="summary_mooc"><?php echo $mooc->summary ?></p>
      </div>
		
      </div>
      <?php 
      }
      ?>
    </div>
  </div>
	
<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
<script type="text/javascript" src="/m/pages/js/common.js"></script>
<script type="text/javascript" src="/m/pages/js/layer.js"></script>
<script type="text/javascript">
	//滚动条到达底部100像素时候
	$(window).scroll(function(){ 
		// 当滚动到最底部以上100像素时， 加载新内容  
		if ($(document).height() - $(window).scrollTop() - $(window).height()<100){
				loadMessage();
				var to = setTimeout("",10000);
		}
	});
	var num = 0;
	var next_id = 0;

	function loadMessage(){
		var html="";
		if(num == 0){
			next_id = next_id+10;
			num = 1;
			$.ajax({
				url:"/m/api/mooc.php?next_id="+next_id+"&count=10",
				type:"get",
				dataType:"json",
				beforeSend:function(){ // 执行之前
					layer.open({
						type: 2,
						content: "<img src='/m/pages/images/load.gif' />",
						style: 'width:80%;min-height:100px;max-height:200px;text-align:center;',
						shadeClose: false
					});
				},
				success:function(data){
					var mooc_list = data.activities;
					if(mooc_list.length != 0){
						num = 0;
						layer.closeAll();
						for(var i=0;i<mooc_list.length;i++){
							html += "<div class='bg_white_mooc'>"+
									"<div class='content_div_mooc'>"+
									"<img src='"+mooc_list[i]['thumbnail']+"' class='con_img_mooc'/>";
						if(mooc_list[i]['content'] != null){
								for(var j=0;j<mooc_list[i]['content'].length;j++){
									if(mooc_list[i]['content'][j]['link'] != null && mooc_list[i]['content'][j]['link'] != ""){
										html +=	"<div class='player_mooc'>"+
												"<a href="+mooc_list[i]['content'][j]['link']+"><img src='/m/pages/images/DEY.png' /></a>"+
												"</div>";
									}
								}
							}
			
							html +=	"<div class='con_title_mooc'>"+
									"<p class='con_title_summ_mooc'>"+mooc_list[i]['title']+"</p>"+
									"</div>"+
									"<p class='title_mooc'>课程介绍</p>"+
									"<p class='summary_mooc'>"+mooc_list[i]['summary']+"</p>"+
									"</div></div>";
						}
						$(".body_div_mooc").append(html);
					}else {
						layer.closeAll();
						layer.open({
							content: '亲，已经没有更多信息哟',
							className: 'layer_tips_back',
							shadeClose: false,
							time : 2
						});
					}
				},
				error:function(datas){
					console.log("data error");
				}
				
			});
			
		}
	}		
</script>
<?php include(ykfile("pages/footer.php"));?>
</body>
</html>
