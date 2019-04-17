<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../utils/DatabaseManager.php';
require_once __DIR__ . '/../../services/UserService.php';

$collab = UserService::getInstance()->UserCollab($_GET["id"]);
echo json_encode($collab);

 ?>
