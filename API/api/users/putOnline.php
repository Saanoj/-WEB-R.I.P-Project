<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../utils/DatabaseManager.php';
require_once __DIR__ . '/../../services/UserService.php';

$collab = UserService::getInstance()->switchOnline($_GET["id"],$_GET["isOnline"]);
echo '{"id":'.$_GET["id"].',"isOnline":'.$_GET["isOnline"].'}'

 ?>
