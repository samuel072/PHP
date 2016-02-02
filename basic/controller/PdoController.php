<?php 
#date_default_timezone_set('RPC');
$dsn = "mysql:host=localhost;dbname=zero_php";
$pdo = new PDO($dsn, "root", "root");
#$result = $pdo->exec($sql); // 用于insert update delete
$sql = "select * from zp_user order by uuid desc";
$result = $pdo->query($sql);
// $userList = NULL;
if(!$result) {
    $userList = $pdo->errorinfo();
}

$userList = $pdo->query($sql); // 用于select
include_once(zeroPath('/pages/index.php'));
exit;
foreach ($userList as $user) {
	// var_dump($user);
	echo "username============>".$user['user_name']."<br>";
	echo "password============>".$user['password']."<br>";
	if($user['sex'] == 0){
		echo "sex============>女<br>";	
	}else {
		echo "sex============>男<br>";	
	}
	echo "age============>".$user['age']."<br>";
	echo "avatar============>".$user['avatar']."<br>";
	echo "login_time============>".$user['time']."<br>";
	echo "last_time============>".$user['last_time']."<br>";
	echo "login_ip============>".$user['login_ip']."<br>";

	echo "-------------------------------------------------------------------------------<br>";
}


?>
