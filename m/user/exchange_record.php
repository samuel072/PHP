<?php
	require_once(ykfile("source/commodity_service.php"));
	if(!empty($_SESSION['current_user'])) {

		$user_id = $_SESSION['current_user']->uuid;

		$comsrv = new CommodityService();
		$record_list = $comsrv->get_exchange_record($user_id, 0, 10);

		$page_title = '我的兑换';
		require_once(ykfile("pages/user/exchange_record.php"));
	}else {
        $url = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	    echo "<script type='text/javascript'>alert('请您先登陆！');window.location.href='/m/user.php?mod=signin&url=$url'</script>";
	}

?>
