<?php
require_once("../config.php");
require_once(ykfile("source/talker_service.php"));
header("Content-type:text/html;charset=utf8");

// 获取数据 保存数据库
$image = upload_img("image");
$name = $_POST['name'];

$talkerSer = new TalkerService();
$result = $talkerSer->save_talker($name, $image); // success id  fail false
if($result){
	echo "保存成功！";
}


// 上传图片
function upload_img($file_upload_name) {
	
	$imgName = $_FILES["$file_upload_name"]['name'];//上传文件的名称
	$imgType = $_FILES["$file_upload_name"]['type'];//上传文件的类型
	$imgSize = $_FILES["$file_upload_name"]['size'];//上传文件的大小
	$imgTmp_name = $_FILES["$file_upload_name"]['tmp_name'];//上传文件在服务器上的临时文件名称
	
	//随机生成一个图片名称
	$imgDbName = md5(getUuid());
	//截取文件的后缀
	$ext = explode(".", $imgName);
	$ext = $ext[count($ext)-1];
	$savePath = "pages/upload/".$imgDbName.".".$ext;
	if(file_exists($savePath)){ //  如果存在这个路径
		echo $savePath ."already exists<br />\n";
	}else{// 不存在路径的时候
		move_uploaded_file($imgTmp_name,ykfile($savePath));
		return $savePath;
	}
}

function getUuid(){
	$str = md5(uniqid(mt_rand(), true));   
	$uuid  = substr($str,0,8) . '-';   
	$uuid .= substr($str,8,4) . '-';   
	$uuid .= substr($str,12,4) . '-';   
	$uuid .= substr($str,16,4) . '-';   
	$uuid .= substr($str,20,12);   
    return $uuid; 
}
?>
