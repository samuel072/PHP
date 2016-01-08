<?php

require_once(ykfile('source/activity_service.php'));

function get_suffix($type) {
	$tok = explode('/', $type);
	return end($tok);
}

$status = NULL;
$message = NULL;

if($_FILES['file']['error']) {
	// 文件上传失败
	$status = ERR_INTERNAL;
	$message = $_FILES['file']['error'];

} else {
	//生成文件名
	$suffix = get_suffix($_FILES['file']['type']);
	$fname = '/upload/' . md5(uniqid(rand())) . '.' . $suffix;

	//保存文件
	$data = file_get_contents($_FILES['file']['tmp_name']); // 文件的全部路径
	// windows 上的路径会是  \\m//  linux 上的路径会是 /m/
	$change_array = array("/m/"=>"/", "\\m//"=>"\\");
	
	$upload_path = strtr(ykfile($fname), $change_array);
	
	if(file_put_contents($upload_path, $data)) {
		$status = 0;
		$message = "保存成功";
	} else {
		$status = ERR_INTERNAL;
		$message = "保存失败";
	}
}

$fname = strtr($fname, $change_array);

echo json_encode(array(
	"status" => $status,
	"message" => $message,
	"path" => $fname
));
?>
