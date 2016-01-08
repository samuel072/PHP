<?php

require_once('../config.php');
require_once(ykfile('source/activity_service.php'));

// 用于每天晚天后台运行，及时的把已经过期了的预告信息，从预告中移除

$actsrv = new ActivityService();
while ($actsrv->update_channel(10)) {
}

echo "预告移除完成：" .  date('Y-m-d H:i:s') . "\n";

?>
