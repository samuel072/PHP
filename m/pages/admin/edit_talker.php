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

  <!-- 添加一个活动基本信息 -->
  <div class="activity">
    <form method="post" enctype="multipart/form-data">
      <ul>

        <li>
          <label class="field_comment">人物名称(选填)：</label>
          <label class="field_value">
				<input id="input_name" type="text" name="name" class="txt_in" value="<?php echo $talker->name; ?>" />
          </label>
        </li>

        <li class="image">
          <label class="field_value">
			<img id="img_image" src="<?php echo $talker->image; ?>" width="160" height="80" />
          </label>
        </li>

        <li>
          <label class="field_comment">人物头像(640*360)：</label>
          <label class="field_value">
			<input id="file_image" type="file" name="file" class="txt_in" onchange="upload_image('file_image', '#img_image')"/>
          </label>
        </li>
				
        <li>
          <label class="field_comment">点击数(必填)：</label>
          <label class="field_value">
            <input id="input_points" type="text" name="points" class="txt_in" value="<?php echo $talker->points; ?>"/>
          </label>
        </li>

      </ul>

      <input id="input_submit" type="button" value="保存" class="btn" onclick="save_talker();">
    </form>
  </div>


  <script src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script src="/m/pages/js/jquery.json.js"></script>
  <script src="/m/pages/js/jquery-ui.js"></script>
  <script src="/m/pages/js/ajaxfileupload.js"></script>

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
    function save_talker() {
      var json_array = { <?php if($talker->id) { echo "id : " . $talker->id . ","; } ?>
                         "name" : $("#input_name").val(),
                         "image": $("#img_image").attr("src"),
                         "points": $("#input_points").val()
                       };
      var json_data = $.toJSON(json_array);

      $.ajax({
        url:"/m/api/user.php?mod=save_talker",
        type:'post',
        data:json_data,
        dataType:'json',
        contentType:'application/json',
        success:function(data) {
          window.location.href = "/m/admin.php?mod=talker&next_id=0&count=10";
        },
        error:function(xhr, msg, obj) {
          alert(msg);
        }
      });
    }
  </script>
</body>
</html>
