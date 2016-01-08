<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>积分商城</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
		<link rel="stylesheet" href="/m/pages/css/commons.css"/>
		<link rel="stylesheet" href="/m/pages/css/header.css" />
		<link rel="stylesheet" href="/m/pages/css/user.css" />
	</head>
	<body>
		<?php include(ykfile('pages/header_detail.php')); ?>
		<div class="commoditiy_body_div">
			<p class="head_p">
				<a href="/m/user.php?mod=score_rules">如何赚取积分</a>
			</p>
			
			<div class="body_div">
				<?php 
					foreach($comm_list as $commodity) {?>
						<dl class="comm_desc">
							<dt><a href="/m/commodity/detail.php?id=<?php echo $commodity->id ?>"><img src="<?php echo $commodity->image_path ?>" class="comm_img" width="64" height="64"/></a></dt>
							<dd><?php echo $commodity->name ?></dd>
							<dd><img src="/m/pages/images/jinbi.png" width="18"/><span><?php echo $commodity->price ?></span></dd>
						</dl>
				<?php
					}
				?>
				
				
			</div>
		</div>
	<?php include(ykfile("pages/footer.php"));?>
	</body>
</html>
