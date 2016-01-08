<?php
require_once('config.php');
require_once('source/portal_service.php');

header('Content-type: text/html; charset=utf-8');

$porsrv = new PortalService();
$channels = $porsrv->get_portal_content();

include(ykfile("pages/index.php"));
?>
