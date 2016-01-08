<?php
    require_once(ykfile("source/modules/activity_module.php"));
    class MoocService{
        /**
         * 查询全部公开课
         */
        public function get_all($next_id, $pagesize, $stage){
            $mooc_ac =new ActivityModule();
			if(empty($next_id) || empty($pagesize)){
				$next_id = 0;
				$pagesize = 10;
			}
			$mooc_list = $mooc_ac->get_all_by_type(@$tag_id,$next_id,$pagesize,2, $stage);
			if($mooc_list != 1000){
				$activity_array = array();
				foreach($mooc_list as $mooc){
					$section_list = $mooc_ac->get_sec_by_actId($mooc->id);
					if($section_list !=1000 && !empty($section_list)){
						foreach($section_list as $section){
							array_push($mooc->content,$section);
						}
					}
					array_push($activity_array, $mooc);
				}
				return $activity_array;
			}else{
				return 1000;
			}
        }
		
		
		// 删除公开课
		public function remove_mooc($mooc_id, $is_delete) {
			$mod = new ActivityModule();
			return $mod->remove_activity($mooc_id, $is_delete);
		}
		
		// 获取公开课的数量
		public function get_activity_count($tag_id) {
			$mod = new ActivityModule();
			return $mod->get_count($tag_id, ActivityModel::type_mooc);
		}
		
		// 根据id 查询公开课信息
		public function get_by_id($mooc_id) {
			$mod = new ActivityModule();
			$mooc = $mod->get_by_id($mooc_id);
			
			if($mooc == DB_ERR_NO_DATA) {
				return NULL;
			}

			$sect_list = $mod->get_sec_by_actId($mooc->id);
			$mooc->content = $sect_list;
			
			// 获取对应的标签
			$tagModule = new TagModule();
			$tag_list = $tagModule->get_tag_by_actId($mooc_id);
			$act->tags = $tag_list;
			return $mooc;
		}
    }
?>
