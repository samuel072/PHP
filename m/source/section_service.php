<?php
require_once(ykfile("source/modules/section_module.php"));
class SectionService
{
public function save_video($section){
  $sectMod = new SectionModule();
	return $sectMod->save_video($section);
}	
	
}
?>