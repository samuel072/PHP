<?php 
require_once(ykfile("source/modules/recent_module.php"));
require_once(ykfile("source/modules/activity_module.php"));
require_once(ykfile("source/modules/channel_module.php"));
	
class RecentService
{
	/**
	* 查询一刻演讲的预告
	*/
	public function get_recent_all($next_id, $pagesize) {
		$recent_mod = new RecentModule();
		if(empty($next_id) || empty($pagesize)){
			$next_id = 0;
			$pagesize = 10;
		}

		date_default_timezone_set("Asia/Shanghai");
		$nowTime = date("Y-m-d H:i:s");
		return $recent_mod->get_recent_all($nowTime,$next_id,$pagesize);
	}

	// 获取预告数量
	public function get_count() {
		$recent_mod = new RecentModule();
	/*	if($mod == 'talk'){
			$channel_id = RECENT_TALK_CHANNEL; 
		}else {
			$channel_id = RECENT_ACTIVITY_CHANNEL;
		}*/
		return $recent_mod->get_count();
	}

	// 查询近期的演讲或活动预告
	// $type talk:演讲, activity:活动
	public function get_recent($next_id, $count) {
		$mod = new ActivityModule();
		return $mod->get_recent($next_id, $count);
	}
	
	// 根据标签id 和 活动类型 获取预告列表
	public function get_recent_by_tagId($tag_id, $next_id, $count){
		$activityModule = new ActivityModule();
		return $activityModule->get_recent_by_tagId($tag_id, $next_id, $count);
	}
}

?>
