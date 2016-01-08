<?php
	if(!empty($_SESSION['current_user'])){
		$user_id = unserialize($_SESSION['current_user'])->uuid;
		$userSer = new UserService($user_id);
		$record_list = $userSer->get_by_user($user_id, 3, 0, 10);
		$page_title = '我的参加';
		require_once(ykfile("pages/user/join_record.php"));
	}else{
        $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	    echo "<script type='text/javascript'>alert('请您先登陆！');window.location.href='/m/user.php?mod=signin&url=$url'</script>";
	}
	

?>
