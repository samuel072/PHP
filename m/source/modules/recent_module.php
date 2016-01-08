<?php 
	require_once(ykfile("source/dbtables/recent_table.php"));
	require_once(ykfile("source/model/activity_model.php"));
	/*
	* 预告层
	*
	*/
	class RecentModule{
		
		/**
		* 根据类型查询预告的activity
		* @param $channel_type	栏目类型
		* @param $ac_type	活动类型	
		* @param $nowTime	当前服务器的时间
		* @param $next_id	开始条数
		* @param $pagesize	每次查询数据的大小	
		*/
		public function get_recent_all($nowTime,$next_id,$pagesize){
			$recentTable = new RecentTable();
			return $recentTable->get_recent_all($nowTime,$next_id,$pagesize);
		}
		
		// 获取预告的数量
		public function get_count() {
			$rec_table = new RecentTable();
			return $rec_table->get_count();
		}
		
	}
?>
