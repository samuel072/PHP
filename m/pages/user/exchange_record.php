<?php

?>
<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>兑换记录</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="/m/pages/css/commons.css"/>
		<link rel="stylesheet" href="/m/pages/css/header.css" />
		<link rel="stylesheet" href="/m/pages/css/user.css" />
	</head>
	<body>
		<?php include(ykfile('pages/header_detail.php')); ?>
		<div class="body_div">
			<?php  
				foreach($record_list as $record) {?>
					<dl class="comm_desc">
						<dt><img src="<?php echo $record->image_path ?>" width="40%"/></dt>
						<dd><?php echo $record->name; ?></dd>
						<dd><img src="/m/pages/images/jinbi.png" width="10%"/><span><?php echo $record->price ?></span></dd>
					</dl>
			<?php
				}
			?>
		</div>
		
	<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
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
				var user_id = "";
				<?php
					if(!empty($_SESSION['current_user'])) {?>
						user_id = "<?php echo $_SESSION['current_user']->uuid; ?>";
				<?php
					}
				?>
				
				$.ajax({
					url:"/m/api/user.php?mod=exchange_record&next_id&next_id="+next_id+"&count=10&user_id="+user_id,
					type:"get",
					dataType:"json",
					beforeSend:function(){ // 执行之前
//						$("#show_load").show();	
					},
					success:function(data){
						var commodity_list = data.records;
						for(var i=0;i<commodity_list.length;i++){
							html += "<dl class='comm_desc'>"+
										"<dt><img src="+commodity_list[i]['image_path']+" width='40%'/></dt>"+
										"<dd>"+commodity_list[i]['name']+"</dd>"+
										"<dd><img src='/m/pages/images/jinbi.png' width='10%'/>"+
										"<span>"+commodity_list[i]['price']+"</span></dd>"+
									"</dl>";
						}
						$(".body_div").append(html);
						if(act_list.length != 0){
							num = 0;
						}
						
					}
					
				});
				
			}
		}		
	</script>
	<?php include(ykfile("pages/footer.php"));?>	
	</body>
</html>
