<?php

require_once(ykfile('source/search_service.php'));

$service = new SearchService();
$words = $service->get_words();

echo json_encode(array(
	"hotwords" => $words
));

?>
