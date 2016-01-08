<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title><?php echo $page_title; ?></title>

  <link rel="stylesheet" href="/m/pages/css/admin_score.css"/>
</head>

<body>

  <div class="rule">
    <form method="post" enctype="multipart/form-data">
      <ul>
        <li>
          <label class="field_comment">ID：</label>
          <label class="field_value">
            <input id="input_rule_id" readonly="true" type="text" class="txt_in" value="<?php echo $rule->id; ?>"/>
          </label>
        </li>

        <li>
          <label class="field_comment">名称(必填)：</label>
          <label class="field_value">
            <input id="input_rule_title" type="text" class="txt_in" value="<?php echo $rule->title; ?>"/>
          </label>
        </li>

        <li class="act_txt_area">
          <label class="field_comment">描述(必填,最多200字)：</label>
          <label class="field_value">
            <textarea id="input_rule_detail" name="detail" maxlength="200" ><?php echo $rule->detail; ?></textarea>
          </label>
        </li>

        <li>
          <label class="field_comment">每日上限(必填)：</label>
          <label class="field_value">
            <input id="input_rule_day" type="text" class="txt_in" value="<?php echo $rule->times_in_day; ?>" />
          </label>
        </li>

        <li>
          <label class="field_comment">小时上限(必填)：</label>
          <label class="field_value">
            <input id="input_rule_hour" type="text" class="txt_in" value="<?php echo $rule->times_in_hour; ?>" />
          </label>
        </li>

        <li>
          <label class="field_comment">起始时间(必填)：</label>
          <label class="field_value">
            <input id="input_rule_start" type="text" class="txt_in" value="<?php echo $rule->start_time; ?>" />
          </label>
        </li>

        <li>
          <label class="field_comment">结束时间(必填)：</label>
          <label class="field_value">
            <input id="input_rule_end" type="text" class="txt_in" value="<?php echo $rule->end_time; ?>" />
          </label>
        </li>

        <li>
          <label class="field_comment">积分(必填)：</label>
          <label class="field_value">
            <input id="input_rule_amount" type="text" class="txt_in" value="<?php echo $rule->amount; ?>" />
          </label>
        </li>

        <li>
          <label class="field_comment">积分点(必选)：</label>
          <select class="field_comment" id="input_rule_point">
            <?php foreach($points as $point) { ?>
            <?php if($point->id == $rule->point->id) { ?>
            <option data-id=<?php echo $point->id; ?> selected='selected'><?php echo $point->title; ?></optoin>
            <?php } else { ?>
            <option data-id=<?php echo $point->id; ?>><?php echo $point->title; ?></optoin>
            <?php } ?>
            <?php } ?>
          </select>
        </li>

      </ul>

      <input id="input_submit" type="button" value="保存" class="btn" onclick="save_rule();">
    </form>
  </div>

  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
  <script type="text/javascript" src="/m/pages/js/ajaxfileupload.js"></script>
  <script type="text/javascript" src="/m/pages/js/admin.js"></script>
  <script type="text/javascript">
    function save_rule() {
      var json_array = { <?php if($rule->id) { echo "id : " . $rule->id . ","; } ?>
                         "title" : $("#input_rule_title").val(),
                         "detail": $("#input_rule_detail").val(),
                         "times_in_day": $("#input_rule_day").val(),
                         "times_in_hour": $("#input_rule_hour").val(),
                         "amount": $("#input_rule_amount").val(),
                         "start_time": $("#input_rule_start").val(),
                         "end_time": $("#input_rule_end").val(),
                         "point": {
                           "id": $("#input_rule_point").find("option:selected").data("id"),
                           "title": $("#input_rule_point").val()
                         }
                       };
      var json_data = $.toJSON(json_array);

      $.ajax({
        url:"/m/api/user.php?mod=save_rule",
        type:'post',
        data:json_data,
        dataType:'json',
        contentType:'application/json',
        success:function(data) {
          if(status != 0) {
            alert(data.message);
            return ;
          }
          window.location.reload();
        },
        error:function(xhr, msg, obj) {
          alert(msg);
        }
      });
    }
  </script>

</body>
</html>
