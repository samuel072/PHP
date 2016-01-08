<?php
  // 给一刻app专用的视频详细接口
  $id = intval($_GET['id']);
  
  file_put_contents("/tmp/yike.log", "---id ==".$id."\n", FILE_APPEND); 

  if($id){
    $url = "http://10.172.222.187/service/video_detail.php?id=$id";
    $header = array(
      "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
      "Accept-Encoding:gzip,deflate",
      "Accept-Language:zh-CN,zh;q=0.8,en-US;q=0.5,en;q=0.3",
      "Connection:keep-alive",
      "Host:localhost"
    );

    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header); // 设置头部信息
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
   
    // 返回的数据是$data
    return $data;
  }  

?>
