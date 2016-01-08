<html>
<head>

  <script type="text/javascript" src="/m/pages/js/jquery-1.11.1.min.js" ></script>
  <script type="text/javascript" src="/m/pages/js/jquery.json.js" ></script>
  <script type="text/javascript" src="http://qzonestyle.gtimg.cn/qzone/openapi/qc_loader.js" data-appid="101208123" data-redirecturi="http://www.yikeyanjiang.com/m/qqlogin.php" charset="utf-8"></script>

  <script type="text/javascript">
    var openid, nickname, gender, avatar;

    function login_with_qq() {
      var json_array = {
        "openid": openid,
        "nickname": nickname,
        "gender": gender,
        "avatar": avatar
      };

      var json_data = $.toJSON(json_array);
      $.ajax({
        url:"/m/api/user.php?mod=qqlogin",
        type:"post",
        data:json_data,
        dataType:"json",
        contentType:"application/json",
        success:function(data) {
          if(data.status != 0) {
            alert(data.message);
          } else {
            refer = "<?php echo $_GET['redirecturl']; ?>"
            if(refer.length <= 0) {
              refer = "/m/user.php";
            }
            window.location.href = refer;
          }
        },
        error:function(xhr, msg, obj) {
          alert(msg);
        }
      });
    }

    QC.Login.getMe(function(openId, accessToken) {
      openid = openId;
      access_token = accessToken;

      get_user_info();
    });

    function get_user_info() {
      var paras = { };
      QC.api("get_user_info", paras)
      //指定接口访问成功的接收函数，s为成功返回Response对象
      .success(function(s) {
        //成功回调，通过s.data获取OpenAPI的返回数据
        if(s.data.ret != 0) {
          alert(s.data.msg);
        } else {
          nickname = s.data.nickname;
          gender = s.data.gender;
          avatar = s.data.figureurl_qq_1;
          login_with_qq();
        }
      })
      //指定接口访问失败的接收函数，f为失败返回Response对象
      .error(function(f) {
        //失败回调
        alert("获取用户信息失败！");
      })
      //指定接口完成请求后的接收函数，c为完成请求返回Response对象
      .complete(function(c) {
      });
    }
  </script>

</head>
</html>
