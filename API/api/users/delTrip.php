<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../utils/DatabaseManager.php';
require_once __DIR__ . '/../../services/TrajetService.php';

$trip = TrajetService::getInstance()->deleteTrip($_GET["idTrajet"]);
echo '{"id":'.$_GET["idTrajet"].',"isDeleted":1}'

 ?>
