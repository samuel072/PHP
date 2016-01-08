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
	
	<script type="text/javascript" src="/m/pages/js/jquery.js"></script>
  <script type="text/javascript" src="/m/pages/js/jquery.autocomplete.js"></script>
	
  <link rel="stylesheet" type="text/css" href="/m/pages/css/jquery.autocomplete.css" />
  
	
	<!--<script type="text/javascript">
		$().ready(function() {
      $("#input_user").autocomplete("search_user.php", {
        width: 300,
        selectFirst: false
      });

      $("#input_user").result(function(event, data, formatted) {
        if (data)
          //$(this).parent().next().find("input").val(data[1]);
			    $("#input_user").val(data[1]);
      });

    });
	</script>-->
</head>

<body>
  <!-- 添加一个视频基本信息 -->
  <div class="activity">
    <form method="post" enctype="multipart/form-data">
      <ul>
       <li>
          <label class="field_comment">视频标题(必填)：</label>
          <label class="field_value">
            <input id="input_title" type="text" name="title" class="txt_in" value="<?php echo $video_live->title; ?>" />
          </label>
       </li>
       
       <li class="bigimage">
         <label class="field_value">
           <img id="img_cover" class="bigimage" src="<?php echo $video_live->thumbnail; ?>"/>
         </label>
       </li>
       
	   <li>
         <label class="field_comment">视频封面(640*480)：</label>
           <label class="field_value">
             <input id="file_cover" type="file" name="file" class="txt_in" onchange="upload_image('file_cover', '#img_cover')"/>
           </label>
       </li>
       
       <li>
          <label class="field_comment">排序 ：</label>
          <label class="field_value">
            <input id="input_position" type="text" name="position" class="txt_in txt_w" value="<?php echo $video_live->position;?>" width="1
00"/>(值越大，越靠前)
          </label>
       </li>
         
       <li>
			  <label class="field_comment">标签：</label>
			  <?php foreach($tag_list as $tag) { ?>
				<label class="field_value fv_tag">
					<input id="input_tag<?php echo $tag->id;?>" type="checkbox" name="checkbox" class="txt_check_box" value="<?php echo $tag->id;?>" <?php if($video_live->id){foreach($video_live->tags as $video_live_tag){if($video_live_tag->id == $tag->id){echo "checked='checked'";}}}?> /><?php echo $tag->name; ?>	
				</label>
			<?php }?>
        </li>
        
        <li>
			<label class="field_comment">视频类型：</label>
			<label class="field_value">
				<select name="category_id" id="category_id">
					<option value="1" <?php if($video_live->category->id == 1){echo 'selected=selected';}?> >今日现场直击</option>
					<option value="2" <?php if($video_live->category->id == 2){echo 'selected=selected';}?> >一刻演讲局</option>
					<option value="3" <?php if($video_live->category->id == 3){echo 'selected=selected';}?> >创业路演汇</option>
				</select>
			</label>
        </li>
        
		<li>
          <label class="field_comment">开始时间(必填)：</label>
          <label class="field_value">
            <input id="input_start_time" type="text" name="start_time" class="txt_in" value="<?php echo $video_live->start_time; ?>"/>
          </label>
        </li>
		
        <li>
          <label class="field_comment">结束时间(选填)：</label>
          <label class="field_value">
            <input id="input_end_time" type="text" name="end_time" class="txt_in" value="<?php echo $video_live->end_time; ?>"/>
          </label>
        </li>
				
        <li>
          <label class="field_comment">活动地址(必填)：</label>
          <label class="field_value">
            <input id="input_address" type="text" name="address" class="txt_in" value="<?php echo $video_live->address; ?>"/>
          </label>
        </li>
        <li>
          <label class="field_comment">浏览数量(pv)：</label>
          <label class="field_value">
            <input id="input_pv" type="text" name="pv" class="txt_in" value="<?php echo $video_live->pv; ?>"/>
          </label>
        </li>
        <li>
          <label class="field_comment">喜欢数量：</label>
          <label class="field_value">
            <input id="input_like_num" type="text" name="like_num" class="txt_in" value="<?php echo $video_live->like_num; ?>"/>
          </label>
        </li>
        <li>
          <label class="field_comment">是否免费(必填)：</label>
          <label class="field_value">
            <select name="is_free" id="is_free">
				<option value="0" <?php if($video_live->is_free == 0){echo 'selected=selected';}?> >免费</option>
				<option value="1" <?php if($video_live->is_free == 1){echo 'selected=selected';}?> >收费</option>
			</select>
          </label>
        </li>
		
		<li>
          <label class="field_comment">视频直播的ID号：</label>
          <label class="field_value">
            <input id="input_video_id" type="text" name="video_id" class="txt_in" value="<?php echo $video_live->video_id; ?>"/>
          </label>
        </li>
				
        <li>
          <label class="field_comment">举办方(必填)：</label>
          <label class="field_value">
            <input id="input_user" type="text" name="user_uuid" class="txt_in" value="<?php echo $video_live->user->name; ?>"/>
          </label>
					<label>
					<iframe style="display:none;" width="400" height="600" src="/m/search_user.php"></iframe>
					</label>
        </li>
				
  
        
        <li>
          <label class="field_comment">预览路径：</label>
          <label class="field_value">
            <input id="input_seo_keywords" readonly=readonly type="text" name="preview" class="txt_in" value="/activity/detail.php?id=<?php echo $video_live->id; ?>"/>
          </label>
        </li>
      </ul>

      <input id="input_submit" type="button" value="保存" class="btn" onclick="save_video();">
    </form>
  </div>
<?php if($video_live->id){ ?>
  <div id="activity_content" class="content">
    <?php foreach($video_live->content as $section) { ?>

    <?php if($section->type == SectionModel::type_text) { ?>
    <div class='section section_text' id='section_<?php echo $section->id; ?>'>
      <ul>
        <li class='detail_li'>
          <label class='detail'>
            <textarea readonly=readonly><?php echo $section->detail; ?></textarea>
          </label>
        </li>
        <li>
          <label class='field_comment'>段落序号：</label>
          <label class='field_value'>
            <input type='text' name='num' readonly='readonly' class='txt_in' value='<?php echo $section->num; ?>'/>
          </label>
        </li>
      </ul>
      <div class='toolbar toolbar_little'>
        <button name='edit' class='button' onclick='edit_text_section("section_<?php echo $section->id; ?>")'>编辑</button>
        <button name='save' class='button button_hidden' onclick='save_text_section("<?php echo $section->id; ?>")'>保存</button>
        <button name='remove' class='button' onclick='remove_section(<?php echo $section->id; ?>)'>删除</button>
        <button name='cancel' class='button button_hidden' onclick='cancel_edit_section("section_<?php echo $section->id; ?>")'>取消</button>
      </div>
    </div>

    <?php } else if($section->type == SectionModel::type_title) { ?>
    <div class='section section_title' id='section_<?php echo $section->id; ?>'>
      <ul>
        <li>
          <label class='field_comment'>标题：</label>
          <label class='field_value'>
            <input type='text' name='detail' class='txt_in' value='<?php echo $section->detail; ?>'/>
          </label>
        </li>
        <li>
          <label class='field_comment'>段落序号：</label>
          <label class='field_value'>
            <input type='text' name='num' readonly=readonly class='txt_in' value='<?php echo $section->num; ?>'/>
          </label>
        </li>
      </ul>
      <div class='toolbar toolbar_little'>
        <button name='edit' class='button' onclick='edit_title_section("section_<?php echo $section->id; ?>")'>编辑</button>
        <button name='save' class='button button_hidden' onclick='save_title_section("<?php echo $section->id; ?>")'>保存</button>
        <button name='remove' class='button' onclick='remove_section(<?php echo $section->id; ?>)'>删除</button>
        <button name='cancel' class='button button_hidden' onclick='cancel_edit_section("section_<?php echo $section->id; ?>")'>取消</button>
      </div>
    </div>

    <?php } else if($section->type == SectionModel::type_image) { ?>
    <div class="section section_image" id='section_<?php echo $section->id; ?>'>
      <ul>
        <li class="bigimage">
          <label class="field_value">
            <img id="image_<?php echo $section->id; ?>" name="image" class="bigimage" src="<?php echo $section->image_path; ?>"/>
          </label>
        </li>

        <li>
          <label class="field_comment">选择图片(640*480)：</label>
          <label class='field_value'>
            <input id='image_input_<?php echo $section->id; ?>' disabled='disabled' type='file' name='file' class='txt_in' onchange='upload_image(this.id, "#image_" + <?php echo $section->id; ?>)'/>
          </label>
        </li>

        <li>
          <label class="field_comment">图片标题：</label>
          <label class="field_value">
            <input type='text' class='txt_in' name='detail' value='<?php echo $section->detail; ?>' readonly=readonly />
          </label>
        </li>

        <li>
          <label class="field_comment">图片Alt(SEO)：</label>
          <label class="field_value">
            <input type="text" class="txt_in" name='seo_alt' value="<?php echo $section->seo_alt; ?>" readonly=readonly />
          </label>
        </li>

        <li>
          <label class='field_comment'>段落序号：</label>
          <label class='field_value'>
            <input type='text' name='num' readonly=readonly class='txt_in' value='<?php echo $section->num; ?>'/>
          </label>
        </li>
      </ul>
 
      <div class='toolbar toolbar_little'>
        <button name='edit' class='button' onclick='edit_image_section("section_<?php echo $section->id; ?>")'>编辑</button>
        <button name='save' class='button button_hidden' onclick='save_image_section("<?php echo $section->id; ?>")'>保存</button>
        <button name='remove' class='button' onclick='remove_section(<?php echo $section->id; ?>)'>删除</button>
        <button name='cancel' class='button button_hidden' onclick='cancel_edit_section("section_<?php echo $section->id; ?>")'>取消</button>
      </div>
    </div>

    <?php } else if($section->type == SectionModel::type_link) { ?>
    <div class='section section_link' id='section_<?php echo $section->id; ?>'>
      <ul>
        <li>
          <label class='field_comment'>显示文字：</label>
          <label class='field_value'>
            <input id='section_detail' type='text' name='detail' class='txt_in' value='<?php echo $section->detail; ?>'/>
          </label>
        </li>
        <li>
          <label class='field_comment'>链接地址：</label>
          <label class='field_value'>
            <input id='section_link' type='text' class='txt_in' name='link' value='<?php echo $section->link; ?>'/>
          </label>
        </li>
        <li>
          <label class='field_comment'>段落序号：</label>
          <label class='field_value'>
            <input type='text' name='num' readonly=readonly class='txt_in' value='<?php echo $section->num; ?>'/>
          </label>
        </li>
      </ul>
      <div class='toolbar toolbar_little'>
        <button name='edit' class='button' onclick='edit_link_section("section_<?php echo $section->id; ?>")'>编辑</button>
        <button name='save' class='button button_hidden' onclick='save_link_section("<?php echo $section->id; ?>")'>保存</button>
        <button name='remove' class='button' onclick='remove_section(<?php echo $section->id; ?>)'>删除</button>
        <button name='cancel' class='button button_hidden' onclick='cancel_edit_section("section_<?php echo $section->id; ?>")'>取消</button>
      </div>
    </div>

    <?php } else if($section->type == SectionModel::type_video) { ?>
    <div class="section section_video" id='section_<?php echo $section->id; ?>'>
      <ul>
        <li class="bigimage">
          <label class="field_value">
            <img id="image_<?php echo $section->id; ?>" name="image" class="bigimage" src="<?php echo $section->image_path; ?>"/>
          </label>
        </li>

        <li>
          <label class="field_comment">选择图片：</label>
          <label class='field_value'>
            <input id='image_input_<?php echo $section->id; ?>' disabled=disabled type='file' name='file' class='txt_in' onchange='upload_image(this.id, "#image_" + <?php echo $section->id; ?>)'/>
          </label>
        </li>

        <li>
          <label class="field_comment">视频标题：</label>
          <label class="field_value">
            <input type="text" class="txt_in" name="detail" value="<?php echo $section->detail; ?>" readonly=readonly />
          </label>
        </li>

        <li>
          <label class="field_comment">视频链接：</label>
          <label class="field_value">
            <input type="text" class="txt_in" name="link" value="<?php echo $section->link; ?>" readonly=readonly />
          </label>
        </li>

        <li>
          <label class="field_comment">视频截图Alt(SEO)：</label>
          <label class="field_value">
            <input type="text" class="txt_in" name="seo_alt" value="<?php echo $section->seo_alt; ?>" readonly=readonly />
          </label>
        </li>

        <li>
          <label class='field_comment'>段落序号：</label>
          <label class='field_value'>
            <input type='text' name='num' readonly=readonly class='txt_in' value='<?php echo $section->num; ?>'/>
          </label>
        </li>
      </ul>
 
      <div class='toolbar toolbar_little'>
        <button name='edit' class='button' onclick='edit_video_section("section_<?php echo $section->id; ?>")'>编辑</button>
        <button name='save' class='button button_hidden' onclick='save_video_section("<?php echo $section->id; ?>")'>保存</button>
        <button name='remove' class='button' onclick='remove_section(<?php echo $section->id; ?>)'>删除</button>
        <button name='cancel' class='button button_hidden' onclick='cancel_edit_section("section_<?php echo $section->id; ?>")'>取消</button>
      </div>
    </div>

    <?php } ?>
    <?php } ?>

  </div>
<?php } ?>
  <div class="toolbar" id="toolbar">
    <button class="button" onclick="new_text_section()">添加文字</button>
    <button class="button" onclick="new_image_section()">添加图片</button>
    <button class="button" onclick="new_video_section()">添加视频</button>
    <button class="button" onclick="new_title_section()">添加标题</button>
    <button class="button" onclick="new_link_section()">添加链接</button>
  </div>

	<!--<script src="/m/pages/js/jquery-1.11.1.min.js"></script>-->
  <script src="/m/pages/js/jquery.json.js"></script>
  <!--<script src="/m/pages/js/jquery-ui.js"></script>-->
  <script src="/m/pages/js/ajaxfileupload.js"></script>
  <script src="/m/pages/js/layer.js"></script>
  
  <script type="text/javascript">
    function remove_new_section(sec_id) {
      $('#section_' + sec_id).remove();
      $('#toolbar').show();
    }
    function remove_section(sec_id) {
      $.ajax({
        url:"/m/api/user.php?mod=remove_section&sec_id=" + sec_id,
        type:'get',
        dataType:'json',
        success:function(data) {
          if(data.status == 0) {
            window.location.reload();
          } else {
            alert(data.message);
          }
        },
        error:function(xhr, msg, obj) {
          alert(msg);
        }
      });
    }
    function cancel_edit_section(sec_id) {
      window.location.reload();
    }
    function new_text_section() {
      html = "<div id='section_new_section' class='section section_text'>" +
               "<ul>" +
                 "<li class='detail_li'>" +
                   "<label class='detail'>" +
                     "<textarea></textarea>" +
                   "</label>" +
                 "</li>" +
                 "<li>" +
                   "<label class='field_comment'>段落序号：</label>" +
                   "<label class='field_value'>" +
                     "<input type='text' name='num' class='txt_in' value='<?php echo count($video_live->content); ?>'/>" +
                   "</label>" +
                 "</li>" +
               "</ul>" +
               "<div class='toolbar toolbar_little'>" +
                 "<button id='btn_save' class='button' onclick='save_text_section(\"new_section\")'>保存</button>" +
                 "<button id='btn_cancel' class='button' onclick='remove_new_section(\"new_section\")'>取消</button>" +
               "</div>" +
             "</div>";
     $("#activity_content").append(html);
     $("#toolbar").hide();
    }
    function new_title_section() {
      html = "<div id='section_new_section' class='section section_title'>" +
               "<ul>" +
                 "<li>" +
                   "<label class='field_comment'>标题：</label>" +
                   "<label class='field_value'>" +
                     "<input type='text' name='detail' class='txt_in'/>" +
                   "</label>" +
                 "</li>" +
                 "<li>" +
                   "<label class='field_comment'>段落序号：</label>" +
                   "<label class='field_value'>" +
                     "<input type='text' name='num' class='txt_in' value='<?php echo count($video_live->content); ?>'/>" +
                   "</label>" +
                 "</li>" +
                "</ul>" +
                "<div class='toolbar toolbar_little'>" +
                  "<button class='button' onclick='save_title_section(\"new_section\")'>保存</button>" +
                  "<button class='button' onclick='remove_new_section(\"new_section\")'>取消</button>" +
                "</div>" +
             "</div>";
      $("#activity_content").append(html);
      $("#toolbar").hide();
    }
    function new_link_section() {
      html = "<div id='section_new_section' class='section section_link'>" +
               "<ul>" +
                 "<li>" +
                   "<label class='field_comment'>显示文字：</label>" +
                   "<label class='field_value'>" +
                     "<input name='detail' type='text' class='txt_in'/>" +
                   "</label>" +
                 "</li>" +
                 "<li>" +
                   "<label class='field_comment'>链接地址：</label>" +
                   "<label class='field_value'>" +
                     "<input name='link' type='text' class='txt_in' placeholder='http://'/>" +
                   "</label>" +
                 "</li>" +
                 "<li>" +
                   "<label class='field_comment'>段落序号：</label>" +
                   "<label class='field_value'>" +
                     "<input type='text' name='num' class='txt_in' value='<?php echo count($video_live->content); ?>'/>" +
                   "</label>" +
                 "</li>" +
               "</ul>" +
               "<div class='toolbar toolbar_little'>" +
                 "<button class='button' onclick='save_link_section(\"new_section\")'>保存</button>" +
                 "<button class='button' onclick='remove_new_section(\"new_section\")'>取消</button>" +
               "</div>" +
             "</div>";
      $("#activity_content").append(html);
      $("#toolbar").hide();
    }
    function new_image_section() {
      html = "<div class='section section_image' id='section_new_section'>" +
             "<ul>" +
               "<li class='bigimage'>" +
                 "<label class='field_value'>" +
                   "<img id='new_image' name='image' class='bigimage'/>" +
                 "</label>" +
               "</li>" +

               "<li>" +
                 "<label class='field_comment'>图片标题：</label>" +
                 "<label class='field_value'>" +
                   "<input name='detail' type='text' class='txt_in'/>" +
                 "</label>" +
               "</li>" +

               "<li>" +
                 "<label class='field_comment'>图片Alt(SEO)：</label>" +
                 "<label class='field_value'>" +
                   "<input name='seo_alt' type='text' class='txt_in'/>" +
                 "</label>" +
               "</li>" +

               "<li>" +
                 "<label class='field_comment'>选择图片：</label>" +
                 "<label class='field_value'>" +
                   "<input id='new_image_input' type='file' name='file' class='txt_in' onchange=\"upload_image(this.id, \'#new_image\')\"/>" + 
                 "</label>" +
               "</li>" +

               "<li>" +
                 "<label class='field_comment'>段落序号：</label>" +
                 "<label class='field_value'>" +
                   "<input type='text' name='num' class='txt_in' value='<?php echo count($video_live->content); ?>'/>" +
                 "</label>" +
               "</li>" +
             "</ul>" + 

             "<div class='toolbar toolbar_little'>" +
               "<button class='button' onclick='save_image_section(\"new_section\")'>保存</button>" +
               "<button class='button' onclick='remove_new_section(\"new_section\")'>取消</button>" +
             "</div>" +
             "</div>";

      $("#activity_content").append(html);
      $("#toolbar").hide();
    }
    function new_video_section() {
      html = "<div class='section section_video' id='section_new_section'>" +
             "<ul>" +
               "<li class='bigimage'>" +
                 "<label class='field_value'>" +
                   "<img id='new_video_img' name='image' class='bigimage'/>" +
                 "</label>" +
               "</li>" +

               "<li>" +
                 "<label class='field_comment'>视频标题：</label>" +
                 "<label class='field_value'>" +
                   "<input name='detail' type='text' class='txt_in'/>" +
                 "</label>" +
               "</li>" +

               "<li>" +
                 "<label class='field_comment'>视频链接：</label>" +
                 "<label class='field_value'>" +
                   "<input name='link' type='text' class='txt_in' placeholder='http://'/>" +
                 "</label>" +
               "</li>" +

               "<li>" +
                 "<label class='field_comment'>视频截图Alt(SEO)：</label>" +
                 "<label class='field_value'>" +
                   "<input name='seo_alt' type='text' class='txt_in'/>" +
                 "</label>" +
               "</li>" +

               "<li>" +
                 "<label class='field_comment'>选择图片：</label>" +
                 "<label class='field_value'>" +
                   "<input id='new_video_input' type='file' name='file' class='txt_in' onchange=\"upload_image(this.id, \'#new_video_img\')\"/>" + 
                 "</label>" +
               "</li>" +

               "<li>" +
                 "<label class='field_comment'>段落序号：</label>" +
                 "<label class='field_value'>" +
                   "<input type='text' name='num' class='txt_in' value='<?php echo count($video_live->content); ?>'/>" +
                 "</label>" +
               "</li>" +

               "<div class='toolbar toolbar_little'>" +
                 "<button class='button' onclick='save_video_section(\"new_section\")'>保存</button>" +
                 "<button class='button' onclick='remove_new_section(\"new_section\")'>取消</button>" +
               "</div>" +
             "</ul>" + 
             "</div>";

      $("#activity_content").append(html);
      $("#toolbar").hide();
    }
    function save_text_section(sec_id) {
      secid = null;
      if(sec_id !== 'new_section') {
        secid = sec_id;
      }
      var detail = $('#section_' + sec_id).find('textarea').val();
      var num = $('#section_' + sec_id).find("input[name='num']").val();
      save_section(secid, 0, detail, '', '', '<?php echo $video_live->id; ?>', '', num);
    }
    function edit_text_section(sec_id) {
      $('#' + sec_id).find("input[name='num']").removeAttr('readonly');
      $('#' + sec_id).find('textarea').removeAttr('readonly');
      $('#' + sec_id).find("button[name='edit']").hide();
      $('#' + sec_id).find("button[name='save']").show();
      $('#' + sec_id).find("button[name='cancel']").show();
    }
    function save_title_section(sec_id) {
      secid = null;
      if(sec_id !== 'new_section') {
        secid = sec_id;
      }
      var num = $('#section_' + sec_id).find("input[name='num']").val();
      var detail = $('#section_' + sec_id).find("input[name='detail']").val();
      save_section(secid, 4, detail, '', '', '<?php echo $video_live->id; ?>', '', num);
    }
    function edit_title_section(sec_id) {
      $('#' + sec_id).find("input[name='num']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='detail']").removeAttr('readonly');
      $('#' + sec_id).find("button[name='edit']").hide();
      $('#' + sec_id).find("button[name='save']").show();
      $('#' + sec_id).find("button[name='cancel']").show();
    }
    function save_link_section(sec_id) {
      secid = null;
      if(sec_id !== 'new_section') {
        secid = sec_id;
      }
      var detail = $('#section_' + sec_id).find("input[name='detail']").val();
      var link = $('#section_' + sec_id).find("input[name='link']").val();
      var num = $('#section_' + sec_id).find("input[name='num']").val();
      save_section(secid, 2, detail, '', '', '<?php echo $video_live->id; ?>', link, num);
    }
    function edit_link_section(sec_id) {
      $('#' + sec_id).find("input[name='num']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='detail']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='link']").removeAttr('readonly');
      $('#' + sec_id).find("button[name='edit']").hide();
      $('#' + sec_id).find("button[name='save']").show();
      $('#' + sec_id).find("button[name='cancel']").show();
    }
    function save_image_section(sec_id) {
      secid = null;
      if(sec_id !== 'new_section') {
        secid = sec_id;
      }
      var detail = $('#section_' + sec_id).find("input[name='detail']").val();
      var path = $('#section_' + sec_id).find("img[name='image']").attr('src');
      var alt = $('#section_' + sec_id).find("input[name='seo_alt']").val();
      var num = $('#section_' + sec_id).find("input[name='num']").val();
      save_section(secid, 1, detail, path, alt, '<?php echo $video_live->id; ?>', '', num);
    }
    function edit_image_section(sec_id) {
      $('#' + sec_id).find("input[name='num']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='detail']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='path']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='seo_alt']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='file']").removeAttr('disabled');
      $('#' + sec_id).find("button[name='edit']").hide();
      $('#' + sec_id).find("button[name='save']").show();
      $('#' + sec_id).find("button[name='cancel']").show();
    }
    function save_video_section(sec_id) {
      secid = null;
      if(sec_id !== 'new_section') {
        secid = sec_id;
      }
      var detail = $('#section_' + sec_id).find("input[name='detail']").val();
      var path = $('#section_' + sec_id).find("img").attr('src');
      var alt = $('#section_' + sec_id).find("input[name='seo_alt']").val();
      var link = $('#section_' + sec_id).find("input[name='link']").val();
      var num = $('#section_' + sec_id).find("input[name='num']").val();
      save_section(secid, 3, detail, path, alt, '<?php echo $video_live->id; ?>', link, num);
    }
    function edit_video_section(sec_id) {
      $('#' + sec_id).find("input[name='num']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='detail']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='path']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='seo_alt']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='link']").removeAttr('readonly');
      $('#' + sec_id).find("input[name='file']").removeAttr('disabled');
      $('#' + sec_id).find("button[name='edit']").hide();
      $('#' + sec_id).find("button[name='save']").show();
      $('#' + sec_id).find("button[name='cancel']").show();
    }
    function save_section(id, type, detail, image_path, seo_alt, video_id, link, num) {
      var json_array = { "type" : type,
                         "detail" : detail,
                         "image_path" : image_path,
                         "seo_alt": seo_alt,
                         "video_id" : video_id,
                         "link": link,
                         "num": num
                       };
      if(id !== "new_section") {
        json_array["id"] = id; ;
      }
      var json_data = $.toJSON(json_array);

      $.ajax({
        url:"/m/api/user.php?mod=save_section_video&type=0",
        type:'post',
        data:json_data,
        dataType:'json',
        contentType:'application/json',
        success:function(data) {
          window.location.reload();
        },
        error:function(xhr, msg, obj) {
          alert(msg);
        }
      });
    }
  </script>

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
	function check() {
      var start =  $("#input_start_time").val();
      var end = $("#input_end_time").val();
	  if(undefined == start || undefined == end || '0000-00-00 00:00:00' == start || '0000-00-00 00:00:00' == end) {
		layer.open({
		  content:'请填写日期',
		  time:2
		});
		return false;
	  }
	  return true;
	}

    function save_video() {
	  if(check()){
	 
	    var checkbox = document.getElementsByName("checkbox");
	    txt=""
	    for (i=0;i<checkbox.length;++ i){
		  if (checkbox[i].checked){
		     txt=txt + checkbox[i].value + "#";
		  }	
	    } 
	    var json_array = { <?php if($video_live->id) { echo "id : " . $video_live->id . ","; } ?>
						  "category_id" : $("#category_id").find("option:selected").val(),
					      "title": $("#input_title").val(),
					      "summary": $("#input_summary").val(),
					      "thumbnail": $("#img_cover").attr("src"),
					      "start_time": $("#input_start_time").val(),
					      "end_time": $("#input_end_time").val(),
					      "address": $("#input_address").val(),
						  "position": $("#input_position").val(),
					      "user_uuid" : '<?php echo unserialize($_SESSION['current_user'])->uuid ;?>' ,
					      "is_free" : $("#is_free").find("option:selected").val(),
					      "pv" : $("#input_pv").val(),
					      "like_num" : $("#input_like_num").val(),
					      "video_id" : $("#input_video_id").val(),
						  "tags" : txt
   					 };
      var json_data = $.toJSON(json_array);

      $.ajax({
        url:"/m/api/user.php?mod=save_video",
        type:'post',
        data:json_data,
        dataType:'json',
        contentType:'application/json',
        success:function(data) {
          window.location.href = "/m/admin.php?mod=video_live&next_id=0&count=10";
        },
        error:function(xhr, msg, obj) {
          alert(msg);
        }
      });
    }
}
  
 $("#input_user").blur(function(){
     var json_array = {"userName": $("#input_user").val()};
     var json_data = $.toJSON(json_array);
     
     $.ajax({
       url : "/m/search_user.php",
       type : "post",
       data : json_data,
       dataType : "json",
       contentType : "application/json",
			 beforeSend:function(){ // 执行之前
					layer.open({
						type: 2,
						content: "<img src='/m/pages/images/load.gif' />",
						style: 'width:80%;min-height:100px;max-height:200px;text-align:center;',
						shadeClose: false
					});
				},
       success : function(data) {
				 layer.closeAll();
         if(data.status != 0){
						layer.open({
							content : '亲，没有更多的信息哟',
							className: 'layer_tips_back',
							shadeClose: false,
							time : 2
						});
						return;
         }
       },
       error : function(xhr, msg, obj){
           alert(msg);
       }
     }); 
	     
   });
  </script>
</body>
</html>
