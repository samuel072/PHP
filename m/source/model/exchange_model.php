<?php

require_once('commodity_model.php');
require_once('user_model.php');

// 兑换记录
class ExchangeModel
{
	const state_finished = 0;
	const state_waiting = 1;

	public $id;			//全局唯一标识
	public $commodity;	//商品
	public $user;		//商品图片路径
	public $mobile;		//兑换时用的手机号，如快递接收人
	public $address;	//快递地址
	public $name;		//收件人
	public $exch_time;	//兑换时间
	public $code;		//兑换码
	public $state;		//状态 0:线下已领取, 1:线下待领取

	public function __construct() {
		$this->commodity = new CommodityModel();
		$this->user = new UserModel();
	}
}
?>
