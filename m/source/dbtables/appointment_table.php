<?php	

require_once(ykfile("source/dbtables/db.php"));
require_once(ykfile("source/model/appointment_model.php"));

class AppointmentTable extends DB
{
	public function table_name() {
		return 'appointment';
	}

	// 数据库对像，转成模型对象
	public function dbobj_to_model($obj) {
		$appoint = new AppointmentModel();
		$appoint->id = $obj->id;
		$appoint->user->uuid = $obj->user_id;
		$appoint->name = $obj->name;
		$appoint->mobile = $obj->mobile;
        $appint->com_address = $obj->com_address;
		$appoint->activity->id = $obj->activity_id;
		$appoint->state = $obj->state;
		$appoint->message = $obj->message;
		$appoint->appoint_time = $obj->appoint_time;

		return $appoint;
	}

	// 取指定用户的预约信息
	public function get_by_user($user_id, $state, $next_id = 0, $count = 10) {
		
		$sql = "select * from appointment where user_id = '$user_id' and state = $state limit $next_id, $count";
		$list = $this->get_list_by_sql($sql);
		return $list;
	}

	// 取指定状态值小于$state的用户预约信息
	public function get_by_user_less($user_id, $state, $next_id = 0, $count = 10) {
		
		$sql = "select * from appointment where user_id = '$user_id' and state < $state limit $next_id, $count";
		$list = $this->get_list_by_sql($sql);

		return $list;
	}

	// 取某个活动的预约报名信息
	public function get_by_activity($act_id, $next_id = 0, $count = 10) {
		$sql = "select * from appointment where activity_id = $act_id limit $next_id, $count";
		$list = $this->get_list_by_sql($sql);

		return $list;
	}

	// 取指定活动的报名数
	public function get_count_by_act($act_id) {
		$sql = "select count(*) from " . $this->table_name() . " where act_id = $act_id";

		$result = mysql_query($sql, $this->conn);

		if(!$result) {
			return 0;
		}

		list($num) = mysql_fetch_row($result);
		return $num;
	}

	// 取指定用户的报名预约数量
	public function get_count_by_user($user_id, $state) {

		$table = $this->table_name();
		$sql = "select count(*) from $table where user_id = '$user_id' and state = $state";

		$result = mysql_query($sql, $this->conn);

		if(!$result) {
			return 0;
		}

		list($num) = mysql_fetch_row($result);
		return $num;
	}

	// 取指定用户预约信息，状态值小于$state
	public function get_count_by_user_less($user_id, $state) {

		$table = $this->table_name();
		$sql = "select count(*) from $table where user_id = $user_id and state < $state";

		$result = mysql_query($sql, $this->conn);

		if(!$result) {
			return 0;
		}

		list($num) = mysql_fetch_row($result);
		return $num;
	}

	// 插入一个预约信息, 返回ID
	public function insert_appoint($appoint) {
		$user_id = $appoint->user->uuid;
		$name = $appoint->name;
		$mobile = $appoint->mobile;
		$act_id = $appoint->activity->id;
		$state = $appoint->state;
        $com_address = $appoint->com_address;
		$reason = '';
		$app_time = date('Y-m-d H:i:s');
		$table = $this->table_name();
		$sql = "insert into $table(user_id, name, mobile, com_address, activity_id, state, message, appoint_time) values ('$user_id', '$name', '$mobile', '$com_address', $act_id, $state, '$reason', '$app_time')";

        file_put_contents("/tmp/yike.log", "insert_appoint----->".$sql."\n", FILE_APPEND);
		if(mysql_query($sql, $this->conn)) {
			return mysql_insert_id($this->conn);
		} else {
			return false;
		}
	}

	// 更新状态
	function update_state($appid, $state) {
		$table = $this->table_name();
		$sql = "update $table set state = $state where id = $appid";
		
		return mysql_query($sql, $this->conn);
	}
	
	/*
	* 通过预约的电话和活动id 查询数据
	* @param $appoint_act_id 预约活动的id
	* @param $appoint_mobile 预约活动的手机号码
	*/
	public function select_appoint($appoint_act_id,$appoint_mobile){
		$sql = "select * from appointment as a where a.activity_id = $appoint_act_id and a.mobile = '$appoint_mobile'";
		return $this->get_list_by_sql($sql);
	}
	
	/**
	* 通过用户id和活动id 查询数据( 当用户预约活动的时候 查询看该用户是否已经预约了该活动)
	* @param $appoint_act_id 预约活动的id
	* @param $user_id 预约活动的手机号码
	*/
	public function select_appoint_userId($appoint_act_id, $user_id) {
		$sql = "select a.* from appointment as a  where a.user_id = '$user_id' and a.activity_id = $appoint_act_id";
		return $this->get_list_by_sql($sql);
	}

	// 获取注册用户的预约信息
	public function get_user_appoint($uuid) {
		$sql = "select a.* from appointment as a where a.user_id = '$user_id'";
		$acts = $this->get_list_by_sql($sql);

		return $acts;
	}
	
	// 查询所有的预约信息
	public function get_all($next_id, $count) {
		$sql = "select a.* from appointment as a order by appoint_time desc limit $next_id, $count";
		return $this->get_list_by_sql($sql);
	}
	
	// 查询所有预约的条数
	public function get_count() {
		$sql = "select count(*) from appointment";
		
		$result = mysql_query($sql);
		if(!$result){
			return 0;
		}
		
		list($num) = mysql_fetch_row($result);
		return $num;
	}
	
	
	public function update_appoint($appoint_id, $state) {
		$table_name = $this->table_name();
		$sql = "update $table_name set state = $state where id = $appoint_id ";
		
		mysql_query($sql, $this->conn);
		$rows = mysql_affected_rows($this->conn);
		if($rows != 0) {
			return true;
		}else {
			file_put_contents("/tmp/yike.log","appoint----sql =======>".$sql."\n", FILE_APPEND);
			return false;
		}
	}
}

?>
