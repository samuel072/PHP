<?php
 /**
 *	MYSQL 的封装
 **/
require_once(zeroPath('/common/config.php'));
class Mysql{
	private $host; 			// 数据库服务器的ip地址
	private $username;		// 数据库的用户名称
	private $password;		// 数据库的用户密码
	private $dbname;		// 数据库的名称
	private $conn;			// 连接数据库的句柄

	function __construct($host = DB_HOST, $username = DB_USER_NAME, $password = DB_PASSWORD, $dbname = DB_NAME) {
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;
		$this->dbname = $dbname;
		// echo $this->host." ,". $this->password." ,". $this->password;
		// $this->conn = mysql_connect($this->host, $this->password, $this->password, true);
		$this->conn = mysql_pconnect($this->host, $this->password, $this->password, true);

		if(!$this->conn) {
			if(file_exists("/tmp/log/zero_php.log")) {
				fopen("/tmp/log/zero_php.log", "w");
			}
			die(file_put_contents("/tmp/log/zero_php.log", "数据库连接失败".mysql_error(), FILE_APPEND));
		}

		mysql_select_db($this->dbname);
		mysql_query("SET CHARACTER SET utf8", $this->conn);
		mysql_query("set names 'utf8'", $this->conn);
	}

	function adu($sql = "") {
		$result = mysql_query($sql, $this->conn);
		if($result) {
			return mysql_insert_id($this->conn);
		}else {
			return false;
		}
	}
}
 $db = new Mysql();
?>