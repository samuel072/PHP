<?php	
	require_once(ykfile("source/dbtables/talker_table.php"));
	/**
	* 业务逻辑层  处理页面逻辑的
	*/
	class TalkerService {
		/**
		*	查询全部的演讲
		*	默认大小是10
		*/
		public function get_all($next_id,$pagesize) {
			$tk_table = new TalkerTable();
			return $tk_table->get_all($next_id,$pagesize);
		}
		
		/**
		* 获取总的数据量
		*/
		function get_talk_count() {
			$tk_table = new TalkerTable();
			return $tk_table->get_count();
		}
		
		/**
		* 点TA来讲 增加一个点击数
		*
		*/
		public function click_talker($uuid) {
			$tk_table = new TalkerTable();
			$tk_table->add_point($uuid);
			return $tk_table->get_point($uuid);
		}
		
		/**
		* 保存人物基本信息
		* @param talker  talker对象
		*/
		public function save_talker($talker) {
			$tk_table = new TalkerTable();
			return $tk_table->save_talker($talker);
		}
		
		/**
		* 通过id查询数据
		* @param talker_id talker的id 唯一标识符
		*/
		public function get_by_id($talker_id) {
			$tk_table = new TalkerTable();
			return $tk_table->get_talker_id($talker_id);
		}
	}
?>
