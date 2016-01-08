<?php

$keywords = $_GET['keywords'];
$next_id = intval($_GET['next_id']);
if($next_id < 0) {
	$next_id = 0;
}
$count = intval($_GET['count']);
if($count <= 0) {
	$count = 10;
}

$service = new SearchService();
$acts = $service->search_activity($keywords, $next_id, $count);

echo json_encode(array(
    "total" => count($acts),
    "result" => $acts
));

?>
