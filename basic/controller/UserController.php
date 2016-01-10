<?php
require_once(zeroPath('Mysql.class.php'));
$uuid = getUuid();
// $password = ;
$sql = "insert into zp_user values ('".$uuid."', 'zero', '".md5('111111')."', 1, 25, 'http://pics.sc.chinaz.com/files/pic/pic9/201511/apic16807.jpg')";
$result = $db->adu($sql);
?>