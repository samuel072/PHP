<?php

class SectionModel
{
	const type_text = 0;
	const type_title = 4;
	const type_image = 1;
	const type_link = 2;
	const type_video = 3;

	public $id = null;
	public $type = null;		//段落类型  0：文字 1：图片 2：链接 3：视频 4：标题
	public $detail = null;		//纯文本  0 2 3 4 
	public $image_path = null;	//图片路径,或视频截图（1,3）
	public $seo_alt = null;		//图片的alt属性 seo用的
	public $activity_id = null;	//activity表的主键  这个表的外键
	public $link = null;		//外部链接（2,3）
	public $num = null;			//段落顺序
}

?>
