<?php
	require_once(ykfile("source/model/check_code_model.php"));
	class CheckCodeTable extends DB {
		
		public function table_name() {
			return "check_code";
		}

		// 把数据库对像，转换成模型类对像，DB每个子数必须重载
		public function dbobj_to_model($obj) {
			$checkCodeModel = new CheckCodeModel();
			$checkCodeModel->id = $obj->id;
			$checkCodeModel->mobile = $obj->mobile;
			$checkCodeModel->verify_code = $obj->verify_code;
			return $checkCodeModel;
		}
		
		/*
		* 根据手机号码查询验证码
		* @param $mobile 手机号码
		*/
		public function get_code_by_mobile($mobile,$verify_code){
			if(!empty($verify_code)){
				$sql = "select * from check_code where mobile = '$mobile' and verify_code = ".$verify_code;
			}else{
				$sql = "select * from check_code where mobile = ".$mobile ;
			}
			$code_mobile = $this->get_list_by_sql($sql);
			return empty($code_mobile)?1000:$code_mobile;
		}
		
		/**
		 * 通过手机号码 删除check_code的记录
		 * @param $mobile 手机号码
		 */
		public function del_check_code_by_mobile($mobile){
			return $this->del_By_attr("mobile", $mobile);
		}
		
		/**
		 * 插入电话号码和验证码
		 * @param  $mobile
		 * @param  $verify_code
		 */
		public function add_verify_code($mobile, $verify_code) {
			$sql = "INSERT INTO check_code (id,mobile,verify_code) VALUES (NULL,'$mobile',$verify_code)";
			if(mysql_query($sql, $this->conn)){
				$id = mysql_insert_id($this->conn);
				return $id; 
			}else {
				return false;
			}
		}
	}
?>
