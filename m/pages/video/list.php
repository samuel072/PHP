<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />
<title>一刻演讲-<?php echo $page_title; ?></title>
<link href="/m/pages/css/style_comm.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="/m/pages/css/style_540.css" />
<link href="/m/pages/css/idangerous.swiper.css" rel="stylesheet" type="text/css"/>
<script src="/m/pages/js/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="/m/pages/js/idangerous.swiper.min.js"></script>
<script src="/m/pages/js/jq_aux.js" type="text/javascript"></script>
</head>
<body>
<header class="h_header">
    <div class="head">
        <h4><?php echo $page_title; ?></h4>
        <div class="layer_return"><a href="javascript:history.go(-1);"></a></div>
    </div>
</header>
<section> 
     <ul>
     <?php foreach ($video_list as $video){ ?>
         <li>
             <div class="imgcase">
                 <a href="/m/video/detail.php?id=<?php echo $video->id; ?>"><img src="<?php echo $video->thumbnail; ?>" alt="img"/></a>
                 <div class="layer_imgcase"><span><?php echo date("m-d H:i", strtotime($video->start_time)); ?></span></div>
             </div>
             <h3 style="overflow:hidden;"><span class="title"><?php echo $video->title; ?></span></h3>
             <div class="toolsbar">
                 <span class="onfocus"><?php echo $video->pv; ?></span>
                <!-- <span class="loveit"><?php echo $video->like_num; ?></span>-->
             </div>
         </li>
      <?php } ?>   
      </ul> 
</section>
<nav>
     <div class="layer_nav"><a href="javascript:void(0);">思想</a> | <a href="javascript:void(0);">新知</a> | <a href="javascript:void(0);">价值</a> | <a href="javascript:void(0);">乐趣</a></div>
</nav>
</body>
</html>
