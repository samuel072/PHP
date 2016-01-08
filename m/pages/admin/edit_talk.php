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
          <label class="field_comment">嘉宾姓名(选填)：</label>
          <label class="field_value">
            <input id="input_guest_name" type="text" name="guest_name" class="txt_in" value="<?php echo $talk->guest_name; ?>"/>
          </label>
        </li>

        <li class="image">
          <label class="field_value">
            <img id="img_avatar" src="<?php echo $talk->guest_avatar; ?>" width="80"/>
          </label>
        </li>

        <li>
          <label class="field_comment">嘉宾头像(160*160)：</label>
          <label class="field_value">
            <input id="file_avatar" type="file" name="file" class="txt_in" onchange="upload_image('file_avatar', '#img_avatar')"/>
          </label>
        </li>
				
        <li class="intro_li">
          <label class="field_comment">嘉宾介绍(选填)：</label>
          <label class="field_value">
            <input id="input_guest_intro" type="text" name="guest_intro" class="txt_in" value="<?php echo $talk->guest_intro; ?>"/>
			<br/><label class="fv_la_in">还可以输入<span class="guest_intro_words">0</span>/60字</label>
          </label>
		  
        </li>

        <li>
          <label class="field_comment">活动标题(必填)：</label>
          <label class="field_value">
            <input id="input_title" type="text" name="title" class="txt_in" value="<?php echo $talk->title; ?>" />
          </label>
        </li>
				
        <li class="act_txt_area">
          <label class="field_comment">基本介绍或者简介(必填)：</label>
          <label class="field_value">
            <textarea id="input_summary" name="summary" maxlength="200" ><?php echo $talk->summary; ?></textarea>
			<br/><label class="fv_la_in">还可以输入<span class="summary_words">0</span>/100字</label>
          </label>
        </li>

        <li class="bigimage">
          <label class="field_value">
            <img id="img_cover" class="bigimage" src="<?php echo $talk->thumbnail; ?>"/>
          </label>
        </li>

        <li>
          <label class="field_comment">视频封面(640*480)：</label>
          <label class="field_value">
            <input id="file_cover" type="file" name="file" class="txt_in" onchange="upload_image('file_cover', '#img_cover')"/>
          </label>
        </li>

        <li>
          <label class="field_comment">作者：</label>
          <label class="field_value">
            <input id="input_author" type="text" readonly="readonly" name="author_id" class="txt_in stop_in" value="<?php echo $talk->author->name;?>" />
          </label>
        </li>

        <li>
          <label class="field_comment">排序 ：</label>
          <label class="field_value">
            <input id="input_position" type="text" name="position" class="txt_in txt_w" value="<?php echo $talk->position;?>" width="100"/>(值越大，越靠前)
          </label>
		</li>
		
		<li>
			<label class="field_comment">标签：</label>
			<?php foreach($tag_list as $tag) { ?>
				<label class="field_value fv_tag">
					<input id="input_tag<?php echo $tag->id;?>" type="checkbox" name="checkbox" class="txt_check_box" value="<?php echo $tag->id;?>" <?php foreach($talk->tags as $talk_tag){if($talk_tag->id == $tag->id){echo "checked='checked'";}}?> /><?php echo $tag->name; ?>	
				</label>
			<?php }?>
        </li>
		
        <li>
          <label class="field_comment">开始时间(必填)：</label>
          <label class="field_value">
            <input id="input_start_time" type="text" name="start_time" class="txt_in" value="<?php echo $talk->start_time; ?>"/>
          </label>
        </li>

        <li>
          <label class="field_comment">结束时间(必填)：</label>
          <label class="field_value">
            <input id="input_end_time" type="text" name="end_time" class="txt_in" value="<?php echo $talk->end_time; ?>"/>
          </label>
        </li>
				
        <li>
          <label class="field_comment">活动地址(必填)：</label>
          <label class="field_value">
            <input id="input_address" type="text" name="address" class="txt_in" value="<?php echo $talk->address; ?>"/>
          </label>
        </li>
				
        <li>
          <label class="field_comment">举办方(必填)：</label>
          <label class="field_value">
            <input id="input_holder" type="text" name="holder" class="txt_in" value="<?php echo $talk->holder; ?>"/>
          </label>
        </li>
				
        <li>
          <label class="field_comment">封面人物图片的alt(SEO)：</label>
          <label class="field_value">
            <input id="input_seo_alt" type="text" name="seo_alt" class="txt_in" value="<?php echo $talk->seo_alt; ?>"/>
          </label>
        </li>
				
        <li>
          <label class="field_comment">页面title(SEO)：</label>
          <label class="field_value">
            <input id="input_seo_title" type="text" name="seo_title" class="txt_in" value="<?php echo $talk->seo_title; ?>" />
          </label>
        </li>

        <li>
          <label class="field_comment">封面人物图片的keywords(SEO)：</label>
          <label class="field_value">
            <input id="input_seo_keywords" type="text" name="seo_keywords" class="txt_in" value="<?php echo $talk->seo_keywords; ?>"/>
          </label>
        </li>

        <li>
          <label class="field_comment">预览路径：</label>
          <label class="field_value">
            <input id="input_seo_keywords" readonly=readonly type="text" name="preview" class="txt_in" value="/talk/detail.php?id=<?php echo $talk->id ?>"/>
          </label>
        </li>
      </ul>

      <input id="input_submit" type="button" value="保存" class="btn" onclick="save_talk();">
    </form>
  </div>

  <div id="talk_content" class="content">
    <?php foreach($talk->content as $section) { ?>

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
          <label class="field_comment">选择图片(640*480)：</label>
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

  <div class="toolbar" id="toolbar">
    <button class="button" onclick="new_text_section()">添加文字</button>
    <button class="button" onclick="new_image_section()">添加图片</button>
    <button class="button" onclick="new_video_section()">添加视频</button>
    <button class="button" onclick="new_title_section()">添加标题</button>
    <button class="button" onclick="new_link_section()">添加链接</button>
  </div>

  <script src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script src="/m/pages/js/jquery.json.js"></script>
  <script src="/m/pages/js/jquery-ui.js"></script>
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
                     "<input type='text' name='num' class='txt_in' value='<?php echo count($talk->content); ?>'/>" +
                   "</label>" +
                 "</li>" +
               "</ul>" +
               "<div class='toolbar toolbar_little'>" +
                 "<button id='btn_save' class='button' onclick='save_text_section(\"new_section\")'>保存</button>" +
                 "<button id='btn_cancel' class='button' onclick='remove_new_section(\"new_section\")'>取消</button>" +
               "</div>" +
             "</div>";
     $("#talk_content").append(html);
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
                     "<input type='text' name='num' class='txt_in' value='<?php echo count($talk->content); ?>'/>" +
                   "</label>" +
                 "</li>" +
                "</ul>" +
                "<div class='toolbar toolbar_little'>" +
                  "<button class='button' onclick='save_title_section(\"new_section\")'>保存</button>" +
                  "<button class='button' onclick='remove_new_section(\"new_section\")'>取消</button>" +
                "</div>" +
             "</div>";
      $("#talk_content").append(html);
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
                     "<input type='text' name='num' class='txt_in' value='<?php echo count($talk->content); ?>'/>" +
                   "</label>" +
                 "</li>" +
               "</ul>" +
               "<div class='toolbar toolbar_little'>" +
                 "<button class='button' onclick='save_link_section(\"new_section\")'>保存</button>" +
                 "<button class='button' onclick='remove_new_section(\"new_section\")'>取消</button>" +
               "</div>" +
             "</div>";
      $("#talk_content").append(html);
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
                   "<input type='text' name='num' class='txt_in' value='<?php echo count($talk->content); ?>'/>" +
                 "</label>" +
               "</li>" +
             "</ul>" + 

             "<div class='toolbar toolbar_little'>" +
               "<button class='button' onclick='save_image_section(\"new_section\")'>保存</button>" +
               "<button class='button' onclick='remove_new_section(\"new_section\")'>取消</button>" +
             "</div>" +
             "</div>";

      $("#talk_content").append(html);
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
                   "<input type='text' name='num' class='txt_in' value='<?php echo count($talk->content); ?>'/>" +
                 "</label>" +
               "</li>" +

               "<div class='toolbar toolbar_little'>" +
                 "<button class='button' onclick='save_video_section(\"new_section\")'>保存</button>" +
                 "<button class='button' onclick='remove_new_section(\"new_section\")'>取消</button>" +
               "</div>" +
             "</ul>" + 
             "</div>";

      $("#talk_content").append(html);
      $("#toolbar").hide();
    }
    function save_text_section(sec_id) {
      secid = null;
      if(sec_id !== 'new_section') {
        secid = sec_id;
      }
      var detail = $('#section_' + sec_id).find('textarea').val();
      var num = $('#section_' + sec_id).find("input[name='num']").val();
      save_section(secid, 0, detail, '', '', <?php echo $talk->id; ?>, '', num);
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
      save_section(secid, 4, detail, '', '', <?php echo $talk->id; ?>, '', num);
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
      save_section(secid, 2, detail, '', '', <?php echo $talk->id; ?>, link, num);
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
      save_section(secid, 1, detail, path, alt, <?php echo $talk->id; ?>, '', num);
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
      save_section(secid, 3, detail, path, alt, <?php echo $talk->id; ?>, link, num);
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
    function save_section(id, type, detail, image_path, seo_alt, act_id, link, num) {
      var json_array = { "type" : type,
                         "detail" : detail,
                         "image_path" : image_path,
                         "seo_alt": seo_alt,
                         "activity_id" : act_id,
                         "link": link,
                         "num": num
                       };
      if(id !== "new_section") {
        json_array["id"] = id; ;
      }
      var json_data = $.toJSON(json_array);

      $.ajax({
        url:"/m/api/user.php?mod=save_section&type=0",
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

    function save_talk() {
		if(check()) {
			var checkbox = document.getElementsByName("checkbox");
			txt=""
			for (i=0;i<checkbox.length;++ i){
				if (checkbox[i].checked){
					txt=txt + checkbox[i].value + "#";
				}
			}			
      		var json_array = { <?php if($talk->id) { echo "id : " . $talk->id . ","; } ?>
                         "type" : <?php echo $talk->type; ?>,
                         "guest_name" : $("#input_guest_name").val(),
                         "guest_avatar": $("#img_avatar").attr("src"),
                         "guest_intro" : $("#input_guest_intro").val(),
                         "title": $("#input_title").val(),
                         "summary": $("#input_summary").val(),
                         "seo_title": $("#input_seo_title").val(),
                         "thumbnail": $("#img_cover").attr("src"),
                         "seo_alt": $("#input_seo_alt").val(),
                         "start_time": $("#input_start_time").val(),
                         "end_time": $("#input_end_time").val(),
                         "address": $("#input_address").val(),
                         "seo_keywords": $("#input_seo_keywords").val(),
						 "position": $("#input_position").val(),
						 "tags":txt,
                         "holder": $("#input_holder").val()
                       };
      		var json_data = $.toJSON(json_array);

      		$.ajax({
        		url:"/m/api/user.php?mod=save_activity",
        		type:'post',
	        	data:json_data,
    	    	dataType:'json',
        		contentType:'application/json',
        		success:function(data) {
          			window.location.href = "/m/admin.php?mod=talk&next_id=0&count=10";
        		},
        		error:function(xhr, msg, obj) {
          			alert(msg);
        		}
      		});

		}
    }

    function edit_section() {
    }
  </script>
  
  	<!-- 统计文字数量 -->
  <script type="text/javascript">
	$(document).ready(function() {
		var summLength = $("#input_summary").val().length;
		var introLength = $("#input_guest_intro").val().length;
		
		if(100-summLength > 0){
			$(".summary_words").html(100-summLength);
		}else {
			$(".summary_words").html(0);
		}
		
		if(60-introLength > 0){
			$(".guest_intro_words").html(60-introLength);
		}else {
			$(".guest_intro_words").html(0);
		}
	});
	$("#input_summary").keyup(function() {
		var summLength = $("#input_summary").val().length;
		if(summLength>=0 && summLength <= 100){
			var newLength = 100-summLength;
			$(".summary_words").html(newLength);
		}else {
			layer.open({
				content:'字数已经超出！',
				time:2,
				shadeClose:false
			});
		    $("#input_summary").val("");
		}
		
	});
	
	$("#input_guest_intro").keyup(function() {
		var introLength = $("#input_guest_intro").val().length;
		if(introLength>=0 && introLength <= 60){
			var newLength = 60-introLength;
			$(".guest_intro_words").html(newLength);
		}else {
			layer.open({
				content:'字数已经超出！',
				time:2,
				shadeClose:false
			});
		    $("#input_guest_intro").val("");
		}
	});
  </script>
  <script>
  
	
  </script>
  
</body>
</html>
