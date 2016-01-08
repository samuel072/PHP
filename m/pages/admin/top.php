<?php
session_start();
require_once('../../config.php');
require_once(ykfile('source/model/user_model.php'));
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>

  <link rel="stylesheet" href="/m/pages/css/top.css"/>

  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="/m/pages/js/jquery.json.js"></script>
  <script type="text/javascript">
    function logout() {
      $.ajax({
        url:"/m/api/user.php?mod=signout",
        type:"get",
        dataType:"json",
        success:function(data) {
          console.log('ok');
          if(data.status == 0) {
            parent.location.href="/m/admin.php";
          } else {
            alert(data.message);
          }
        }
      });
    }
  </script>
</head>

<body>
  
  <div class="top">
	<div>
  	欢迎：<?php 
  		if (!empty($_SESSION['current_user'])){
            $usermodel = unserialize($_SESSION['current_user']);
			echo $usermodel->name;
  		}else {
			echo "chaxun ";
		}
  	
  	?>
  </div>
    <button type="button" id="btn_logout" class="btn_logout" onclick="logout()">退出</button>
  </div>
</body>

</html>
