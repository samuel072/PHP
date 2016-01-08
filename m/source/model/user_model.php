<?php

/* 这个类定义不全，用到的时候请增加字段和注释 */

class UserModel/* implements Serializable*/
{
	const user_default_avatar = '/upload/a.jpg';
	const QQ_LOGIN_USER = 15;

	public $uuid;						//全局唯一标识
	public $name;						//名字
	public $mobile;						//手机号
	public $email;						//电子邮件
	public $scores;						//用户积分
	public $avatar;						//用户头像路径
	public $id;							//id  唯一标识符
	public $address;					//用户地址
	public $birth_date;					//用户生日
	public $is_actived;					//
	public $password;					//密码
	public $real_name;					//真实姓名
	public $register_date;				//注册时间
	public $type;						//注册类型    11 一刻手机网站   详细参看database.docx
	public $qq;							//qq号码
	public $msn;						//注册协议 
	public $constellation;				//星座			
	public $isbindtel;					// 是否绑定手机 
	public $isvalidation;				//是否验证
	public $readerinfo_id;				//readerinfo_id 外键
	public $sex;						//性别
	public $weibo_code;					//微博账号
	public $idcode;						//身份证号码
	public $penname;					//笔名
	public $role;						//角色	
	public $firstlogin;					//是否是第一次登陆
  public $award_rank;					//获奖排名
	

	public function __construct() {
		$avatar = UserModel::user_default_avatar;
	}
}
?>
