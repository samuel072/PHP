<?php
require_once(ykfile('source/portal_service.php'));
require_once(ykfile('source/talk_service.php'));
require_once(ykfile('source/talker_service.php'));
require_once(ykfile('source/modules/adv_module.php'));
require_once(ykfile('source/activity_service.php'));

$talksrv = new TalkService();
$talks = $talksrv->get_talk_all(NULL, 0, 1000, STAGE_ADMIN);

$actsrv = new ActivityService();
$activities = $actsrv->get_all(NULL, 0, 1000, STAGE_ADMIN);

$talkersrv = new TalkerService();
$talkers = $talkersrv->get_all(0, 1000);

$porsrv = new PortalService();
$channels = $porsrv->get_portal_content();

$advmod = new AdvModule();
$advs = $advmod->get_adv(0, 1000);

$page_title = '编辑首页';

include(ykfile('pages/admin/edit_portal.php'));
?>
