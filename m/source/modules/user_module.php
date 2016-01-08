<?php
require_once(ykfile("source/dbtables/user_table.php"));
require_once(ykfile("source/dbtables/check_code_table.php"));	
	
class UserModule
{

	private $user;

	public function __construct($user_id) {
		$this->user = new UserModel();
		$this->user->uuid = $user_id;
	}
		
	/*
	* 根据手机号码查询验证码
	* @param $mobile 手机号码
	*/
	public function get_code_by_mobile($mobile,$verify_code){
		$checkCodeTable = new CheckCodeTable();
		return $checkCodeTable->get_code_by_mobile($mobile,$verify_code);
		
	}
		
	/**
	* 通过手机号码 删除check_code的记录
	* @param $mobile 手机号码
	*/
	public function del_check_code_by_mobile($mobile){
		$checkCodeTable = new CheckCodeTable();
		return $checkCodeTable->del_check_code_by_mobile($mobile);
	}
	
	/*
	* 根据手机号码和密码查询数据
	* @param $mobile	手机号码
	* @param $password	登陆密码
	*/
	public function get_by_mobile_pass($mobile,$password) {
		$userTable = new UserTable();
		return $userTable->get_by_mobile_pass($mobile, $password);
	}	
	
	// 修改用户兑换的积分
	public function sub_score($uuid, $scores) {
		$userTable = new UserTable();
		return $userTable->sub_score($uuid, $scores);
	}
			
	/*
	* 根据id 查询出用户的信息
	* @param $uuid 用户的uuid 唯一标识符
	*/
	public function get_by_id($uuid){
		$userTable = new UserTable();
		return $userTable->get_by_id($uuid);
	}	
	/*
	* 根据id查询到用户信息 并修改该用户的密码
	* @param $uuid
	* @param newpassword
	*/
	public function update_user($uuid, $newpassword){
		$userTable = new UserTable();
		return $userTable->update_user($uuid, $newpassword);
	}
	
	/**
	* 根据手机号修改用户的密码
	* @param $mobile
	* @param $password
	*/
	public function update_user_by_mobile($mobile, $password) {
		$userTable = new UserTable();
		return $userTable->update_user_by_mobile($mobile, $password);
	}
	
	/**
	* 根据手机号查询用户信息
	* @param $mobile 手机号码
	*/
	public function get_user_by_mobile($mobile)	{
		$userTable = new UserTable();
		return $userTable->get_user_by_mobile($mobile);
	}
	
	/**
	 * 插入电话号码和验证码
	 * @param  $mobile
	 * @param  $verify_code
	 */
	public function add_verify_code($mobile, $verify_code) {
		$checkCodeTable = new CheckCodeTable();
		return $checkCodeTable->add_verify_code($mobile, $verify_code);
	}
	
	/**
	 * 判断该号码是否已经注册
	 * @param  $mobile   手机号码
	 */
	public function check_is_register($mobile) {
		$userTable = new UserTable();
		return $userTable->check_is_register($mobile);
	}
	
	/**
	 * 添加用户
	 * @param $mobile		手机号码
	 * @param $password		密码
	 * @param $validate		是否验证
	 */
	public function register($mobile, $password, $nick_name, $validate) {
		$userTable = new UserTable();
		return $userTable->register($mobile, $password, $nick_name, $validate);
	}
	
	/**
	 * 根据属性id 查询 用户信息
	 * @param unknown $user_id
	 */
	public function get_by_userId($user_id) {
		$userTable = new UserTable();
		return $userTable->get_by_userId($user_id);
	}
	
	/**
	 * 检查nick_name是否唯一
	 * @param String $nick_name
	 */
	public function check_name($nick_name) {
		$userTable = new UserTable();
		$result = $userTable->check_name($nick_name);
		return $result;
	}
	
	/**
	* 修改用户名
	*/
	public function update_profile($uuid, $name) {
		$userTable = new UserTable();
		return $userTable->update_profile($uuid, $name);
	}
	
	/**
	* QQ第三方登陆
	*/
	public function save_user_part($user, $name_temp, $type) {
		$userTable = new UserTable();
		return $userTable->save_user_part($user, $name_temp, $type);
	}
	
	/**
	 * 根据用户姓名模糊查询用户的信息 
	 * @param unknown $userName
	 */
	public function getInfoByLikeName($userName){
		$userTab = new UserTable();
		return $userTab->getInfoByLikeName($userName);
	}
}
?>
