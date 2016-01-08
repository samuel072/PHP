<?php
require_once(ykfile("source/model/video_live_model.php"));
require_once(ykfile("source/dbtables/db.php"));
class VideoLiveTable extends DB
{
  public function table_name() {
    return "video_live";
  }

  public function dbobj_to_model($obj) {
    $videoLive = new VideoLiveModel();
    $videoLive->id = $obj->id;
    $videoLive->title = $obj->title; 
    $videoLive->thumbnail = $obj->thumbnail;
    $videoLive->address = $obj->address;
    $videoLive->is_free = $obj->is_free;
    $videoLive->category->id = $obj->category_id;
    $videoLive->pv = $obj->pv;
    $videoLive->like_num = $obj->like_num;
    $videoLive->state = $obj->state;
    $videoLive->is_delete = $obj->is_delete;
    $videoLive->user->uuid = $obj->user_uuid;
    $videoLive->video_id = $obj->video_id;   
    $videoLive->start_time = $obj->start_time;
    $videoLive->end_time = $obj->end_time;
    $videoLive->position = $obj->position;
     
    return $videoLive;
  }
  
  // 根据视频类型查询对应的列表
  function get_all($type, $next_id, $count){
    $table_name = $this->table_name();
    if($type === NULL) { // 查询所有类型的数据列表
      $sql = "select a.* from $table_name as a where a.is_delete != 1 and a.state = 2 limit $next_id, $count";
    }else {
      $sql = "select a.* from $table_name as a where category_id = $type and  a.is_delete != 1 and a.state = 2 limit $next_id, $count";
    }
    return $this->get_list_by_sql($sql);
  }

  function get_count($type){
    $table_name = $this->table_name();
    if($type === NULL){
      $sql = "select count(*) from $table_name";
    }else {
      $sql = "select count(*) from $table_name where category_id = $type";
    }

    $result = mysql_query($sql);
    if(!$result) {
      return 0;
    }
    list($num) = mysql_fetch_row($result);
    return $num;

  }
  
  /**
   * 修改视频直播信息
   */
  public function update_video($video){
  	$table_name = $this->table_name();
  	$id = $video->id;
  	$category_id = $video->category_id;
  	$title = $video->title;
  	$summary = $video->summary;
  	$thumbnail = $video->thumbnail;
  	$start_time = $video->start_time;
  	$end_time = $video->end_time;
  	$address = $video->address;
  	$position = $video->position;
  	$address = $video->address;
  	$user_uuid = $video->user_uuid;
  	$is_free = $video->is_free;
  	$pv = $video->pv;
  	$like_num = $video->like_num;
  	$state = $video->state;
  	$is_delete = $video->is_delete;
  	$video_id = $video->video_id;
  	
  	$sql = "update $table_name set title = '$title', address = '$address', thumbnail = '$thumbnail', is_free = '$is_free',
  	category_id = '$category_id', pv = '$pv', like_num = '$like_num', state = '$state', is_delete = '$is_delete', user_uuid = '$user_uuid',
  	 video_id = '$video_id', start_time = '$start_time', end_time = '$end_time', position = '$position' where id = $id";
  	
  	file_put_contents("/tmp/yike.log", "update_video--sql ===".$sql."\n", FILE_APPEND);
    return mysql_query($sql, $this->conn);
  }
	
  public function insert_video($video) {
    $table_name = $this->table_name();
  	$id = $video->id;
  	$category_id = $video->category_id;
  	$title = $video->title;
  	$summary = $video->summary;
  	$thumbnail = $video->thumbnail;
  	$start_time = $video->start_time;
  	$end_time = $video->end_time;
  	$address = $video->address;
  	$position = $video->position;
  	$address = $video->address;
  	$user_uuid = $video->user_uuid;
  	$is_free = $video->is_free;
  	$pv = $video->pv;
  	$like_num = $video->like_num;
  	$state = $video->state;
  	$is_delete = $video->is_delete;
  	$video_id = $video->video_id;
  	
  	$sql = "insert into $table_name(title, address, thumbnail, is_free, category_id, pv, like_num, state, is_delete, user_uuid, video_id, start_time, end_time, position) values
		('$title', '$address', '$thumbnail', '$is_free', '$category_id', '$pv', '$like_num', '$state', '$is_delete', '$user_uuid', '$video_id', '$start_time', '$end_time', '$position')";
  	
  	file_put_contents("/tmp/yike.log", "insert_video--sql ===".$sql."\n", FILE_APPEND);
    return mysql_query($sql, $this->conn);
	}

  /**
   * 根据视频类型  查询出对应数量视频的基本信息 
   * @param int $category_id  
   * @param int $count
   */
  public function get_video_by_type($category_id, $next_id, $count){
    $table_name = $this->table_name();

    $sql = "select a.* from $table_name as a where a.category_id = $category_id and a.is_delete != 1 and a.state = 2
    order by a.position desc, a.start_time limit $next_id, $count";
    return $this->get_list_by_sql($sql);
  }
  
	/**
	* 伪删除视频直播
	* @param $id             视频直播列表的id
	* @param $is_delete      删除的状态
	*/
  public function remove_video($id, $is_delete){
    $table_name = $this->table_name();
		
    $sql = "delete from $table_name where id = $id ";
    return mysql_query($sql);
  } 

  public function update_pv($pv, $id) {
   $table_name = $this->table_name();
   
   $sql = "update $table_name set pv = $pv+1 where id = $id";
   file_put_contents("/tmp/record",date("Y-m-d H:i:s") ."---pv==".($pv+1)."\n", FILE_APPEND);
   return mysql_query($sql); 
  }
    
}
?>
