<?php 
	include_once(ykfile("source/modules/activity_module.php"));
	include_once(ykfile("source/modules/channel_module.php"));
	include_once(ykfile("source/modules/tag_module.php"));

	class ActivityService{
		
		public function get_all($tag_id, $next_id, $pagesize, $stage){

			if($next_id === NULL || $pagesize === NULL ){
				$next_id = 0;
				$pagesize = 10;
			}
			if($tag_id === NULL){
				$tag_id = 0;
			}
			$act = new ActivityModule();
			return $act_list = $act->get_all_by_type($tag_id, $next_id, $pagesize, 1, $stage);
		}
		
		/**
		* 根据标签的id查询对应的活动
		* @param $tag_id 标签id
		* return 沙龙活动列表
		*/
		public function get_act_by_tag($tag_id,$next_id,$pagesize){
			$act = new ActivityModule();
			if($next_id === NULL || $pagesize === NULL ){
				$next_id = 0;
				$pagesize = 10;
			}
			return $act->get_act_by_tag($next_id,$pagesize,$tag_id,1);
		}
		/**
		* 根据id查询活动对象
		* 	然后根据活动对象id查询得到段落对象 将段落对象存入活动对象中
		* @param $id 活动id
		*/
		public function get_by_id($id) {
			$mod = new ActivityModule();
			$act = $mod->get_by_id($id);

			if($act != DB_ERR_NO_DATA){
				$sect_list = $mod->get_sec_by_actId($act->id);
				$act->content = $sect_list;
			
				// 获取对应的标签
				$tagModule = new TagModule();
				$tag_list = $tagModule->get_tag_by_actId($act->id);
				$act->tags = $tag_list;
			
				return $act;
			} else {
				return NULL;
			}
		}

		// 根据发布者查询活动
		public function get_by_user($user_id, $next_id, $count) {
			$act = new ActivityModule();
			return $act->get_by_user($user_id, $next_id, $count);
		}

		public function create_activity($act) {
			$actmod = new ActivityModule();
			$act_id = intval($actmod->save_activity($act));
			$act->state = 0; // 待审核

			return $act_id ? $actmod->get_by_id($act_id) : $act_id;
		}
		
		/**
		* 当保存活动或者演讲时
		* 如果开始时间大于当前时间  --> 则保存到当前预告中  否则是热门活动或者是热门演讲
		* 
		* @param $act 活动对象
		*/
		public function save_activity($act) {
			$actmod = new ActivityModule();
			$act_id = $actmod->save_activity($act);

			if($act->id) {
				$act = $actmod->get_by_id($act_id);
				return $act;
			}

			date_default_timezone_set("Asia/Shanghai");
			$act = $actmod->get_by_id($act_id);

			// 如果创建新的演讲或活动，更新到预告中去
			if($act->type == ActivityModel::type_talk) {
				
				$channel = (strtotime($act->start_time) > strtotime(date('Y-m-d H:i:s'))) ? RECENT_TALK_CHANNEL : 0;
				if($channel && $channel != 0) {
					$chmod = new ChannelModule();
					$chmod->add_activity($channel, $act->id, 0);
				}
			} else if($act->type == ActivityModel::type_activity) {

				$channel = (strtotime($act->start_time) > strtotime(date('Y-m-d H:i:s'))) ? RECENT_ACTIVITY_CHANNEL : 0;
				if($channel && $channel != 0) {
					$chmod = new ChannelModule();
					$chmod->add_activity($channel, $act->id, 0);
				}
			}

			return $act;
		}

		// 根据活动开始时间，更新channel_activity对应关系
		// 开始时间晚于当前时间的，从预告中移除，放入完成中，如果已经没有过期数据，返回false
		public function update_channel($count) {
			$mod = new ActivityModule();
			$cha = new ChannelModule();

			$talks = $mod->get_ended_activity(RECENT_TALK_CHANNEL, $count);
			foreach($talks as $act) {
				$cha->remove_activity(RECENT_TALK_CHANNEL, $act->id);
			}

			$acts = $mod->get_ended_activity(RECENT_ACTIVITY_CHANNEL, $count);
			foreach($acts as $act) {
				$cha->remove_activity(RECENT_ACTIVITY_CHANNEL, $act->id);
			}

			return ! ((count($talks) <= 0) && (count($acts) <= 0));
		}

		// 添加封面图，自动覆盖原有的封面
		public function add_cover($act_id, $img_path) {
			$mod = new ActivityModule();
			$mod->add_cover($act_id, $img_path);
		}
		
		// 删除沙龙活动
		public function remove_activity($act_id, $is_delete) {
			$mod = new ActivityModule();
			return $mod->remove_activity($act_id, $is_delete);
		}

		function save_section($section) {
			$mod = new ActivityModule();
			$ret = $mod->save_section($mod);

			if($ret === false) {
				return $ret;
			}

			return $mod->get_section_by_id($ret);
		}
		
		// 获取沙龙活动的数量
		public function get_activity_count($tag_id) {
			$actmod = new ActivityModule();
			return $actmod->get_count($tag_id, ActivityModel::type_activity);
		}
		
		//获取所有的发布活动
		public function get_pub_act_by_state($state, $next_id, $count) {
			$act_mod = new ActivityModule();
			return $act_mod->get_pub_act_by_state($state, $next_id, $count);
		}
		
		// 根据发布状态获取对应的数据大小
		public function get_count_by_state($state) {
			$act_mod = new ActivityModule();
			return $act_mod->get_count_by_state($state);
		}
		
		public function set_act_state($act_id, $state, $reject_message) {
			$act_mod = new ActivityModule();
			return $act_mod->set_act_state($act_id, $state, $reject_message);
		}
	}

?>
