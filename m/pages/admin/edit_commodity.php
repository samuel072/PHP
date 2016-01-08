<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title><?php echo $page_title; ?></title>

  <link rel="stylesheet" href="/m/pages/css/admin_activity.css"/>
  <link rel="stylesheet" href="/m/pages/css/jquery-ui.css">
</head>

<body>

  <div class="activity">
    <form method="post" enctype="multipart/form-data">
      <ul>

       <li>
          <label class="field_comment">礼品名称(必填)：</label>
          <label class="field_value">
            <input id="txt_name" type="text" name="name" class="txt_in" value="<?php echo $commodity->name; ?>"/>
          </label>
        </li> 

       <li class="image">
          <label class="field_value">
            <img id="img_good" src="<?php echo $commodity->image_path; ?>" width="80"/>
          </label>
        </li>

        <li>
          <label class="field_comment">礼品图片(必填)：</label>
          <label class="field_value">
            <input id="file_good" type="file" name="file" class="txt_in" onchange="upload_image('file_good', '#img_good')"/>
          </label>
        </li>
				
        <li class="intro_li">
          <label class="field_comment">链接(选填)：</label>
          <label class="field_value">
            <input id="txt_link" type="text" name="link" class="txt_in" value="<?php echo $commodity->link; ?>"/>
          </label>
        </li>

        <li>
          <label class="field_comment">兑换码(选填)：</label>
          <label class="field_value">
            <input id="txt_code" type="text" name="code" class="txt_in" value="<?php echo $commodity->code; ?>" />
          </label>
        </li>
				
        <li class="act_txt_area">
          <label class="field_comment">礼品的兑换积分(必填)：</label>
          <label class="field_value">
            <input id="txt_price" type="text" name="price" class="txt_in" value="<?php echo $commodity->price; ?>" />
          </label>
        </li>

        <li>
          <label class="field_comment">使用地区范围(必填)：</label>
          <label class="field_value">
            <input id="txt_city" type="text" name="city"  value="<?php echo $commodity->city;?>" />
          </label>
        </li>
		
	    <li>
          <label class="field_comment">有效期限(必填)：</label>
          <label class="field_value">
            <input id="txt_duration" type="text" name="txt_duration" class="txt_in" value="<?php echo $commodity->duration; ?>"/>
          </label>
        </li>
		
        <li>
          <label class="field_comment">获取的方式(必填)：</label>
          <label class="field_value">
            <input id="txt_method" type="text" name="method" class="txt_in" value="<?php echo $commodity->method; ?>"/>
          </label>
        </li>
				
        <li>
          <label class="field_comment">活动说明：</label>
          <label class="field_value">
            <input id="txt_act_desc" type="text" name="txt_act_desc" class="txt_in" value="<?php echo $commodity->act_desc; ?>"/>
          </label>
        </li>
				
        <li>
          <label class="field_comment">礼品介绍(必填)：</label>
          <label class="field_value">
            <input id="txt_summary" type="text" name="summary" class="txt_in" value="<?php echo $commodity->summary; ?>"/>
          </label>
        </li>
				
        <li>
          <label class="field_comment">礼品图片的alt(SEO)：</label>
          <label class="field_value">
            <input id="txt_seo_alt" type="text" name="seo_alt" class="txt_in" value="<?php echo $commodity->seo_alt; ?>"/>
          </label>
        </li>
				
        <li>
          <label class="field_comment">礼品的数量</label>
          <label class="field_value">
            <input id="txt_count" type="text" name="count" class="txt_in" value="<?php echo $commodity->count; ?>" />
          </label>
		</li>

		<li>
          <label class="field_comment">预览路径：</label>
          <label class="field_value">
            <input readonly=readonly type="text" class="txt_in" value="/m/commodity/detail.php?id=<?php echo $commodity->id; ?>" />
          </label>
        </li>
      </ul>

      <input id="input_submit" type="button" value="保存" class="btn" onclick="save_commodity();">
   </form>
  </div>

  <script src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script src="/m/pages/js/jquery.json.js"></script>
  <script src="/m/pages/js/jquery-ui.js"></script>
  <script src="/m/pages/js/ajaxfileupload.js"></script>
  <script src="/m/pages/js/layer.js"></script>

  <script>
		//	展示日期控件
	//	$(function() {
	//		$( "#startTime" ).datepicker();
	//		$( "#endTime" ).datepicker();
	//		$( "#startTime" ).datepicker( "option", "dateFormat", "yy-mm-dd HH:mm:ss" );
	//	});
  </script>

  <script type="text/javascript">
    function upload_image(file, img_tag) {
      $.ajaxFileUpload({
        url:'/m/api/misc.php?mod=upload_image',
        secureuri:false,
        fileElementId:file,
        dataType:'json',
        success:function(data) {
          if(data.status == 0) {
			$(img_tag).attr("src", data.path);
          } else {
            alert(data.message);
          }
        },
        error: function(data) {
            alert("error");
        }
      });

      return false; 
    }
  </script>

  <script type="text/javascript">

    function save_commodity() {
	
      var json_array = { <?php if($commodity->id) { echo "id : " . $commodity->id . ","; } ?>
                         "name" : $("#txt_name").val(),
                         "image_path": $("#img_good").attr("src"),
                         "link" : $("#txt_link").val(),
                         "code": $("#txt_code").val(),
                         "price": $("#txt_price").val(),
                         "city": $("#txt_city").val(),
                         "duration": $("#txt_duration").val(),
                         "method": $("#txt_method").val(),
                         "act_desc": $("#txt_act_desc").val(),
                         "seo_alt": $("#txt_seo_alt").val(),
                         "summary": $("#txt_summary").val(),
                         "count": $("#txt_count").val()
                       };
      var json_data = $.toJSON(json_array);
      
	  $.ajax({
        url:"/m/api/save_commodity.php",
        type:'post',
        data:json_data,
        dataType:'json',
        contentType:'application/json',
        success:function(data) {
          window.location.href = "/m/admin.php?mod=commodity&next_id=0&count=10";
        },
        error:function(xhr, msg, obj) {
          alert(msg);
        }
      });
	}

  </script>
</body>
</html>
