<?php
	require_once(ykfile("source/dbtables/config.php"));// 引入配置文件
	require_once(ykfile("err.php"));

	date_default_timezone_set(TIMEZONE);

	/**
	* 类名 ： DB
	* 说明 ： 数据库操作
	*/
	class DB {
		var $host;		//服务器
		var $username;	//数据库用户名
		var $password;	//数据库密码
		var $dbname;		//数据库名称
		var $conn;		//数据库连接变量

		public function __construct($host = DB_HOST, $username = DB_USER, $password = DB_PASSWORD, $dbname = DB_NAME) {
			$this->host = $host;
			$this->username = $username;
			$this->password = $password;
			$this->dbname = $dbname;

			$this->conn = mysql_connect($this->host, $this->username, $this->password, true);
			if(!$this->conn) {
				file_put_contents("/tmp/yike.log", "db connect failed: " . mysql_error() . "\n", FILE_APPEND);
			}
			mysql_select_db($this->dbname, $this->conn);
			mysql_query("SET CHARACTER SET utf8", $this->conn);
			mysql_query("set names 'utf8'", $this->conn);
		}

		public function __destruct() {
		}

		// 表名，DB每个子数必须重载
		public function table_name() {
			return '';
		}

		// 把数据库对像，转换成模型类对像，DB每个子数必须重载
		public function dbobj_to_model($obj) {
		}

		/**
		* 通过sql语句获取数据
		* @return：array
		*/
		public function get_list_by_sql($sql) {
			$result = mysql_query($sql, $this->conn);

			$objList = array();
			if(!$result) {
				file_put_contents("/tmp/yike.log", mysql_error() . "\n", FILE_APPEND);
				return $objList;
			}
				
			while($row = mysql_fetch_object($result)) {
				$objList[] = $this->dbobj_to_model($row);
			}
			return $objList; //对象数组
		}
		
		/**
		* 向数据库表中插入数据
		* @param：$table   表名
		* @param: $columns 包含表中所有的字段名的数据，默认空数组，则是全部有序字段名
		* @param: $values  包含对应所有字段的属性值的数组
		*/
		public function insertData($table, $columns=array(), $values=array()) {
			$sql = 'insert into ' .$table.'(';
			for($i = 0; $i<sizeof($columns);$i++){
				$sql .= $colums[$i];
				if($si<sizeof($columns)-1){
					$sql .= ',';
				}
			}
			$sql .= ')values(';
			for($i = 0; $i<sizeof($values);$i++){
				$sql .= "".$values[$si]."";
				if($i<sizeof($values)-1){
					$sql .= ',';
				}
			}
			$sql .= ')';

			if(mysql_query($sql, $this->conn)) {
				$id = mysql_insert_id($this->conn);
				return $id;
			} else {
				return false;
			}
		}

		/**
		* 通过表中的某一属性获取数据
		* @param: $tableName 表名
		* @param: $atrName   属性名称
		* @param：$atrValue  属性值
		*/
		public function getDataByAtr($atrName, $atrValue) {
			$table = $this->table_name();
			$sql = "select * from $table where $atrName = '$atrValue'";

			@$data = $this->get_list_by_sql($sql);
			if(count($data) != 0) {
				return $data;
			} else {
				return NULL;
			}
		}

		// 根据id属性获取值
		public function get_by_id($cid) {
			$rows = $this->getDataByAtr("id", $cid);

			if(!$rows || count($rows) <= 0) {
				return DB_ERR_NO_DATA;
			}

			return $rows[0];
		}

		/**
		* 通过id 删除，删除表中的记录
		* @param: $tableName   表名
		* @param: $atrName     属性名
		* @param: $atrValue    属性值
		*/
		public function del_by_attr($atrName, $atrValue) {

			@$data = $this->getDataByAtr($atrName, $atrValue);

			if(count($data) != 0){
				$delResult = false;
				$table = $this->table_name();
				$sql = "delete from $table where $atrName = '$atrValue'";
				$result = mysql_query($sql, $this->conn);
				if($result) {
					$delResult = true;
				}
				if($delResult) {
					return true;
				} else {
					return false;
				}
			} else {
				echo "no match data<br/>\n";
			}	
		}
		/**
        * 修改表数据 
        * @param: $postList 提交的变量列表 
		* @param: $where    条件
		* @param: $column   key  value 
        */
		public function update($column = array(), $where = "") {
			$updateValue = "";
			foreach ($column as $key => $value) {
				$updateValue .= $key . "='" . $value . "',";
			}
			$updateValue = substr($updateValue, 0, strlen($updateValue) - 1);
			$table = $this->table_name();
			$sql = "UPDATE $table SET $updateValue";
			$sql .= $where ? " WHERE $where" : null;
			
			mysql_query($sql,$this->conn);
			$rows = mysql_affected_rows($this->conn);
			if($rows != 0){
				return true;//update success
			}else{
				return false;
			}
		}

		public function get_count() {
			$sql = "select count(*) from " . $this->table_name();

			$result = mysql_query($sql, $this->conn);

			if(!$result) {
				return 0;
			}

			list($num) = mysql_fetch_row($result);
			return $num;
		}
	}
?>
