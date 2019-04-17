<?php
require_once __DIR__ . '/../utils/DatabaseManager.php';
require_once __DIR__ . '/../models/Attraction.php';

class AttractionService {

  private static $instance;

  private function __construct() {

  }

  public static function getInstance(): AttractionService {
    if(!isset(AttractionService::$instance)){
      AttractionService::$instance = new AttractionService();
    }
    return AttractionService::$instance;
  }

  public function insert(Attraction $attraction): ?Attraction {
    $db = DatabaseManager::getDatabase();
    $affectedRows = $db->exec('INSERT INTO Attraction (name, capacity, min_height, duration) VALUES (?, ?, ?, ?) ', [$attraction->getName(),$attraction->getCapacity(),$attraction->getMinHeight(),$attraction->getDuration()]);
    if ($affectedRows > 0) {
      $attraction->setId(intval($db->lastInsertId()));
      return $attraction;
    }
    return NULL;
  }

  public function allAttractions(): array{
    $db = DatabaseManager::getDatabase();
    $list = $db->getALL('SELECT * FROM Attraction');
    $attraction = [];
    foreach ($list as $data) {
      $attraction[] = Attraction::AttractionFromArray($data);
    }
    return $attraction;
  }
}
?>
