<?php
require_once (ykfile ( "source/dbtables/db.php" ));
require_once (ykfile ( "source/model/user_model.php" ));
class UserTable extends DB {
	public function __construct() {
		parent::__construct ( USER_DB_HOST, USER_DB_USER, USER_DB_PWD, USER_DB_NAME );
	}
	public function table_name() {
		return "reader";
	}
	public function dbobj_to_model($obj) {
		$userModel = new UserModel ();
		$userModel->uuid = $obj->uuid;
		$userModel->name = empty ( $obj->nick_name_temp ) ? $obj->nick_name : $obj->nick_name_temp;
		$userModel->mobile = $obj->mobile_phone;
		$userModel->email = $obj->email;
		$userModel->scores = $obj->yike_score;
		$userModel->avatar = $obj->portrait;
		$userModel->address = $obj->address;
		$userModel->birth_date = $obj->birth_date;
		$userModel->is_actived = $obj->is_actived;
		$userModel->password = $obj->password;
		$userModel->real_name = $obj->real_name;
		$userModel->register_date = $obj->register_date;
		$userModel->type = $obj->type;
		$userModel->qq = $obj->qq;
		$userModel->msn = $obj->msn;
		$userModel->constellation = $obj->constellation;
		$userModel->isbindtel = $obj->isbindtel;
		$userModel->isvalidation = $obj->isvalidation;
		$userModel->readerinfo_id = $obj->readerinfo_id;
		$userModel->sex = $obj->sex;
		$userModel->weibo_code = $obj->weibo_code;
		$userModel->idcode = $obj->idcode;
		$userModel->penname = $obj->penname;
		$userModel->role = $obj->role;
		$userModel->firstlogin = $obj->firstlogin;
		$userModel->award_rank = $obj->award_rank;
		return $userModel;
	}
	
	/*
	 * 根据手机号码和密码查询数据
	 * @param $mobile 手机号码
	 * @param $password 登陆密码
	 */
	public function get_by_mobile_pass($mobile, $password) {
		$sql = "";
		
		if (is_numeric ( $mobile )) { // 验证参数mobile 是否为数字
			$sql = "SELECT r.*,rf.yike_score,rf.portrait FROM reader r,readerinfo rf WHERE rf.id = r.readerinfo_id AND r.mobile_phone = '$mobile' AND r.password = '$password'";
		} else {
			$sql = "SELECT r.*,rf.yike_score,rf.portrait FROM reader r,readerinfo rf WHERE rf.id = r.readerinfo_id AND r.email = '$mobile' AND r.password = '$password'";
		}
		$user_info = $this->get_list_by_sql ( $sql );
		
		if (count ( $user_info ) <= 0) {
			return NULL;
		}
		return $user_info [0];
	}
	
	// 修改用户的积分数
	public function sub_score($uuid, $scores) {
		$sql = "UPDATE readerinfo rf SET rf.yike_score = rf.yike_score+$scores WHERE rf.id = (SELECT r.readerinfo_id FROM reader r WHERE r.uuid = '$uuid')";
		return mysql_query ( $sql, $this->conn );
	}
	
	/**
	 * 根据id 查询出用户的信息
	 * 
	 * @param $uuid 用户的uuid
	 *        	唯一标识符
	 */
	public function get_by_id($uuid) {
		$sql = "SELECT r.*,rf.yike_score,rf.portrait FROM reader r,readerinfo rf WHERE rf.id = r.readerinfo_id AND r.uuid ='" . $uuid . "'";
		$user_info = $this->get_list_by_sql ( $sql );
		return $user_info;
	}
	public function update_user($uuid, $newpassword) {
		$column = array (
				"password" => $newpassword 
		);
		$where = "uuid = '" . $uuid . "'";
		if ($this->update ( $column, $where )) {
			return 0;
		} else {
			return mysql_error ();
		}
	}
	
	/**
	 * 根据手机号修改用户的密码
	 * 
	 * @param
	 *        	$mobile
	 * @param
	 *        	$password
	 */
	public function update_user_by_mobile($mobile, $password) {
		$table_name = $this->table_name ();
		$sql = "update $table_name set password = '$password' where mobile_phone = '$mobile'";
		return mysql_query ( $sql, $this->conn );
	}
	
	/**
	 * 根据手机号查询用户信息
	 * 
	 * @param $mobile 手机号码        	
	 */
	public function get_user_by_mobile($mobile) {
		$sql = "";
		if (is_numeric ( $mobile )) { // 验证参数mobile 是否为数字
			$sql = "SELECT r.*,rf.yike_score,rf.portrait FROM reader r,readerinfo rf WHERE rf.id = r.readerinfo_id AND r.mobile_phone = '$mobile'";
		} else {
			$sql = "SELECT r.*,rf.yike_score,rf.portrait FROM reader r,readerinfo rf WHERE rf.id = r.readerinfo_id AND r.email = '$mobile'";
		}
		$user_info = $this->get_list_by_sql ( $sql );
		return empty ( $user_info ) ? 1000 : $user_info;
	}
	
	/**
	 * 判断该号码是否已经注册
	 * 
	 * @param $mobile 手机号码        	
	 */
	public function check_is_register($mobile) {
		$sql = "SELECT r.*,rf.yike_score,rf.portrait FROM reader r,readerinfo rf WHERE rf.id = r.readerinfo_id AND r.mobile_phone='$mobile'";
		return $this->get_list_by_sql ( $sql );
	}
	
	/**
	 * 添加用户
	 * 
	 * @param $mobile 手机号码        	
	 * @param $password 密码        	
	 * @param $validate 是否验证        	
	 */
	public function register($mobile, $password, $nick_name, $validate) {
		// 1、添加用户信息表
		date_default_timezone_set ( "Asia/Shanghai" );
		$nowTime = date ( "Y-m-d H:i:s" );
		$ip = $this->getIPaddress ();
		
		$sql_info = "INSERT INTO readerinfo(id,SIGN,yike_score,tags,selftags,medals,portrait,level,ip,last_time,author_id,singnum,last_sign,total_count,account_balance,owned_presents) VALUES(NULL,NULL,5,NULL,NULL,NULL,'/upload/user.jpg',1,'$ip','$nowTime',NULL,NULL,NULL,1,0.00,NULL)";
		if (mysql_query ( $sql_info, $this->conn )) {
			$id = mysql_insert_id ( $this->conn );
			// 2、添加用户表
			$type = 11; // 一刻手机网站注册用户
			$uuid = $this->create_uuid ();
			$sql_user = "INSERT INTO reader (id,address,birth_date,email,fax,fix_phone,is_actived,mobile_phone,nick_pinyin,nick_name,PASSWORD,real_pinyin,real_name,register_date,security_question,sequrity_answer,TYPE,month_freetx_id,month_tx_id,ct_tx_id,qq,msn,constellation,bindtel,isbindtel,isvalidation,readerinfo_id,sex,weibo_code,detail_add,postalcode,idcode,penname,role,firstlogin,award_rank,nick_name_temp,UUID)VALUES(NULL,NULL,NULL,NULL,NULL,NULL,TRUE,'$mobile',NULL,'$nick_name','$password',NULL,NULL,'$nowTime',NULL,NULL,$type,NULL,NULL,NULL,NULL,NULL,NULL,NULL,FALSE,TRUE,'$id',NULL,NULL,NULL,NULL,NULL,NULL,'signedreader',TRUE,0,'$nick_name','$uuid')";
			if (mysql_query ( $sql_user, $this->conn )) {
				$reader_id = mysql_insert_id ( $this->conn );
				return $reader_id;
			} else {
				file_put_contents ( "/tmp/yike.log", "register: " . mysql_error () . "\n", FILE_APPEND );
			}
		} else {
			file_put_contents ( "/tmp/yike.log", "register: " . mysql_error () . "\n", FILE_APPEND );
		}
		return false;
	}
	/**
	 * 获取真实IP地址
	 * 
	 * @return Ambigous <string, unknown>
	 */
	public static function getIPaddress() {
		$IPaddress = '';
		
		if (isset ( $_SERVER )) {
			if (isset ( $_SERVER ["HTTP_X_FORWARDED_FOR"] )) {
				$IPaddress = $_SERVER ["HTTP_X_FORWARDED_FOR"];
			} else if (isset ( $_SERVER ["HTTP_CLIENT_IP"] )) {
				$IPaddress = $_SERVER ["HTTP_CLIENT_IP"];
			} else {
				$IPaddress = $_SERVER ["REMOTE_ADDR"];
			}
		} else {
			if (getenv ( "HTTP_X_FORWARDED_FOR" )) {
				$IPaddress = getenv ( "HTTP_X_FORWARDED_FOR" );
			} else if (getenv ( "HTTP_CLIENT_IP" )) {
				$IPaddress = getenv ( "HTTP_CLIENT_IP" );
			} else {
				$IPaddress = getenv ( "REMOTE_ADDR" );
			}
		}
		return $IPaddress;
	}
	
	/**
	 * 获取uuid
	 * 
	 * @param string $prefix        	
	 * @return string
	 */
	public static function create_uuid($prefix = "") { // 可以指定前缀
		$str = md5 ( uniqid ( mt_rand (), true ) );
		$uuid = substr ( $str, 0, 8 ) . '-';
		$uuid .= substr ( $str, 8, 4 ) . '-';
		$uuid .= substr ( $str, 12, 4 ) . '-';
		$uuid .= substr ( $str, 16, 4 ) . '-';
		$uuid .= substr ( $str, 20, 12 );
		return $prefix . $uuid;
	}
	
	/**
	 * 根据属性id 查询 用户信息
	 * 
	 * @param unknown $user_id        	
	 */
	public function get_by_userId($user_id) {
		$sql = "SELECT r.*,rf.yike_score,rf.portrait FROM reader r,readerinfo rf WHERE rf.id = r.readerinfo_id AND r.id ='" . $user_id . "'";
		file_put_contents ( "/tmp/yike.log", "get_by_userId---->" . $sql . "\n", FILE_APPEND );
		$user_info = $this->get_list_by_sql ( $sql );
		return empty ( $user_info ) ? 1000 : $user_info [0];
	}
	
	/**
	 * 检查nick_name是否唯一
	 * 
	 * @param unknown $nick_name        	
	 */
	public function check_name($nick_name) {
		$sql = "select r.* from reader as r where r.nick_name='$nick_name'";
		$result = mysql_query ( $sql, $this->conn );
		
		if (! $result) {
			file_put_contents ( "/tmp/yike.log", "Error check_name($name_name): " . mysql_error () . "\n", FILE_APPEND );
			return 0;
		}
		
		while ( $rows = mysql_fetch_object ( $result ) ) {
			return 0; // 昵称被占用
		}
		return 1; // 昵称没有被占用
	}
	
	/**
	 * 修改用户名称
	 */
	public function update_profile($uuid, $name) {
		$table_name = $this->table_name ();
		$sql = "update $table_name set nick_name_temp = '$name' where uuid = '$uuid'";
		
		mysql_query ( $sql, $this->conn );
		$rows = mysql_affected_rows ( $this->conn );
		if ($rows != 0) {
			return true; // update success
		} else {
			return false;
		}
	}
	
	/*
	 * QQ第三方登陆
	 */
	public function save_user_part($user, $name_temp, $type) {
		$nowTime = date ( "Y-m-d H:i:s" );
		$ip = $this->getIPaddress ();
		
		$nick_name = $user->name;
		$sex = $user->sex;
		$avatar = $user->avatar;
		
		$sql_info = "INSERT INTO readerinfo(id,SIGN,yike_score,tags,selftags,medals,portrait,level,ip,last_time,author_id,singnum,last_sign,total_count,account_balance,owned_presents) VALUES(NULL,NULL,5,NULL,NULL,NULL,'$avatar',1,'$ip','$nowTime',NULL,NULL,NULL,1,0.00,NULL)";
		file_put_contents ( "/tmp/yike.log", "save_user_info_id_sql==>" . $sql_info . "\n", FILE_APPEND );
		if (mysql_query ( $sql_info, $this->conn )) {
			$user_info_id = mysql_insert_id ( $this->conn );
			$uuid = $this->create_uuid ();
			$sql_user = "INSERT INTO reader (id,address,birth_date,email,fax,fix_phone,is_actived,mobile_phone,nick_pinyin,nick_name,PASSWORD,real_pinyin,real_name,register_date,security_question,sequrity_answer,TYPE,month_freetx_id,month_tx_id,ct_tx_id,qq,msn,constellation,bindtel,isbindtel,isvalidation,readerinfo_id,sex,weibo_code,detail_add,postalcode,idcode,penname,role,firstlogin,award_rank,nick_name_temp,UUID)VALUES(NULL,NULL,NULL,NULL,NULL,NULL,TRUE,NULL,NULL,'$nick_name',NULL,NULL,NULL,'$nowTime',NULL,NULL,$type,NULL,NULL,NULL,NULL,NULL,NULL,NULL,FALSE,TRUE,'$user_info_id','$sex',NULL,NULL,NULL,NULL,NULL,'signedreader',TRUE,0,'$name_temp','$uuid')";
			file_put_contents ( "/tmp/yike.log", "save_user_id_sql==>" . $sql_user . "\n", FILE_APPEND );
			
			if (mysql_query ( $sql_user, $this->conn )) {
				$reader_id = mysql_insert_id ( $this->conn );
				return $reader_id;
			} else {
				file_put_contents ( "/tmp/yike.log", "register: " . mysql_error () . "\n", FILE_APPEND );
			}
		} else {
			file_put_contents ( "/tmp/yike.log", "register: " . mysql_error () . "\n", FILE_APPEND );
		}
	}
	
	/**
	 * 根据用户姓名模糊查询用户的信息
	 * 
	 * @param unknown $userName        	
	 */
	public function getInfoByLikeName($userName) {
		$sql = "SELECT r.*,rf.yike_score,rf.portrait FROM
				reader r,readerinfo rf WHERE 
				rf.id = r.readerinfo_id AND
		        r.nick_name like '%$userName%' 
		        or r.nick_name_temp like '%$userName%'";
		return $this->get_list_by_sql($sql);
	}
}
?>
