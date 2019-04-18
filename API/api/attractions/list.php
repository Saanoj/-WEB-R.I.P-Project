<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../services/AttractionService.php';

$attractions = AttractionService::getInstance()->allAttractions();
echo json_encode($attractions);

 ?>
