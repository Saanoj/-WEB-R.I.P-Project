<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../utils/DatabaseManager.php';
require_once __DIR__ . '/../../services/TrajetService.php';

  $trips = TrajetService::getInstance()->allTripsValidated($_GET['idChauffeur']);
  echo json_encode($trips);

 ?>
