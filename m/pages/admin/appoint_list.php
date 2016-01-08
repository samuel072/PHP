<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>预约列表</title>	
  <link rel="stylesheet" href="/m/pages/css/admin.css"/> 
  <link rel="stylesheet" href="/m/pages/css/admin_activity.css"/> 
  
  <link rel="stylesheet" href="/m/pages/css/admin_appoint.css"/>
  
</head>

<body>

  <!-- 活动列表 -->
  <div class="act_list">
    <ul>
      <li class="header percent5">编号</li>
	  <li class="header percent10">预约状态</li>
      <li class="header percent30">预约活动标题</li>
	  <li class="header percent10">预约人名称</li>
      <li class="header percent10">预约人电话</li>
	  <li class="header percent15">预约时间</li>
	  <li class="header percent15 right_border">操作</li>
    </ul>

    <?php foreach($appoint_list as $appoint) { ?>
    <ul>
      <li class="percent5 header"><?php echo $appoint->id; ?></li>
	  <li class="percent10 header">
		<?php if($appoint->state == 0){ ?> 待审核 <?php } ?>
		<?php if($appoint->state == 1){ ?> 通过 <?php } ?>
		<?php if($appoint->state == 2){ ?> 用户确认要来 <?php } ?>
		<?php if($appoint->state == 3){ ?> 已参加 <?php } ?>
	  </li>
      <li class="percent30 header"><?php echo $appoint->activity->title; ?></li>
			<li class="percent10 header"><?php  echo $appoint->name; ?></li>
			<li class="percent10 header"><?php echo $appoint->mobile; ?></li>
			<li class="percent15 header"><?php echo $appoint->appoint_time; ?></li>
			<li class="percent15 header right_border">
				<a href="javascript:void(0);" onclick="update_state('<?php echo $appoint->id; ?>', 1)" target="mainFrame">通过</a>
				<a href="javascript:void(0);" onclick="update_state('<?php echo $appoint->id; ?>', 2)" target="mainFrame">确认</a>
				<a href="javascript:void(0);" onclick="update_state('<?php echo $appoint->id; ?>', 3)" target="mainFrame">已参加</a>
			</li>
    </ul>
    <?php } ?>
  </div>
  <!-- 分页 -->
  <?php include(ykfile('pages/admin/pager.php')); ?>
<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	//
	function del(act_id, type, is_delete) {
		$.ajax({
			url:'/m/api/user.php?mod=remove_activity&act_id='+act_id+'&type='+type+'&is_delete='+is_delete,
			type:'get',
			dataType:'json',
			success:function(data) {
				location.reload();
			}
		});
		
	}	
	
	function update_state(appoint_id, state) {
		$.ajax({
			url:"/m/api/user.php?mod=edit_appoint&appoint_id="+appoint_id+"&state="+state,
			type:"get",
			dataType:"json",
			success:function(data) {
				if(data.status == 0) {
					alert(data.message);
					location.reload();
				}else {
					alert(data.message);
				}
				
			}
		});
			
	}
</script>

</body>
</html>

