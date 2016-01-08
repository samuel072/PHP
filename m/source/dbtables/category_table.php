<?php
require_once(ykfile("source/model/category_model.php"));

class CategoryTable extends DB 
{
  public function table_name() {
    return "category";
  }

  public function dbobj_to_model($obj) {
    $category = new CategoryModel();
		$category->id = $obj->id;
		$category->name = $obj->name;
		return $category;
  }
	
  function get_by_id($id){
    $table_name = $this->table_name();
    $sql = "select a.* from $table_name as a where a.id = $id";		
    $category_list = $this->get_list_by_sql($sql);
		return $category_list[0];
  }
	

}
?>