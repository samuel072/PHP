<?php 

require_once('user_model.php');

class ActivityModel 
{
	const type_talk		= 0;		//演讲类型
	const type_activity	= 1;		//活动类型
	const type_mooc		= 2;		//公开课类型

	const state_waiting		= 0;	//待审核状态
	const state_rejected	= 1;	//驳回状态
	const state_published	= 2;	//发布状态

	public $id;						//活动ID
	public $type;					//类型 0:演讲, 1:活动, 2:公开课
	public $guest_name;				//嘉宾姓名
	public $guest_avatar;			//嘉宾头像
	public $guest_intro;			//嘉宾简介
	public $title;					//活动标题
	public $summary;				//活动描述
	public $seo_title;				//活动详情页面的SEO title
	public $thumbnail;				//活动封面图路径
	public $seo_alt;				//活动封面图的SEO alt
	public $state;					//状态 0:待审核, 1:驳回, 2:发布
	public $author;					//发布者ID
	public $start_time;				//活动开始时间
	public $end_time;				//活动结束时间
	public $address;				//活动地点
	public $longitude;				//活动地点经度
	public $latitude;				//活动地点纬度
	public $modify_time;			//修改时间
	public $seo_keywords;			//活动详情页的SEO关键字
	public $is_delete;				//是否删除
	public $holder;					//主办方
	public $position;				//置顶顺序,越大越靠前
	public $message;				//驳回后的给用户看的信息
	public $allow;					//0：不允许报名(默认) 1:允许报名
    public $is_free;                //0:免费 1：收费
    public $link;                   //报名链接

	public $content;				//内容章节
	public $channel_array;			//关联栏目
	public $tags;					//关联的标签

	public function __construct() {
		$this->author = new UserModel();
		$this->content = array();
		$this->channel_array = array();
		$this->tags = array();
	}

	//是否开始
	public function is_started() {
		return strtotime(date('Y-m-d H:i:s')) > strtotime($this->start_time);
	}

	//是否过期
	public function is_expired() {
		return strtotime(date('Y-m-d H:i:s')) > strtotime($this->end_time);
	}
}

?>
