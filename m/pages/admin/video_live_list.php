<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>视频直播列表</title>

  <link rel="stylesheet" href="/m/pages/css/admin.css"/> 
  <link rel="stylesheet" href="/m/pages/css/admin_activity.css"/> 
  <style type="text/css">
  	.find{width:20%; border:0;}
  	.fa_se a{background: #fff;text-decoration: none;width: 60px;display: block;border-radius: 5px;}
  </style>
  
</head>

<body>

  <!-- 活动列表 -->
  <div class="act_list">
  	<ul>
      <li class="find header">
      	<select id="vh_type">
      		<option value="1">现场直击</option>
      		<option value="2">创业路演汇</option>
      	</select>
      </li>
      <li class="header percent10 fa_se"><a href="javascript:void(0);">查询</a></li>
    
    </ul>
    
    <ul>
      <li class="header percent10">编码</li>
      <li class="header percent40">活动标题</li>
      <li class="header percent20">活动类型</li>
      <li class="header percent20">操作</li>
    </ul>

    <?php foreach($videoList as $video) { ?>
    <ul>
      <li class="header percent10"><?php echo $video->id; ?></li>
      <li class="header percent40"><?php echo $video->title; ?></li>
      <li class="header percent20"><?php echo $video->category->name; ?></li>
      <li class="header percent20">
		<a href="/m/admin.php?mod=edit_video&id=<?php echo $video->id; ?>" target="mainFrame">编辑</a> | 
		<?php if($video->is_delete == 0){ ?>
			<a href="javascript:void(0);" onclick="del(<?php echo $video->id; ?>, 1);">删除</a>
		<?php }else { ?>
			<a href="javascript:void(0);" onclick="del(<?php echo $video->id; ?>, 0);">已删除</a>
		<?php } ?>
	  </li>
    </ul>
    <?php } ?>
  </div>
	
  <div class="buttons">
    <a href="/m/admin.php?mod=edit_video" target="mainFrame">添加</a>
  </div>

  <!-- 分页 -->
  <?php include(ykfile('pages/admin/pager.php')); ?>
<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	// 伪删除
  function del(id, is_delete) {
		alert("开发中");
		$.ajax({
			url:'/m/api/user.php?mod=remove_video&id='+'&is_delete='+is_delete,
			type:'get',
			dataType:'json',
			success:function(data) {
				if(data.status != 1){
				  location.reload();	
				}
			}
		});
		
	}	

  $(".fa_se a").click(function() {
    var vh_val = $("#vh_type").find("option:selected").val();
    var url = "/m/admin.php?mod=video_live&next_id=0&count=10&type="+vh_val;
    window.location.href= url;
  });
</script>
</body>
</html>
