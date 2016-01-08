<?php
	require_once(ykfile('source/activity_service.php'));
	
	if(!empty($_SESSION['current_user'])) {
		$user_id = $_SESSION['currnet_user']->uuid;
		$actsrv = new ActivityService();
		$act_list = $actsrv->get_by_user($user_id, 0, 10);

		$page_title = '我的发布';	
		require_once(ykfile("pages/user/sub_record.php"));
	}else {
        $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	    echo "<script type='text/javascript'>alert('请您先登陆！');window.location.href='/m/user.php?mod=signin&url=$url'</script>";
	}
	
?>
