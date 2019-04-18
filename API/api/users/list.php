<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../utils/DatabaseManager.php';
require_once __DIR__ . '/../../services/UserService.php';

$users = UserService::getInstance()->allUsers();
echo json_encode($users);

 ?>
