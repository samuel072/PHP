<?php
require_once(ykfile("source/section_service.php"));

$params = json_decode(file_get_contents('php://input'));

$sectSer = new SectionService();
$result = $sectSer->save_video($params);

if($result){
  echo json_encode(array("status"=>0, "message"=>"保存完成"));
}else{
  echo json_encode(array("status"=>1, "message"=>"保存失败"));	
}

?>