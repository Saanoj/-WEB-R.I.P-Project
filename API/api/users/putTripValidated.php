<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../utils/DatabaseManager.php';
require_once __DIR__ . '/../../services/TrajetService.php';

$collab = TrajetService::getInstance()->setTripValidated($_GET["idTrajet"]);
echo '{"id":'.$_GET["idTrajet"].',"isValidated":1}';

 ?>
