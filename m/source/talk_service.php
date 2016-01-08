<?php
	require_once(ykfile("source/modules/activity_module.php"));
	require_once(ykfile("source/modules/tag_module.php"));
	class TalkService{
		/**
		* 分页查询所有的热门演讲(后台)
		* @param next_id  从next_id条数据开始
		* @param pagesize 每次查询的数据条数
		* @return 返回的是对应的热门演讲列表
		*/
		function get_talk_all($tag_id, $next_id, $pagesize , $stage) {
			$act_modules = new ActivityModule();
			if($next_id === NULL || $pagesize === NULL) {
				$next_id = 0;
				$pagesize = 10;
			}
			return $act_modules->get_all_by_type($tag_id, $next_id, $pagesize, ActivityModel::type_talk, $stage);
		}
		
		function get_talk_by_type($tag_id, $next_id, $pagesize, $type) {
			return array();
			$act_modules = new ActivityModule();
			if(empty($next_id) || empty($pagesize)){
				$next_id = 0;
				$pagesize = 10;
			}
			return $act_modules->get_all_by_type($tag_id, $next_id, $pagesize, ActivityModel::type_talk, $type);
		}

		function get_talk_count($tag_id) {
			$actmod = new ActivityModule();
			return $actmod->get_count($tag_id, ActivityModel::type_talk);
		}
		
		/**
		* 通过id查询出详细的演讲内容
		*
		*/
		function get_by_id($talk_id) {
			$act_modules = new ActivityModule();
			$talk = $act_modules->get_by_id($talk_id);

			if($talk === DB_ERR_NO_DATA) {
				return NULL;
			}

			$talk_section_list = $act_modules->get_sec_by_actId($talk_id);
			foreach($talk_section_list as $section) {
				array_push($talk->content, $section);	
			}
			
			// 获取对应的标签
			$tagModule = new TagModule();
			$tag_list = $tagModule->get_tag_by_actId($talk_id);
			$talk->tags = $tag_list;
			return $talk;
		}

		function remove_talk($talk_id, $is_delete) {
			$actmod = new ActivityModule();
			return $actmod->remove_activity($talk_id, $is_delete);
		}

		function save_section($section) {
			$mod = new ActivityModule();
			$ret = $mod->save_section($section);

			if($ret === false) {
				return $ret;
			}

			return $mod->get_section_by_id($ret);
		}
	}

?>
