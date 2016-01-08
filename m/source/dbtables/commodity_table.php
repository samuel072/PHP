<?php
require_once(ykfile('source/dbtables/db.php'));
require_once(ykfile('source/model/commodity_model.php'));
	
class CommodityTable extends DB
{
	public function table_name() {
		return 'commodity';
	}

	public function dbobj_to_model($obj) {
		$com = new CommodityModel();
		$com->id = $obj->id;
		$com->name = $obj->name;
		$com->image_path = $obj->image_path;
		$com->seo_alt = $obj->seo_alt;
		$com->link = $obj->link;
		$com->code = $obj->code;
		$com->price = $obj->price;
		$com->summary = $obj->summary;
		$com->city = $obj->city;
		$com->duration = $obj->duration;
		$com->method = $obj->method;
		$com->act_desc = $obj->act_desc;
		$com->count = $obj->count;

		return $com;
	}

	// 取商品
	public function get_commodity($next_id, $count) {
		$table = $this->table_name();
		$sql = "select * from $table limit $next_id, $count";

		return $this->get_list_by_sql($sql);	
	}
	
	//获取所有的礼品数量
	public function get_count() {
		$table_name = $this->table_name();
		$sql = "select count(*) from $table_name";	
		
		$result = mysql_query($sql, $this->conn);
		if(!$result) {
			return 0;
		}else {
			list($num) = mysql_affected_rows($this->conn);
			return $num;
		}
	}
	
	// 把指定商品数量减1
	public function dec_count($com_id) {
		$table = $this->table_name();
		$sql = "update $table set count = count - 1 where id = $com_id";

		$result = mysql_query($sql, $this->conn);
		return $result;
	}
	
	public function save_commodity($commodity) {
		$name = $commodity->name;
        $image_path = $commodity->image_path;
        $link = $commodity->link;
        $code = $commodity->code;
        $price = $commodity->price;
        $city = $commodity->city;
        $duration = $commodity->duration;
        $method = $commodity->method;
        $act_desc = $commodity->act_desc;
        $seo_alt = $commodity->seo_alt;
        $summary = $commodity->summary;
        $count = $commodity->count;	
		
		$sql = "insert into commodity (name, image_path, seo_alt, link, code, price, city,summary, duration, method, act_desc, count) values ('$name', '$image_path', '$seo_alt', '$link', '$code', '$price', '$city', '$summary', '$duration', '$method', '$act_desc', $count)";
		$result = mysql_query($sql, $this->conn);
		if($result) {
			$id = mysql_insert_id($this->conn);
			return $id;
		}else {
			return false;
		}
	}

	public function update_commodity($commodity) {
		$id = $commodity->id;
		$name = $commodity->name;
        $image_path = $commodity->image_path;
        $link = $commodity->link;
        $code = $commodity->code;
        $price = $commodity->price;
        $city = $commodity->city;
        $duration = $commodity->duration;
        $method = $commodity->method;
        $act_desc = $commodity->act_desc;
        $seo_alt = $commodity->seo_alt;
        $summary = $commodity->summary;
        $count = $commodity->count;
		
		$sql = "update commodity set name = '$name', image_path = '$image_path', seo_alt = '$seo_alt', link = '$link', code = '$code', price = '$price', city = '$city', summary = '$summary', duration = '$duration', method = '$method', act_desc = '$act_desc', count = $count where id = $id";

		$result = mysql_query($sql, $this->conn);
		
		$rows = mysql_affected_rows($this->conn);
		if($rows>0) {
			return true;
		}else {
			return false;
		}
		
	}

	public function is_remove($id, $is_delete) {
		$sql = "update commodity set is_delete = $is_delete where id = $id";
		mysql_query($sql, $this->conn);
		if(mysql_affected_rows($this->conn) > 0) {
			return true;
		}else {
			return false;
		}
	}

}

?>
