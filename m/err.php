<?php 

define('ERR_INTERNAL', 2000);

define('DB_ERR_MIN', 3000);
define('DB_ERR_NO_DATA', DB_ERR_MIN + 1);	//没有这条数据

define('USER_ERR_MIN', 4000);
define('USER_ERR_SCORE_NOT_ENOUGH', USER_ERR_MIN + 1);
define('ERR_USER_PASSWORD_INCORRECT', USER_ERR_MIN + 2);

define('NICK_NAME_IS_ALREADY', 10001); // 昵称已经被占用
define('GOOD_IS_ZERO', 10002); //该商品已经被兑换完啦
define('ACTIVITY_IS_ALREADY', 10003); //活动已经被收藏
?>
