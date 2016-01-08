<?php
require_once("category_model.php");
require_once("tag_model.php");
require_once("user_model.php");
require_once("comment_model.php");
class VideoLiveModel
{
  public $id;               // 唯一标识符
  public $title;            // 视频标题
  public $thumbnail;        // 视频封面
  public $address;          // 地址
  public $is_free;          // 是否免费  0：免费  公开活动     1：收费  
  public $category;         // 视频类型 id
  public $pv;               // 视频的浏览数量
  public $like_num;         // 喜欢数量
  public $state;            // 状态  0：待审核 1：驳回  2：通过
  public $is_delete;        // 是否删除 0：不删除 1：删除
  public $user;             // 用户uuid
  public $video_id;         // 视频id
  public $start_time;       // 开始时间
  public $end_time;         // 结束时间
  public $position;         // 排序  越大越在前面
  
  public $tags;             // 标签
  public $content;          // 内容 
  public $comments;         // 评论

  function __construct(){
    $this->category = new CategoryModel();
    $this->user = new UserModel();		
    $this->tags = array();
    $this->content = array();
    $this->comments = array();
  }
  
}

?>