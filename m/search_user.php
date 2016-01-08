<?php
require_once('config.php');
require_once(ykfile('source/user_service.php'));

$param = json_decode(file_get_contents("php://input"));
$userName = $param->userName;

$userSer = new UserService(NULL);
if($userName){
  $userList= $userSer->getInfoByLikeName($userName);
}else {
  echo json_encode(array("status"=>1, "message"=>"fail"));
  return;
}

if($userList){
  echo json_encode(array("status"=>0, "message"=>"success", "userInfo"=>$userList));	
}else{
  echo json_encode(array("status"=>1, "message"=>"fail"));
}

?>