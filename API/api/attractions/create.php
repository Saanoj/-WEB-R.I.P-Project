<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../../utils/FieldValidator.php';
require_once __DIR__ . '/../../services/AttractionService.php';

$contents = file_get_contents('php://input');
$json = json_decode($contents, true);

if (FieldValidator::validate($json , ['name', 'capacity', 'minHeight', 'duration'])) {
  $attraction = new Attraction(NULL,$json['name'],$json['duration'],$json['capacity'],$json['minHeight']);

  $new = AttractionService::getInstance()->insert($attraction);
  if ($new) {
    http_response_code(201);
    echo json_encode($new);
  } else {
    http_response_code(500);
  }
} else {
  http_response_code(400);
}


 ?>
