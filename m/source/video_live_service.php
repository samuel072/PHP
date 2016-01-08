<?php
require_once(ykfile("source/modules/video_live_module.php"));
require_once(ykfile("source/modules/category_module.php"));
require_once(ykfile("source/modules/tag_module.php"));
require_once(ykfile("source/dbtables/section_table.php"));


class VideoLiveService
{
  // 根据视频类型查询对应的视频列表	
  function get_all($type, $next_id, $count){
    $videoLiveMod = new VideoLiveModule();
    $videoList = $videoLiveMod->get_all($type, $next_id, $count);
    $cateMod = new CategoryModule();
    foreach($videoList as $video){
      $category = $cateMod->get_by_id($video->category->id);
      $video->category = $category;
    }
    return $videoList;
  }	
  
  /**
   * 获取对应类型数据的数量
   * @param  $type  视频直播的类型
   */
  function get_count($type){
    $videoLiveMod = new VideoLiveModule();
    return $videoLiveMod->get_count($type);
  }
  
  /**
   * 根据id获取视频直播的内容
   * @param $id
   */
  function get_by_id($id){
  	if($id) {
  		$videoLiveMod = new VideoLiveModule();
	  	$video = $videoLiveMod->get_by_id($id);
	  	$this->save_foreign($video);
	  	
		return $video;
  	}else {
  		return null;
  	}
  }
 
  /**
   * 根据直播视频的id 查询对应的类型、 内容、 标签  并赋值给视频直播
   * @param unknown $video
   */
  public function save_foreign($video) {
  	$categoyMod = new CategoryModule();
  	$tagMod = new TagModule();
  	$sectTab = new SectionTable();
  	
  	$category = $categoyMod->get_by_id($video->category->id);
  	$sect_list = $sectTab->get_sec_by_videoId($video->id);
  	$tag_list = $tagMod->get_video_tag_by_videoId($video->id);
  	
  	$video->category = $category;		// 存入类型
  	$video->content = $sect_list;		// 存入内容
  	$video->tags = $tag_list;			// 存入标签
  	
  }
  
  /**
   * 保存视频直播信息
   * $video 视频的基本信息
   */
  public function save_video($video) {
  	// 判断是否有id  
  	$id = $video->id;
  	$videoMod = new VideoLiveModule();
  	if($id) { // update
  		return $videoMod->update_video($video);
  	}else { // insert
    	return $videoMod->insert_video($video);  		
  	}
  }
  
  /**
   * 根据视频类型  查询出对应数量视频的基本信息 
   * @param int $category_id
   * @param int $count
   */
  public function get_video_by_type($category_id, $next_id, $count){
    $videoMod = new VideoLiveModule();
    $categoyMod = new CategoryModule();
    $tagMod = new TagModule();
    $sectTab = new SectionTable();
    
    $video_list = $videoMod->get_video_by_type($category_id, $next_id, $count);
    
    // 将Tags |　以及内容 填充
    foreach ($video_list as $video){
    	// 根据视频id 查询出相关的标签
    	$this->save_foreign($video);
    }
    
    return $video_list;
  }
	
  public function del($id, $is_delete){
    $videoMod = new VideoLiveModule();
	return $videoMod->remove_video($id, $is_delete);
  }
  
  // 根据id  修改对应的点击这个页面的数量值
  public function update_pv($pv, $id){
    $videoMod = new VideoLiveModule();
    return $videoMod->update_pv($pv, $id);
  }

}
?>
