<?php ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta content="target-densitydpi=device-dpi,width=width=device-width,user-scalable=no" name="viewport initial-scale=1">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<title>一刻演讲-首页</title>
<link href="/m/pages/css/style_comm.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/m/pages/css/style_540.css" />
<!--<link rel="stylesheet" type="text/css" media="screen and (min-device-width:541px) and (max-device-width:720px)" href="style/style_720.css" />
<link rel="stylesheet" type="text/css" media="screen and (min-device-width:721px)" href="style/style_1080.css" />-->
<link href="/m/pages/css/idangerous.swiper.css" rel="stylesheet" type="text/css"/>
<script src="/m/pages/js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="/m/pages/js/idangerous.swiper.min.js"></script>
<script src="/m/pages/js/jq_aux.js" type="text/javascript"></script>
</head>
<body>
<header>
    <div class="head">
        <span></span>
    </div>
</header>
<section>
    <div class="video">
        <div class="videocase">
        	<a href="/m/video/detail.php?id=<?php echo $video_live_list[0]->id; ?>">
                <img src="<?php echo $video_live_list[0]->thumbnail;?>" alt="img"/>
              	<div class="layer_videoinfo"><?php echo $video_live_list[0]->title; ?></div>
            </a>
        </div>
    </div>    
</section>

<section>
  <h1>
	<span class="title">今日现场直击</span>
  </h1>   
     <ul class="hottoday">
<?php foreach ($video_live_list as $key=>$video_live){ if($key != 0) { ?>
         <li>
             <div class="imgcase">
                 <a href="/m/video/detail.php?id=<?php echo $video_live->id; ?>"><img src="<?php echo $video_live->thumbnail;?>" alt="img"/></a>
                 <div class="layer_imgcase"><span><?php echo date("m-d H:i", strtotime($video_live->start_time));?></span></div>
             </div>
             <h3 style="overflow:hidden;"><span class="title"><?php echo $video_live->title; ?></span></h3>
             <div class="toolsbar">
                 <span class="onfocus"><?php echo $video_live->pv; ?></span>
               <!--  <span class="loveit"><?php echo $video_live->like_num;?></span>-->
             </div>
         </li>
<?php  } }	?>
     </ul>
</section>
<div class="clear"></div>
<section>
     <h2>
         <span class="title">一刻演讲局</span>
         <span class="more"><a href="/m/video/list.php?mod=mp"></a></span>
     </h2>  
     <ul>
     <?php foreach($one_talk_list as $oneTalk) { ?> 
         <li>
             <div class="imgcase">
                 <a href="/m/video/detail.php?id=<?php echo $oneTalk->id; ?>"><img src="<?php echo $oneTalk->thumbnail; ?>" alt="img"/></a>
                 <div class="layer_imgcase"><span><?php echo date("m-d H:i", strtotime($oneTalk->start_time));?></span></div>
             </div>
             <h3 style="overflow:hidden;"><span class="title"><?php echo $oneTalk->title;?></span></h3>
             <div class="toolsbar">
                 <span class="onfocus"><?php echo $oneTalk->pv;?></span>
               <!--  <span class="loveit"><?php echo $oneTalk->like_num; ?></span> -->
             </div>
         </li>
     <?php }?>
     </ul> 
</section>
<div class="clear"></div>
<section>
     <h2>
         <span class="carvet">创业路演汇</span>
         <span class="more"><a href="/m/video/list.php?mod=ca"></a></span>
     </h2>  
     <ul>
     <?php foreach($carve_out_list as $carveOut) { ?> 
         <li>
             <div class="imgcase">
                 <a href="/m/video/detail.php?id=<?php echo $carveOut->id; ?>"><img src="<?php echo $carveOut->thumbnail; ?>" alt="img"/></a>
                 <div class="layer_imgcase"><span><?php echo date("m-d H:i", strtotime($carveOut->start_time));?></span></div>
             </div>
             <h3 style="overflow:hidden;><span class="title"><?php echo $carveOut->title;?></span></h3>
             <div class="toolsbar">
                 <span class="onfocus"><?php echo $carveOut->pv;?></span>
               <!--  <span class="loveit"><?php echo $carveOut->like_num; ?></span>  -->
             </div>
         </li>
     <?php }?>
     </ul> 
</section>
<nav>
     <div class="layer_nav"><a href="#">思想</a> | <a href="#">新知</a> | <a href="#">价值</a> | <a href="#">乐趣</a></div>
</nav>
</body>
</html>
