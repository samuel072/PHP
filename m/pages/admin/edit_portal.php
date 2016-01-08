<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title><?php echo $page_title; ?></title>

  <link rel="stylesheet" href="/m/pages/css/admin.css"/>
  <link rel="stylesheet" href="/m/pages/css/admin_portal.css"/>
</head>

<body>

  <div class="portal">
    <?php foreach($channels as $channel) { ?>

    <?php if($channel->type == ChannelModel::channel_type_adv) { ?>
    <div class="channel">
      <?php foreach($channel->content as $portal_adv) { ?>
	  <div class="portal_adv">
      
        <div class="left">
          <img id="channel_adv_image" src="<?php echo $portal_adv->image; ?>" width="320" height="180"/>
        </div>
        <div class="right">
          <p>首页广告位</p>
          <select onchange="set_image('#channel_adv_image', this.value)" id="adv_select">
            <?php foreach($advs as $adv) { ?>
            <?php if($adv->id == $portal_adv->id) { ?>
            <option data-id=<?php echo $adv->id; ?> value="<?php echo $adv->image; ?>" selected="<?php echo 'selected'; ?>"><?php echo $adv->title; ?></option>
            <?php } else { ?>
            <option data-id=<?php echo $adv->id; ?> value="<?php echo $adv->image; ?>"><?php echo $adv->title; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      <?php } ?>
      
    </div>

    <?php } else if($channel->type == ChannelModel::channel_type_talk) { ?>
    <div class="channel">
      <?php $index=0; foreach($channel->content as $portal_talk) { $index++ ;?>
      <div class="portal_talk" data-index="<?php echo $index; ?>">
        <div class="left">
          <img id="channel_talk_image_<?php echo $portal_talk->id; ?>" src="<?php echo $portal_talk->thumbnail; ?>" />
        </div>
        <div class="right">
          <p>首页演讲</p>
          <select onchange="set_image('#channel_talk_image_' + <?php echo $portal_talk->id ?>, this.value)">
            <?php foreach($talks as $talk) { ?>
            <?php if($talk->id == $portal_talk->id) { ?>
            <option data-id="<?php echo $talk->id; ?>" value="<?php echo $talk->thumbnail; ?>" selected="<?php echo 'selected'; ?>"><?php echo $talk->title; ?></option>
            <?php } else { ?>
            <option data-id="<?php echo $talk->id; ?>" value="<?php echo $talk->thumbnail; ?>"><?php echo $talk->title; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      <?php } ?>
    </div>

    <?php } else if($channel->type == ChannelModel::channel_type_activity) { ?>
    <div class="channel">
      <div class="portal_activity">
        <div class="left">
          <?php for($i = 1; $i < 7; $i++) { ?>
		  
          <div class="act act<?php echo $i; ?>">
            <img id="channel_act_image_<?php echo $i; ?>" src="<?php echo $channel->content[$i-1]->thumbnail; ?>"/>
          </div>
          <?php } ?>
        </div>
        <div class="right">
          <p>首页活动</p>
		  
		  
          <?php $index=0; for($i = 1; $i < 7; $i ++) { $index++; ?> 
          <select onchange="set_image('#channel_act_image_' + <?php echo $i; ?>, this.value)" class="activity_select" data-index="<?php echo $index; ?>">
            <?php foreach($activities as $activity) { ?>
            <?php if($activity->id == $channel->content[$i-1]->id) { ?>
            <option data-id="<?php echo $activity->id; ?>" value="<?php echo $activity->thumbnail; ?>" selected="<?php echo 'selected'; ?>"><?php echo $activity->title; ?></option>
            <?php } else { ?>
            <option data-id="<?php echo $activity->id; ?>" value="<?php echo $activity->thumbnail; ?>"><?php echo $activity->title; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
          <?php } ?>
        </div>
      </div>
    </div>

    <?php } else if($channel->type == ChannelModel::channel_type_talker) { ?>
    <div class="channel">
      <?php $index=0; foreach($channel->content as $portal_talker) { $index++; ?>
      <div class="portal_talker" data-index="<?php echo $index; ?>">
        <div class="left">
          <img id="channel_talker_image_<?php echo $index; ?>" src="<?php echo $portal_talker->image; ?>" />
        </div>
        <div class="right">
          <p>首页点他来讲</p>
          <select onchange="set_image('#channel_talker_image_' + <?php echo $index; ?>, this.value)">
            <?php foreach($talkers as $talker) { ?>
            <?php if($talker->id == $portal_talker->id) { ?>
            <option data-id="<?php echo $talker->id; ?>" value="<?php echo $talker->image; ?>" selected="<?php echo 'selected'; ?>"><?php echo $talker->name; ?></option>
            <?php } else { ?>
            <option data-id="<?php echo $talker->id; ?>" value="<?php echo $talker->image; ?>"><?php echo $talker->name; ?></option>
            <?php } ?>
            <?php } ?>
          </select>
        </div>
      </div>
      <?php } ?>
    </div>

    <?php } ?>
    <?php } ?>
	
	<input  class="buttons" type="button" value="保存" />
  </div>


  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
  <script type="text/javascript">
    function set_image(element, src) {
      $(element).attr("src", src);
    }
	
	// 保存首页的数据
	$(".buttons").click(function(){
		//获取每个模块的数据
		// adv
		var adv_id = $("#adv_select option:selected").data("id");
		
		// talk
		var talk_ids='';
		$(".portal_talk").each(function(){
			var talk_id = $(this).find("option:selected").data("id");
			var index = $(this).data("index");
			talk_ids += talk_id+"#"+index+",";
		});
		talk_ids = talk_ids.substr(0, talk_ids.length-1);
		
		// activity
		var activity_ids='';
		$(".activity_select").each(function(){
			var activity_id = $(this).find("option:selected").data("id");
			var index = $(this).data("index");
			activity_ids += activity_id+"#"+index+",";
		});
		activity_ids = activity_ids.substr(0, activity_ids.length-1);

		// talker
		var talker_ids='';
		$(".portal_talker").each(function(){
			var talker_id = $(this).find("option:selected").data("id");
			var index = $(this).data("index");
			talker_ids += talker_id+"#"+index+",";
		});
		talker_ids = talker_ids.substr(0, talker_ids.length-1);
		
		var json_array = {"adv_id":adv_id, "talk_ids":talk_ids, "talker_ids":talker_ids, "activity_ids":activity_ids };
		var json_data = $.toJSON(json_array);
		
		// 正式保存数据
		 $.ajax({
			url:"/m/api/user.php?mod=save_portal",
			type:'post',
			data:json_data,
			dataType:'json',
			contentType:'application/json',
			success:function(data) {
				alert(data.message);
			  //window.location.href = "/admin.php?mod=mooc&next_id=0&count=10";
			},
			error:function(xhr, msg, obj) {
			  alert(msg);
			}
		});
	});
  </script>

</body>
</html>
