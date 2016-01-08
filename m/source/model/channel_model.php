<?php

class ChannelModel
{
	const channel_type_adv = 0;
	const channel_type_talk = 1;
	const channel_type_activity = 2;
	const channel_type_talker = 3;
	const channel_type_mooc = 4;

	public $id;			//栏目ID
	public $type;		//类型 0:广告位, 1:演讲, 2:活动, 3:点他来讲 4:公开课
	public $name;		//栏目名称
	public $summary;	//栏目简介
	public $seo_title;	//网页SEO用的title
	public $seo_desc;	//网页SEO用的description
	public $thumbnail;	//栏目图标
	public $seo_alt;	//网页SEO用的alt
	public $seo_keywords;	//网页SEO用的keywords
	public $tags;		//栏目标签
	public $content;	//栏目内容

	function __construct() {
		$this->tags = array();
		$this->content = array();
	}
}

?>
