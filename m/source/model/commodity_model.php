<?php

class CommodityModel
{
	public $id;		//全局唯一标识
	public $name;	//商品名字
	public $image_path;	//商品图片路径
	public $seo_alt;	// 图片的alt值
	public $link;	//介绍的链接, 如果有站外(淘宝)介绍，使用这个字段
	public $code;	//兑换码，优惠券码等
	public $price;	//价格
	public $summary;//简介
	public $city;	//可用的城市
	public $duration;	//活动持续时间
	public $method;	//兑换方式
	public $act_desc;	//活动描述
	public $count;	//数量
}
?>
