<?php 
	include_once(ykfile("source/dbtables/tag_table.php"));
	class TagModule{
		/**
		* 根据channel_id查询对应栏目的标签
		* return tag列表
		*/
		public function get_defualt($chanel_id){
			$tag_table = new TagTable();
			return $tag_table->get_defualt($chanel_id);
		}
		
		/**
		* 查询所有的标签对象
		* return 返回tag标签对象集合
		*/
		public function get_all() {
			$tag_table = new TagTable();
			return $tag_table->get_all();
		}
		
		/**
		* 通过外键查询对应的标签集合
		* @param $act_id activity表的id
		* return $tag_list 标签集合
		*/
		public function get_tag_by_actId($act_id) {
			$tag_table = new TagTable();
			return $tag_table->get_tag_by_actId($act_id);
		}
		
		/**
		 * 通过video的id  查询这个直播视频对应的标签
		 * @param $videoId 视频直播的id
		 */
		public function get_video_tag_by_videoId($videoId){
			$tagTab = new TagTable();
			return $tagTab->get_video_tag_by_videoId($videoId);
		}
	}

?>