<?php
header("Content-type: text/html; charset=utf-8");
function ykfile($path)
{
	return dirname(__FILE__) . "/" . $path;
}

// channel_id

define("RECENT_TALK_CHANNEL", 5); // 一刻预告的演讲的channel_id
define("RECENT_ACTIVITY_CHANNEL", 6); // 一刻预告的沙龙的channel_id
define("HOT_ACTIVITY_CHANNEL", 7); // 现在用于在标签和活动的中间表

define("PORTAL_ADV_CHANNEL", 8);  // 首页的广告位 channel_id
define("PORTAL_TALK_CHANNEL", 9); // 首页的演讲  channel_id
define("PORTAL_ACTIVITY_CHANNEL", 10); // 首页的沙龙 channel_id
define("PORTAL_TALKER_CHANNEL", 3); // 首页的点TA来讲的channel_id

//channel type
define("CHANNEL_TYPE_ADV", 0);
define("CHANNEL_TYPE_TALK", 1);
define("CHANNEL_TYPE_ACTIVITY", 2);
define("CHANNEL_TYPE_TALKER", 3);
define("CHANNEL_TYPE_MOOC", 4);

// 用户的默认头像
define("USER_PORTRAIT", "/upload/user.jpg");

define("STAGE_INDEX", 1); // 标示前台访问
define("STAGE_ADMIN", 0); // 标示后台访问

define("GET_SCORE", 0);	 	// 0 : 获得积分
define("LOST_SCORE", 1);	// 1 ：兑换积分  从原来的积分减少


?>
