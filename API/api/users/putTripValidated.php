<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../utils/DatabaseManager.php';
require_once __DIR__ . '/../../services/TrajetService.php';

$ret = TrajetService::getInstance()->setTripValidated($_GET["idTrajet"],$_GET["metier"],$_GET["idCollab"]);
echo '{"id":'.$_GET["idTrajet"].',"isValidated":'.$ret.'}';

 ?>
