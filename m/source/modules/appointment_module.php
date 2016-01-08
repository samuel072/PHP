<?php 
	require_once(ykfile("source/dbtables/appointment_table.php"));
	require_once(ykfile("source/dbtables/activity_table.php"));
	class AppointmentModule	{
		
		/*
		*	用户预约
		* @param $appoint appointmentTable 对象
		*
		*/
		public function insert_appoint($appoint) {
			$appointmentTable = new AppointmentTable();
			return $appointmentTable->insert_appoint($appoint);
		}
		
		/*
		* 通过预约的电话和活动id 查询数据
		* @param $appoint_act_id 预约活动的id
		* @param $appoint_mobile 预约活动的手机号码
		*/
		public function select_appoint($appoint_act_id,$appoint_mobile) {
			$appointmentTable = new AppointmentTable();
			return $appointmentTable->select_appoint($appoint_act_id,$appoint_mobile);
		}
		
		/**
		* 通过用户id和活动id 查询数据( 当用户预约活动的时候 查询看该用户是否已经预约了该活动)
		* @param $appoint_act_id 预约活动的id
		* @param $user_id 预约活动的手机号码
		*/
		public function select_appoint_userId($appoint_act_id, $user_id) {
			$appointmentTable = new AppointmentTable();
			return $appointmentTable->select_appoint_userId($appoint_act_id,$user_id);
		}
		
		/**
		* 通过用户id 查询<$state 状态的 预约信息列表
		* @param $user_id	用户id
		* @param $state		预约的状态
		*/
		public function get_by_user_id($user_id, $state, $next_id, $count) {
			$appointmentTable = new AppointmentTable();
			return $appointmentTable->get_by_user_less($user_id, $state, $next_id, $count);
		}
		
		public function get_count_by_user_less($user_id, $state) {
			$appointmentTable = new AppointmentTable();
			return $appointmentTable->get_count_by_user_less($user_id, $state);
		}
		
		/**
		* 取指定用户的预约信息
		* @param $user_id	用户id
		* @param $state		预约状态
		*/
		public function get_by_user($user_id, $state, $next_id, $count) {
			$appointmentTable = new AppointmentTable();
			return $appointmentTable->get_by_user($user_id, $state, $next_id, $count);
		}
		
		/**
		* 查询指定用户的预约条数
		* @param $user_id	用户id 
		* @param $state 	预约状态
		*/
		public function get_count_by_user($user_id, $state) {
			$appointmentTable = new AppointmentTable();
			return $appointmentTable->get_count_by_user($user_id, $state);
		}
		
		// 查询所有的预约信息
		public function get_all($next_id, $count) {
			$appointmentTable = new AppointmentTable();
			$appoint_list = $appointmentTable->get_all($next_id, $count);
			$activityTable = new ActivityTable();
			foreach($appoint_list as $appoint) {
				$activity = $activityTable->get_by_id($appoint->activity->id);
				$appoint->activity = $activity;
			}
			return $appoint_list;
		}
		
		// 查询所有预约的条数
		public function get_count() {
			$appointmentTable = new AppointmentTable();
			return $appointmentTable->get_count();
		}
		
		// 根据appoint_id 修改state值
		public function update_appoint($appoint_id, $state) {
			$appointmentTable = new AppointmentTable();
			return $appointmentTable->update_appoint($appoint_id, $state);
		}
		
	}
?>