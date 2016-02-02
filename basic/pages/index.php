<html>
	<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>userInfo</title>
        <link rel="stylesheet" href="/basic/pages/css/common.css">
        <link rel="stylesheet" href="/basic/pages/css/index.css">
        <script type="text/javascript" src="/basic/pages/js/jquery-1.9.js"></script>
        <script type="text/javascript" src="/basic/pages/js/layer.js"></script>
        <!--<link rel="stylesheet" href="css/bootstrap.css">-->
        <style type="text/css">
            .login_form{
                width: 300px;
                height: 150px;
                background: #e9e9e9;
            }
            .login_form p{
                height: 45px;
                width: 100%;
                line-height: 45px;
            }
        </style>
	</head>
	<body>
        <!-- 头部 start -->
        <div class="container">
            <div class="head"><span><a href="#" class="register">注册</a><a href="#">登录</a></span></div>
            <div class="nav">
                <li><a href="#">主页</a></li>
                <li><a href="#">博客</a></li>
                <!--<li><a href="#"></a></li>
                <li><a href="#">PHP</a></li>-->

            </div>
        </div>
        <!-- 头部 end -->
        <div class="content">
            <ul class="con_head">
                <li><h2>用户信息列表</h2></li>
            </ul>
            <ul class="con_title">
                <li class="width_10">编号</li>
                <li class="width_10">姓名</li>
                <li class="width_20">头像</li>
                <li class="width_10">年龄</li>
                <li class="width_10">性别</li>
                <li class="width_30">登录时间</li>
                <li class="width_10 del_right_border">登录ip</li>
            </ul>
            <ul class="con_content">
				<?php $i; foreach($userList as $user) { $i++ ; ?>
                <li class="width_10"><?php echo $i; ?></li>
                <li class="width_10"><?php echo $user['user_name']; ?></li>
                <li class="width_20"><img src="<?php echo $user['avatar']; ?>"></li>
                <li class="width_10"><?php echo $user['age']; ?></li>
                <li class="width_10"><?php if($user['sex'] == 0){ echo '女';}else {echo '男';} ?></li>
                <li class="width_30"><?php  echo $user['time']; ?></li>
                <li class="width_10 del_right_border"><?php echo $user['login_ip']; ?></li>
				<?php } ?>
            </ul>

        </div>

        <!-- login start -->
        <div class="login_form">
            <form action="/basic/index.php?c=user">
                <p>
                    <span class="width_10">用户名:</span>
                    <span><input name="userName" type="text"/></span>
                </p>

                <p>
                    <span class="width_10">密码:</span>
                    <span><input name="password" type="password" /></span>
                </p>

                <input type="submit" value="login  now"/>
            </form>
        </div>
        <!-- login end-->

        <!-- register end-->
        <div class="reg_form">


        </div>
        <!-- register end-->
	</body>
    <script type="text/javascript">
//        $(".register").click(function() {
//            layer.open({
//                type: 1,
//                skin: "layui-layer-demo",
//                shift: 2,
//                shareClose: false,
//                content: "<div><h2>this is my register input</h2></div>",
//
//            });
//
//        });

        // 获取页面的某个元素 显示出来
        $(".register").click(function (){
            layer.open({
                type: 1,
                shade: false,
                title: false, //不显示标题
                content: $('.login_form'), //捕获的元素
                cancel: function(index){
                    layer.close(index);
                    this.content.show();
                    layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', {time: 5000, icon:6});
                }
            });

        });
    </script>
</html>
