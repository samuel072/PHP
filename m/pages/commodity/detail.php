<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>商品详情</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="/m/pages/css/commons.css"/>
		<link rel="stylesheet" href="/m/pages/css/header.css" />
		<link rel="stylesheet" href="/m/pages/css/user.css" />
		<link rel="stylesheet" href="/m/pages/css/commodity.css" />
		<style type="text/css">
			.ex_user_info {width:90%;height:90%; font-size:16px; color:#666; margin:15% auto;}
			.ex_user_info ul li {list-style:none;  font-size:16px; color:#666;}
			.ex_user_info ul li span {display:block; font-size:16px; margin: 10px auto; text-align: center;}
			.ex_user_info ul li span input {font-size:16px; padding-left:1%; width:60%; height:100%;}
			.ex_user_info ul li	span .read_only 
			{
				-moz-user-select:none; 
				-webkit-user-select:none; 
				-ms-user-select:none; 
				-khtml-user-select:none; 
				user-select:none; 
				background-color:#e9e9e9; 
				border: none;
			}
			
			.ex_user_info ul li span a 
			{
				text-align: center; 
				display: block; 
				height: 50px; 
				background-color: #3CD4E9; 
				width: 90%; 
				line-height: 50px; 
				margin: 50px auto; 
				border-radius: 6px;
				color: #FFF;
				font-size: 16px;
				letter-spacing: 8px;
			}
			.layermcont ul li {width:100%;height:30px;font-size:14px;}
			.layermcont ul li input {width:100px;height:20px;font-size:14px;}
		</style>
	</head>
	<body>
        <?php include(ykfile("pages/header_detail.php")); ?>
		
		<div class="detail_body_div">
			<img src="<?php echo $commodity->image_path; ?>" width="100%"/>
			<div class="detail_title_commodity">
				<p class="detail_title_summary_commodity">
					<span class="title"><?php echo $commodity->name; ?></span>
					<span class="money"><img src="/m/pages/images/money_white.png" width="20"/><span><?php echo $commodity->price ?></span></span>
				</p>
			</div>
			<input type="text"> 商品兑换</input>
			<div class="summary_div">
				<p><span class="type">商品简介:</span><span class="summary"><?php echo $commodity->name ?></span></p>
				<p><span class="type">适用范围:</span><span class="summary"><?php echo $commodity->city ?></span></p>
				<p><span class="type">使用时间:</span><span class="summary"><?php echo $commodity->duration ?></span></p>
				<p class="summary_p"><span class="type">兑换流程:</span><span class="summary"><?php echo $commodity->method; ?></span></p>
				<p><span class="type">活动说明:</span><span class="summary"><?php echo $commodity->act_desc; ?></span></p>
			</div>
			<a href="javascript:void(0);" class="exchange" >立即兑换</a>
			
		</div>
		<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js" ></script>
		<script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
		<script type="text/javascript" src="/m/pages/js/layer.js" ></script>
		<script type="text/javascript">
			$(".exchange").click(function() {
				layer.open({
					type: 1, 
					shade: 0.6, 
					style:"width:90%; height:90%;font-size:14px;color:#666;background-color: #FFF; border-radius:5px;",
					content:"<div class='ex_user_info'><ul>"+
							"<li><span>您的电话：<input type='tel' placeholder='手机号/邮箱' /></span></li>"+
							"<li><span>送货地址：<input type='address' placeholder='送货地址' /></span></li>"+
							"<li><span>物品名称：<input class='read_only' type='name'readonly=readonly placeholder='物品名称' value='<?php echo $commodity->name; ?>'/></span></li>"+
							"<li><span><a href='javascript:void(0);' onclick='ex_user_submit();' class='exchange'>确认</a></span></li>"+
							"</ul></div>"
				}); 
				window.ontouchmove=function(e){
					e.preventDefault && e.preventDefault();
					e.returnValue=false;
					e.stopPropagation && e.stopPropagation();
					return false;
				}   
			});
			
			var ex_user_submit = function() {
				var tel = $("input[type='tel']").val();
				var address = $("input[type='address']").val();
				
				var json_array = {"com_id": <?php echo $commodity->id; ?>, "mobile":tel, "address": address, "name": '<?php echo $commodity->name; ?>'}
				var json_data = $.toJSON(json_array);
				
				$.ajax({
					url:"/m/api/user.php?mod=exchange",
					type:"post",
					data:json_data,
					dataType:"json",
					contentType:"application/json",
					success:function(data) {
						if(data.status == 0) {
							layer.open({
								content: '亲，兑换成功！',
								className: 'layer_tips_back',
								time: 2
							});
							setTimeout("window.location.href='/m/commodity.php'", 2000);
							
						}else if(data.status == 100){
							layer.open({
								content: data.message ,
								className:'layer_tips_back',
								time: 2
							});
						}else {
							layer.open({
								content: data.message ,
								className:'layer_tips_back',
								time: 2
							});
							
						}
					}
					
				});
			}
		</script>
	<?php include(ykfile("pages/footer.php"));?>		
	</body>
</html>
