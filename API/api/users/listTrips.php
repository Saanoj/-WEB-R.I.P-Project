<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../utils/DatabaseManager.php';
require_once __DIR__ . '/../../services/TrajetService.php';

  $trips = TrajetService::getInstance()->allTripsToValidate($_GET['idCollaborateur']);
  echo json_encode($trips);

 ?>
