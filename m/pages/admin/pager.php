<div class="pager">
  <a href="" class="pg_cur"><?php echo $page_cur; ?>/<?php echo $page_count; ?>页</a>
	
  <?php
  if($page_cur > 1) {
    echo "<a class=\"pg_last\" href=\"$page_prefix&next_id=0&count=$count\">首页</a>";
    echo "<a class=\"pg_next\" href=\"$page_prefix&next_id=$up_id&count=$count\">上一页</a>";	
  }
	
  for($p = 1; $p < $page_count + 1; $p ++) {
    if($p == $page_cur) {
      echo "<strong>$page_cur</strong>";
    } /*else {
      $start = ($p - 1) * $count;
      echo "<a href=\"$page_prefix&next_id=$start&count=$count\">$p</a>";
    }*/
  }

  if($page_cur < $page_count) {
    $start = ($page_count - 1) * $count;
    echo "<a class=\"pg_last\" href=\"$page_prefix&next_id=$start&count=$count\">末页</a>";
    echo "<a class=\"pg_next\" href=\"$page_prefix&next_id=$next_id&count=$count\">下一页</a>";
  }
	
  echo "　跳到<select name='topage' size='1' onchange='window.location=this.value'>\n"; 
  for($i=1;$i<=$page_count;$i++){ 
		/*if($i==$page_cur) {
			echo "<option value='$page_prefix&next_id=$start&count=$count' selected>$i</option>\n"; 
		}else {
			$echo "<option value='$page_prefix&next_id=$start&count=$count'>$i</option>\n"; 
		}*/
    $start = ($i - 1) * $count;
    echo "<option value='$page_prefix&next_id=$start&count=$count' selected>$i</selected>";
  } 
  ?>
</div>
