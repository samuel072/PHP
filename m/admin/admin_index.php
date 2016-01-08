<?php
require_once(ykfile("source/model/user_model.php"));
	if(unserialize($_SESSION['current_user'])) {
		$role = unserialize($_SESSION['current_user'])->role;
		
		if($role == 'admin'){
			require_once (ykfile("pages/admin/index.php"));
		}else {
			require_once(ykfile("pages/admin/login.php"));
		}
		
	}else {
		include(ykfile('pages/admin/index.php'));
	}
?>
