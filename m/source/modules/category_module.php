<?php
require_once(ykfile("source/dbtables/category_table.php"));

class CategoryModule
{
  function get_by_id($id){
    $cateTab = new CategoryTable();
    return $cateTab->get_by_id($id);	
  }
	
	
	
}
?>