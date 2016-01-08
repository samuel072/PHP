<?php

require_once(ykfile("source/dbtables/favor_table.php"));
require_once(ykfile("source/dbtables/activity_table.php"));
require_once(ykfile("source/modules/activity_module.php"));
require_once(ykfile("source/modules/user_module.php"));
require_once(ykfile("source/modules/appointment_module.php"));
require_once(ykfile("source/modules/user_module.php"));
require_once(ykfile("source/modules/encrypt_module.php"));
require_once(ykfile("source/modules/qq_reader_module.php"));
require_once(ykfile("source/commodity_service.php"));

class UserService
{
	private $user;

	public function __construct($user_id) {
		// 后期改成从缓存或数据库获取
		$this->user = new UserModel();
		$this->user->uuid = $user_id;
		$this->user->scores = 10000;
	}

	public function get_current() {
		return $this->user;
	}

	/*
	* 根据手机号码查询验证码
	* @param $mobile 手机号码
	*/
	public function get_by_mobile($mobile,$verify_code){
		//TODO判断手机号码是否正确
		$userModule = new UserModule(@$user_id);
		return $userModule->get_code_by_mobile($mobile, $verify_code);
    }

	/**
	* 通过手机号码 删除check_code的记录
	* @param $mobile 手机号码
	*/
	public function del_check_code_by_mobile($mobile){
		$module = new UserModule(@$user_id);
		//TODO判断手机号码是否正确
		return $module->del_check_code_by_mobile($mobile);
	}

	// 取当前用户收藏列表
	public function get_favors($next_id, $count) {
		$table = new FavorTable();
		$favors = $table->get_by_user($this->user->uuid, $next_id, $count);

		$acts = array();
		$act_table = new ActivityTable();

		foreach($favors as $f) {
			$acts[] = $act_table->get_by_id($f->activity->id);
		}

		return $acts;
	}

	// 获取当前用户收藏数量
	public function get_favors_count() {
		$table = new FavorTable();
		return $table->get_count_by_user($this->user->uuid);
	}

	// 失败返回false, 正确返回相应的ID  添加收藏
	public function add_favor($act_id, $uuid, $type) {
		$table = new FavorTable();
		$favor = new FavorModel();
		$favor->user = $this->user;
		$favor->activity->id = $act_id;
		$favor->type = $type;

		$favor_info = $table->get_by_user_and_act($favor);
		if($favor_info) {  // 已经收藏过啦
			return ACTIVITY_IS_ALREADY;
		}else { // 没有收藏过
			return $table->insert_favor($favor);
		}
		
	}

	// 根据手机号码和密码查询数据
	public function get_by_mobile_pass($mobile,$password){
		// TODO判断手机号码是否正确
		$userModule = new UserModule($this->user->uuid);
		// 查询出用户信息
		$user_info = $userModule->get_user_by_mobile($mobile);
		
		if($user_info !== NULL) {
			$signup_date = date('Y-m-d', strtotime($user_info[0]->register_date)); // 数据库取注册日期
			$password = $this->encrypt_passwd($password, $signup_date); // 加密密码

			return $userModule->get_by_mobile_pass($mobile,$password);
		}

		return NULL; 
	}

	// 兑换商品，todo:这个地方需要事务支持
	public function exchange_commodity($com_id, $mobile, $address, $name) {
		$comsrv = new CommodityService();
		$com = $comsrv->get_by_id($com_id);
		
		if($com->count <= 0) {
			return GOOD_IS_ZERO;
		}
		
		$user_info = $this->get_by_uuid($this->user->uuid);
		if($com->price > $user_info->scores) {
			return USER_ERR_SCORE_NOT_ENOUGH;
		}
		
		// 插入兑换记录
		$result = $comsrv->add_exch_record($com_id, $this->user->uuid, $mobile, $address, $name);
		if($result) {
			$umod = new UserModule($this->user->uuid);
			$score = 0-($com->price);
			$rs = $umod->sub_score($this->user->uuid, $score);
			
			$comsrv->dec_com($com_id);
		}
		
		return $result;
	}
	
	/*
	* 根据uuid 修改密码
	* @param $uuid			用户id
	* @param $newpassword	新的密码
	* @param $repassword    确认新的密码
	*/
	public function update_user_pwd($uuid, $oldpassword, $newpassword) {
		if($oldpassword == $newpassword){
			return 1000;
		}

		$userModule = new UserModule($uuid);
		$user_info = $userModule->get_by_id($uuid);
		if($user_info != 1000 && !empty($user_info)) {

			//将$oldpassword 加密  然后跟 $user_info->password 对比 看是不是相等 相等->修改  否则
			$signup_date = date('Y-m-d', strtotime($user_info[0]->register_date)); // 修改成数据库取注册日期
			$oldpwd = $this->encrypt_passwd($oldpassword, $signup_date);
			if($oldpwd != $user_info[0]->password) {
				return ERR_USER_PASSWORD_INCORRECT;
			}
			//密码需要加密算法
			$newpwd = $this->encrypt_passwd($newpassword, $signup_date);
				
			$userModule->update_user($uuid, $newpwd);
			$user_info = $userModule->get_by_id($uuid);
			return $user_info[0];
		}

		return false;
	}
	
	/*
	* 根据uuid 重置密码
	* @param $uuid			用户id
	* @param $newpassword	新的密码
	* @param $repassword    确认新的密码
	*/
	public function reset_user_pwd($uuid, $mobile, $password) {
		$userModule = new UserModule($uuid);
		$user_info = $userModule->get_user_by_mobile($mobile);
		if($user_info) {
			//将$oldpassword 加密  然后跟 $user_info->password 对比 看是不是相等 相等->修改  否则
			$signup_date = date('Y-m-d', strtotime($user_info[0]->register_date)); // 修改成数据库取注册日期
			//密码需要加密算法
			$newpwd = $this->encrypt_passwd($password, $signup_date);
				
			$userModule->update_user_by_mobile($mobile, $newpwd);
			$user_info = $userModule->get_user_by_mobile($mobile);
			return $user_info[0];
		}
		return false;
	}
	

	/**
	* 用户预约
	* @param $appoint appointmentTable 对象
	* #param $code 验证码
	*/
	
	public function insert_appoint($appoint, $code){
		$appointment = new AppointmentModule();

		$check_info = $this->get_by_mobile($appoint->mobile, $code);	
		if($check_info == 1000) { // 没有查询到
			return false;
		}else {
			return $appointment->insert_appoint($appoint);
		}			
	}
	
	/**
	* 未登录状态(报名参加)
	* 通过预约的电话和活动id 查询数据( 当用户预约活动的时候 查询看该手机号码是否已经预约了该活动)
	* @param $appoint_act_id 预约活动的id
	* @param $appoint_mobile 预约活动的手机号码
	*/
	public function select_appoint_actId($appoint_act_id, $appoint_mobile) {
		$appointment = new AppointmentModule();
		return $appointment->select_appoint($appoint_act_id, $appoint_mobile);
	}
	
	/**
	* 登录状态下
	* 通过用户id和活动id 查询数据( 当用户预约活动的时候 查询看该用户是否已经预约了该活动)
	* @param $appoint_act_id 预约活动的id
	* @param $user_id 用户id
	*/
	public function select_appoint_userId($appoint_act_id, $user_id) {
		$appointment = new AppointmentModule();
		return $appointment->select_appoint_userId($appoint_act_id, $user_id);
	}

	public function get_user_appoints($start, $count) {
		$appointment = new AppointmentModule();
	}
	
	// 使用idea加密密码，根据注册日期'Y-m-d'的格式生成密钥
	public function encrypt_passwd($pwd, $date) {
		// 防止传进来的参数格式不对
		$date = date('Y-m-d', strtotime($date));
		return EncryptModule::encrypt($pwd, $date);	
	}
	
	/**
	* 取指定状态值小于$state的用户预约信息
	* 通过用户id 查询该用户的预约信息记录
	* @param $user_id 用户的唯一标识符 uuid
	*/
	public function select_appoint_by_uuid($user_id, $state, $next_id, $count) {
		$appointment = new AppointmentModule();
		$activityMod = new ActivityModule();
		$appoint_list = $appointment->get_by_user_id($user_id, $state, $next_id, $count);
		$appoint_array = array();
		foreach($appoint_list as $appoint){
			$activity = $activityMod->get_by_id($appoint->activity->id);
			$appoint->activity = $activity;
			array_push($appoint_array, $appoint);
		}
		return $appoint_array;
	}
	
	// 取指定用户预约信息，状态值小于$state
	public function get_count_by_user_less($user_id, $state) {
		$appointment = new AppointmentModule();
		return $appointment->get_count_by_user_less($user_id, $state);
	}
	
	/**
	* 取指定用户的预约信息
	* @param $user_id	用户id
	* @param $state		预约状态
	*/
	public function get_by_user($user_id, $state, $next_id, $count) {
		$appointment = new AppointmentModule();
		$appoint_list = $appointment->get_by_user($user_id, $state, $next_id, $count);
		
		$activityMod = new ActivityModule();
		$appoint_array = array();
		foreach($appoint_list as $appoint){
			$activity = $activityMod->get_by_id($appoint->activity->id);
			$appoint->activity = $activity;
			array_push($appoint_array, $appoint);
		}
		
		return $appoint_array;
	}
	
	/**
	* 查询指定用户的预约条数
	* @param $user_id	用户id 
	* @param $state 	预约状态
	*/
	public function get_count_by_user($user_id, $state) {
		$appointment = new AppointmentModule();
		return $appointment->get_count_by_user($user_id, $state);
	}
	
	/**
	 * 插入电话号码和验证码
	 * @param  $mobile
	 * @param  $verify_code
	 */
	public function add_verify_code($mobile,$verify_code) {
		$userModule = new UserModule(@$user_id);
		return $userModule->add_verify_code($mobile,$verify_code);
	}
	
	/**
	 * 判断该号码是否已经注册
	 * @param  $mobile   手机号码
	 */
	public function check_is_register($mobile) {
		$userModule = new UserModule($this->user->uuid);
		return $userModule->check_is_register($mobile);
	}
	
	/**
	 * 注册用户  到了这里已经验证过了该手机号是否被注册
	 * @param  $mobile
	 * @param  $password
	 */
	public function register($mobile, $password ,$nick_name) {
		$userModule = new UserModule($this->user->uuid);
		$is_nick_name = $userModule->check_name($nick_name);

		if($is_nick_name == 1) {
			date_default_timezone_set("Asia/Shanghai");
			$nowTime = date("Y-m-d");
			// 加密密码
			$password = $this->encrypt_passwd($password, $nowTime);
			$userInfo = $userModule->register($mobile, $password, $nick_name, 1);
			return $userInfo;
		} else {
			//nick_name 被占用、
			return false;
		}				
	}
	
	/**
	 * 根据user_id id = user_id 不是uuid 查询用户信息 
	 * @param $user_id
	 */
	public function get_by_id($user_id) {
		$userModule = new UserModule($this->user->uuid);
		return $userModule->get_by_userId($user_id);
	}
	
	public function get_by_uuid($uuid) {
		$userModule = new UserModule($uuid);
		$user_info = $userModule->get_by_id($uuid);
		return $user_info[0];
	}
	
	/**
	* 修改用户的昵称
	* @param $name 用户的唯一昵称
	* @param $uuid 用户的唯一标识符
	* return 返回的是用户的基本信息
	*/
	public function update_profile($uuid, $name) {
		$userModule = new UserModule($uuid);
		// 检查昵称是否被占用 
		$is_nick_name = $userModule->check_name($name);
		if($is_nick_name == 1) {
			$user = $userModule->update_profile($uuid, $name);
			if($user) {
				return $userModule->get_by_id($uuid);
			}else {
				return DB_ERR_NO_DATA;
			}
		}else {
			return NICK_NAME_IS_ALREADY;
		}
	}
	
	/*
		第三方登陆 QQ
	*/
	public static function create_uuid($prefix = ""){    //可以指定前缀
			$str = md5(uniqid(mt_rand(), true));
			$uuid  = substr($str,0,8) . '-';
			$uuid .= substr($str,8,4) . '-';
			$uuid .= substr($str,12,4) . '-';
			$uuid .= substr($str,16,4) . '-';
			$uuid .= substr($str,20,12);
			return $prefix.$uuid;
	}
	
	//  查询 open_id 
	public function save_user_part ($user, $open_id, $type) {
		// 检查open_id
		$qq_reader_mod = new QQReaderModule();
		$qq_reader_info = $qq_reader_mod->check_open_id($open_id);
		if($qq_reader_info) { // 不是第一次登陆
			$user_info = $this->get_by_id($qq_reader_info->user->id);
			return $user_info;
		}else {  // 是第一次登陆
			$userModule = new UserModule($user->uuid);
			$is_nick_name = $userModule->check_name($user->name);
			$name_temp = "";
			if($is_nick_name != 1) {
				$name_temp = $user->name;
				$user->name = $user->name.$this->create_uuid();
			}
			$userMod = new UserModule($this->user->uuid);
			$user_id = $userMod->save_user_part($user, $name_temp, $type);
			
			// 保存 qq_open_id  reader_id
			if($user_id) {
				$qq_reader_mod->save_qq_reader($open_id, $user_id);
				$user_info = $this->get_by_id($user_id);
				return $user_info;
			}
			return null;
		}
	}
	
	/**
	 * 根据用户姓名模糊查询用户的信息
	 * @param unknown $userName
	 */
	public function getInfoByLikeName($userName) {
      $userMod = new UserModule(NULL);
      return $userMod->getInfoByLikeName($userName);
	}
}

?>
