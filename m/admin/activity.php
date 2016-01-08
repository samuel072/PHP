<?php
header("Content-type:text/html;charset=utf8");
session_start();
require_once("../config.php");
require_once(ykfile("source/model/activity_model.php"));
require_once(ykfile("source/activity_service.php"));

//关于上传图片
//$guest_avatar = $_POST['guest_avatar'];			//嘉宾头像
//$thumbnail = $_POST['thumbnail'];				//封面

// 普通的字段
$activity_type = @$_POST['activity_type'];		//活动类型 0：演讲 1：沙龙 2：公开课
$guest_name = @$_POST['guest_name'];				//嘉宾名称
$guest_intro = @$_POST['guest_intro'];			//嘉宾介绍
$title = @$_POST['title'];						//活动标题
$summary = @$_POST['summary'];					//活动简介
$author_id = @$_POST['author_id'];				//发布活动的作者	
$start_time = @$_POST['start_time'];				//活动开始时间
$end_time = @$_POST['end_time'];					//活动结束时间
$address = @$_POST['address'];					//活动地址
$holder = @$_POST['holder'];						//活动的举办方
$seo_alt = @$_POST['seo_alt'];					//SEO_ALT 图片的alt属性
$seo_keywords = @$_POST['seo_keywords'];			//SEO_KEYWORDS的关键词
$seo_title = @$_POST['seo_title'];

// 上传图片
$guest_avatar = @upload_img("guest_avatar");
$thumbnail = @upload_img("thumbnail");

date_default_timezone_set("Asia/Shanghai");
$now_time = date("Y-m-d H:i:s");

$act = new ActivityModel();
$act->type = $activity_type;
$act->guest_name = $guest_name;
$act->guest_avatar = $guest_avatar;
$act->guest_intro = $guest_intro;
$act->title = $title;
$act->summary = $summary;
$act->seo_title = $seo_title;
$act->thumbnail = $thumbnail;
$act->seo_alt = $seo_alt;
$act->state = 2; 								// state 0:待审核, 1:驳回, 2:发布 
$act->author->uuid = @$_SESSION['current_user']->uuid;
$act->start_time = $start_time;
$act->end_time = $end_time;
$act->address = $address;
$act->modify_time = $now_time;
$act->seo_keywords = $seo_keywords;
$act->holder = $holder;
$act->is_delete = 0;								//0:不删除 1:删除

$activitySer = new ActivityService();
$result = $activitySer->save_activity($act);
if($result){
	echo "保存成功";
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




?>
