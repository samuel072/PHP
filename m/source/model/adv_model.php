<?php

class AdvModel
{
	const type_ext_web = 0;
	const type_int_web = 1;

	public $id;		//数据库ID
	public $title;	//广告标题
	public $summary;//广告语
	public $type;	//类型 0:外部网页, 1:内部网页
	public $link;	//链接
	public $image;	//广告图片路径
}

?>
