<?php
require_once(ykfile("source/dbtables/section_table.php"));

class SectionModule
{
	
public function save_video($section){
	$sectTab = new SectionTable();
	return $sectTab->insert_section($section);
}

public function update_video($section){
	$sectTab = new SectionTable();
	return $sectTab->update_section($section);
}
	
}
?>