<?php
require_once __DIR__ . '/../utils/DatabaseManager.php';
require_once __DIR__ . '/../models/Trajet.php';

class TrajetService {

  private static $instance;

  private function __construct() {

  }

  public static function getInstance(): TrajetService {
    if(!isset(TrajetService::$instance)){
      TrajetService::$instance = new TrajetService();
    }
    return TrajetService::$instance;
  }

  public function allTripsToValidate(int $idChauffeur): array{
    $db = DatabaseManager::getDatabase();
    $list = $db->getALL('SELECT * FROM Trajet WHERE stateDriver = 0 AND idChauffeur = ? ORDER BY heureDebut',[$idChauffeur]);

    return $list;
  }

  public function allTripsValidated(int $idChauffeur): array{
    $db = DatabaseManager::getDatabase();
    $list = $db->getALL('SELECT * FROM Trajet WHERE stateDriver = 1 AND idChauffeur = ? ORDER BY heureDebut',[$idChauffeur]);

    return $list;
  }

  public function deleteTrip(int $idTrip): int{
    $db = DatabaseManager::getDatabase();
    $list = $db->exec('DELETE FROM Trajet WHERE idTrajet = ?',[$idTrip]);

    return $list;
  }

  public function setTripValidated(int $idTrip): int{
    $db = DatabaseManager::getDatabase();
    $list = $db->exec('UPDATE Trajet SET stateDriver = 1 WHERE idTrajet = ?',[$idTrip]);

    return $list;
  }
}
?>
