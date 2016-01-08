<ul class="header account_header">
  <li class="h_nav">
    <a href="javascript:history.go(-1);" id="h_nav"><img src="/m/pages/images/ico03.png" class="ico01"></a>
  </li>

  <li class="h_title_type account_header_font"><p><?php echo $page_title; ?></p></li>
  <?php if($page_title_right) { ?>
  <li class="h_title_right_text account_header_font">
    <a href="<?php echo $header_link_right; ?>"><?php echo $page_title_right; ?></a>
  </li>
  <?php } ?>
</ul>

