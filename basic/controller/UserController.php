a<?php
require_once(zeroPath('Mysql.class.php'));
$uuid = getUuid();
$sql = "insert into zp_user (uuid, user_name, password, sex, age, avatar, time, login_ip) values ('".$uuid."', 'zero', '".md5('111111')."', 1, 25, 'http://pics.sc.chinaz.com/files/pic/pic9/201511/apic16807.jpg', '".date('Y:m:d h:i:s', time())."', '".getIp()."')";
$result = $db->adu($sql);

?>
