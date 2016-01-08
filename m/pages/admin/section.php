<?php
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="Author" content="">
		<meta name="Keywords" content="">
		<meta name="Description" content="">
		<title>上传内容</title>
		<style type="text/css">
			*{margin:0;padding:0;color:#666;font-size:12px;}
			ul li{list-style:none;text-align:center;height:80px;border:1px solid #ff9;}
			.sec_con{width:800px;height:300px;margin:10px auto;}
			.sec_con textarea {width: 80%;height: 60px;resize: none;}
			.sec_con .sec_sel{text-align:center;width:200px;height:30px;}
			.sec_con input{height:30px;width:80%;margin-top: 30px;}
			.sec_con lable{height: 30px;display: block;text-align: center;}
		</style>
	</head>
	<body>
	<!-- 段落类型  0：文字 1：图片 2：链接 3：视图 4：标题 -->
		<div class="sec_con">
			
			<form action="" method="post" enctype="multipart/form-data" >
				<select class='sec_sel'>
					<option value="-1">请选择类型</option>
					<option value='0'>文字</option>
					<option value='1'>图片</option>
					<option value='2'>链接</option>
					<option value='3'>视频</option>
					<option value='4'>标题</option>
				</select>
			</form>
		</div>
		<script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript">
			$(".sec_sel").change(function(){
				var sec_value = this.value;
				var html = "";
				if(sec_value == 0){
					$("form").empty(); 
					html += "<lable>文字内容:</lable><textarea name='detail'></textarea>"+
							"<input type='submit' value='保存'>";
					$("form").append(html);
				}else if(sec_value == 1){
					html += "<lable>上传图片:</lable><input type='file' name='image_path' >"+
							"<input type='submit' value='保存'>";
						
					$("form").append(html);
					
				}else if(sec_value == 2){
					$("form").empty();
					html += "<lable>文字内容:</lable><textarea name='detail'></textarea>"+
							"<lable>链接:</lable><input type='text' name='link' >"+
							"<input type='submit' value='保存'>";
						
					$("form").append(html);
				}else if(sec_value == 3){
					$("form").empty();
					html += "<lable>文字内容:</lable><textarea name='detail'></textarea>"+
							"<lable>链接:</lable><input type='text' name='link' >"+
							"<lable>上传图片:</lable><input type='file' name='image_path' >"+
							"<input type='submit' value='保存'>";
						
					$("form").append(html);
				}else if(sec_value == 4){
					$("form").empty(); 
					html += "<lable>文字内容:</lable><textarea name='detail'></textarea>"+
							"<input type='submit' value='保存'>";
						
					$("form").append(html);
				}
			});
		</script>
		
	</body>
</html>
