<?php
require_once("video_live_model.php");
require_once('user_model.php');
require_once('activity_model.php');

class CommentModel
{
	const state_waiting = 0;
	const state_published = 1;
	const state_rejected = 2;

	public $id;			//评论ID
	public $user;		//发表评论的用户
	public $activity;	//评论对应的活动
	public $video_live; //外键 VideoLiveModel 的video_id
	public $detail;		//评论内容
	public $subtime;	//发布时间
	public $state;		//状态 0:待审核, 1:已发布, 2:驳回
	public $reason;		//评论审核不通过的原因
	public $position;	//排行位置

	function __construct() {
		$this->user = new UserModel();
		$this->activity = new ActivityModel();
		$this->position = 20000;
		$this->video_live = new VideoLiveModel();
	}
}

?>
