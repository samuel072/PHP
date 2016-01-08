<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title><?php echo $page_title; ?></title>

  <link rel="stylesheet" href="/m/pages/css/admin_activity.css"/>
</head>

<body>

  <!-- 添加一个活动基本信息 -->
  <div class="activity">
    <form method="post" enctype="multipart/form-data">
      <ul>

        <li class="bigimage">
          <label class="field_value">
            <img id="input_adv_image" class="bigimage" src="<?php echo $adv->image; ?>"/>
          </label>
        </li>

        <li>
          <label class="field_comment">广告位图片：</label>
          <label class="field_value">
            <input id="adv_image" type="file" name="file" class="txt_in" onchange="upload_image('adv_image', '#input_adv_image')"/>
          </label>
        </li>

        <li>
          <label class="field_comment">标题(选填)：</label>
          <label class="field_value">
            <input id="input_adv_title" type="text" class="txt_in" value="<?php echo $adv->title; ?>"/>
          </label>
        </li>

        <li class="act_txt_area">
          <label class="field_comment">简介(选填)：</label>
          <label class="field_value">
            <textarea id="input_adv_summary" name="summary" maxlength="200" ><?php echo $adv->summary; ?></textarea>
          </label>
        </li>

        <li>
          <label class="field_comment">链接(必填)：</label>
          <label class="field_value">
            <input id="input_adv_link" type="text" class="txt_in" value="<?php echo $adv->link; ?>" placeholder="http://"/>
          </label>
        </li>
      </ul>

      <input id="input_submit" type="button" value="保存" class="btn" onclick="save_adv();">
    </form>
  </div>

  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
  <script type="text/javascript" src="/m/pages/js/ajaxfileupload.js"></script>
  <script type="text/javascript" src="/m/pages/js/admin.js"></script>
  <script type="text/javascript">
    function save_adv() {
      var json_array = { <?php if($adv->id) { echo "id : " . $adv->id . ","; } ?>
                         "type" : <?php echo $adv->type; ?>,
                         "title" : $("#input_adv_title").val(),
                         "summary": $("#input_adv_summary").val(),
                         "link" : $("#input_adv_link").val(),
                         "title": $("#input_adv_title").val(),
                         "summary": $("#input_adv_summary").val(),
                         "image": $("#input_adv_image").attr("src")
                       };
      var json_data = $.toJSON(json_array);

      $.ajax({
        url:"/m/api/user.php?mod=save_adv",
        type:'post',
        data:json_data,
        dataType:'json',
        contentType:'application/json',
        success:function(data) {
          window.location.href = "/m/admin.php?mod=adv&next_id=0&count=10";
        },
        error:function(xhr, msg, obj) {
          alert(msg);
        }
      });
    }
  </script>

</body>
</html>
