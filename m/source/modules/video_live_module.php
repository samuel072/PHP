<?php
require_once(ykfile("source/dbtables/video_live_table.php"));
require_once(ykfile("source/dbtables/tag_video_table.php"));

class VideoLiveModule
{
  // 根据类型查询视频列表
  function get_all($type, $next_id, $count){
    $videoLiveTab = new VideoLiveTable();
    return $videoLiveTab->get_all($type, $next_id, $count);
  }
  
  // 根据类型查询出对应数据的数量
  function get_count($type){
    $videoLiveTab = new VideoLiveTable();
    return $videoLiveTab->get_count($type);
  }
  
  // 根据id 获取视频直播单个信息
  function get_by_id($id) {
  	$videoLiveTab = new VideoLiveTable();
  	$video = $videoLiveTab->get_by_id($id);
  	if(DB_ERR_NO_DATA == $video){
  		return null;
  	}else {
  		return $video;
  	}
  }
  
  /**
   * 修改视频直播信息
   * @param unknown $video
   */
  public function update_video($video) {
  	
  	 $videoTab = new VideoLiveTable();
  	 $tag_video_tab = new TagVideoTable();
  	 
  	 //修改后的tag_id
  	 $up_tag_id = $video->tags;
  	 $tag_list = explode("#", $up_tag_id);
  	 
  	 // 根据视频直播的id  删除对应的所有的标签中间表关系数据
  	 // insert新的对应关系数据集
  	 $result = $tag_video_tab->delete_tag_video_by_video($video->id);
  	 foreach($tag_list as $tag_id) {
  	 	$tag_video_tab->insert_tag_video($tag_id, $video->id);
  	 }
  	 
  	 return $videoTab->update_video($video);
  	 
  }
  
  /**
   * 保存视频直播信息
   * @param unknown $video
   */
  public function insert_video($video) {
  	 $videoTab = new VideoLiveTable();
  	 $tag_video_tab = new TagVideoTable();
  	 
  	 //修改后的tag_id
  	 $up_tag_id = $video->tags;
  	 $tag_list = explode("#", $up_tag_id);
  	 
  	 // 根据视频直播的id  删除对应的所有的标签中间表关系数据
  	 // insert新的对应关系数据集
  	 foreach($tag_list as $tag_id) {
  	 	 $tag_video_tab->insert_tag_video($tag_id, $video->id);
  	 }
  	 
  	 return $videoTab->insert_video($video);
  }
  
  /**
   * 根据视频类型  查询出对应数量视频的基本信息 
   * @param int $category_id
   * @param int $count
   */
  public function get_video_by_type($category_id, $next_id, $count){
    $videoTab = new VideoLiveTable();
    return $videoTab->get_video_by_type($category_id, $next_id, $count);	
  }

  public function update_pv($pv, $id){
    $videoTab = new VideoLiveTable();
    return $videoTab->update_pv($pv, $id);
  }


}
?>
