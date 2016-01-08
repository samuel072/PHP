<?php 
	include_once(ykfile("source/modules/tag_module.php"));
	class TagService{
		/**
		* 根据channel_id查询对一个的标签对象
		* return tag列表
		*/
		public function get_defualt($channel_id){
			$tagModule = new TagModule();
			return $tagModule->get_defualt($channel_id);
		}
		
		/**
		* 查询所有的标签对象
		* return 返回tag标签对象集合
		*/
		public function get_all() {
			$tagModule = new TagModule();
			return $tagModule->get_all();
		}
	}
?>