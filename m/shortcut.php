<?php
//  创建桌面快捷方式 
//  IconFile=http://yikeyanjiang.com/favicon.ico // 桌面图标文件路径 绝对路径
$Shortcut = "[InternetShortcut]
URL=http://www.yikeyanjiang.com
IDList=
[{000214A0-0000-0000-000000000046}]
IconFile=http://yikeyanjiang.com/favicon.ico // 桌面图标文件路径 绝对路径
IconIndex=1
Prop3=19,2";
header("Content-type: application/octet-stream");
header("Content-Disposition:attachment;filename=一刻演讲.url;");

echo $Shortcut;

?>
