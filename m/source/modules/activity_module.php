<?php
	include_once(ykfile("source/dbtables/activity_table.php"));
	include_once(ykfile("source/dbtables/section_table.php"));
	include_once(ykfile("source/dbtables/channel_activity_table.php"));
	include_once(ykfile("source/dbtables/tag_activity_table.php"));

	/**
	* 活动
	* 0:已完成的演讲 1：已完成的沙龙 2：公开课 3：演讲的预告 4：沙龙的预告
	*/
	
	class ActivityModule {

		public function get_by_channel($ch_id, $next_id, $count) {
			$table = new ActivityTable();
			return $table->get_by_channel($ch_id, $next_id, $count);
		}

		
		/**
		* 查询分页式的活动表里面的活动
		* @param $next_id    从那一条数据开始
		* @param $pagesize   数据大小
		* @param $type       活动类型
		* @param $stage 	  是否是前台发送来的数据
		*/
		public function get_all_by_type($tag_id, $next_id, $pagesize, $type, $stage){
			$act_table = new ActivityTable();
			if($stage === STAGE_ADMIN){ // 后台 is_delete = null 
				$is_delete = null;
			}else {
				$is_delete = 0;
			}
			return $act_table->get_all_by_type($tag_id, $next_id, $pagesize, $type, $is_delete);
		}
	
		// 遍历活动表	
		public function get_activity($next_id, $count) {
			$table = new ActivityTable();
			return $table->get_activity($next_id, $count);
			
		}
		/**
		*	通过活动id 查询出段落的数据
		*
		*/
		public function get_sec_by_actId($actId){
			$sect_table = new SectionTable();
			return $sec_list = $sect_table->get_section_by_id($actId);
		}

		public function get_section_by_id($sec_id) {
			$table = new SectionTable();
			return $table->get_by_id($sec_id);
		}
	
		public function save_section($section) {
			$table = new SectionTable();

			if($section->id) {
				$ret = $table->update_section($section);
				if($ret) {
					return $section->id;
				} else {
					return $ret;
				}
			} 

			return $table->insert_section($section);
		}
		
		/**
		* 通过id查询活动的单条数据
		* @param $id 活动的id
		* return activity对象
		*/
		public function get_by_id($id) {
			$act_table = new ActivityTable();
			return $act_table->get_by_id($id);
		}

		public function get_count($tag_id, $type) {
			$table = new ActivityTable();
			return $table->get_type_count($tag_id, $type);
		}
		
		public function get_all_by_type_and_time($next_id,$pagesize,$type){
			$act_table = new ActivityTable();
			date_default_timezone_set("Asia/Shanghai");
			$nowTime = date("Y-m-d H:i:s");
			return $act_table->get_all_by_type_and_time($next_id,$pagesize,$type,$nowTime);
		}
		/**
		* 根据标签id和活动类型查询活动
		* @param $tag_id  标签id
		* @param $type 活动类型
		*/
		public function get_act_by_tag($next_id,$pagesize,$tag_id,$type){
			$act_table = new ActivityTable();
			return $act_table->get_act_by_tag($next_id,$pagesize,$tag_id,$type);
		}

		// 根据发布者ID取活动
		public function get_by_user($user_id, $next_id, $count) {
			$table = new ActivityTable();
			return $table->get_act_by_user($user_id, $next_id, $count);
		}

		// 保存活动, 可用于新建或修改
		// 不会保存相关章节内容
		public function save_activity($act) {
			$table = new ActivityTable();
			$tag_act_tab = new TagActivityTable();
			$activity_id = $act->id;
			//修改后的tag_id
			$up_tag_id = $act->tags;
			$tag_list = explode("#", $up_tag_id);
			
			if($act->id) {
				$table->update_activity($act);
				/**
				*  update = 先删除 后创建
				*/
				$tag_act_tab->del_tag_activity($activity_id);
				foreach($tag_list as $tag_id) {
					$tag_act_tab->insert_tag_activity($tag_id, $activity_id);
				}
				return $act->id;
			} else {
				foreach($tag_list as $tag_id) {
					$tag_act_tab->insert_tag_activity($tag_id, $activity_id);
				}
				return $table->insert_activity($act);
			}
		}

		//获取指定channel当中, 当前已经结束的演讲和活动
		public function get_ended_activity($channel_id, $count) {
			$table = new ActivityTable();

			return $table->get_after_time(date('Y-m-d H:i:s'), $channel_id, $count);
		}
		
		// 根据标签id和活动类型查询活动预告
		public function get_recent_by_tagId($tag_id, $next_id, $count){
			$activityTable = new ActivityTable();
			return $activityTable->get_recent_by_tagId($tag_id, $next_id, $count);

		}
		
		// 获取演讲和沙龙的预告
		public function get_recent($next_id, $count) {
			$actTab = new ActivityTable();
			return $actTab->get_recent($next_id, $count);
			
		}
		// 给活动添加封面
		public function add_cover($act_id, $img_path) {
			$table = new ActivityTable();
			return $table->update_thumbnail_time($act_id, $img_path, date('Y-m-d H:i:s'));
		}

		public function remove_activity($act_id, $is_delete) {
			$table = new ActivityTable();
			return $table->set_deleted_time($act_id, $is_delete, date('Y-m-d H:i:s'));
		}
		
		// 修改channel_activity
		public function update_activity_channel($act_id, $number, $channel_id) {
			$table = new ActivityTable();
			return $table->update_activity_channel($act_id, $number, $channel_id);
		}
		
		public function remove_section($sec_id) {
			$table = new SectionTable();
			return $table->remove_section($sec_id);
		}
		
		////根据发布状态获取对应的数据
		public function get_pub_act_by_state($state, $next_id, $count) {
			$table = new ActivityTable();
			return $table->get_pub_act_by_state($state, $next_id, $count);
		}
		
		public function get_count_by_state($state) {
			$table = new ActivityTable();
			return $table->get_count_by_state($state);
		}
		
		public function set_act_state($act_id, $state, $reject_message) {
			$act_tab = new ActivityTable();
			return $act_tab->set_act_state($act_id, $state, $reject_message);
		}
	
		public function get_act_by_ids ($ids) {
			$act_tab = new ActivityTable();	
			return $act_tab->get_act_by_ids($ids);
		}

	}
?>
