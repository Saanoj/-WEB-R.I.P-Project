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

  public function allTripsToValidate(int $idCollaborateur): array{
    $db = DatabaseManager::getDatabase();
    $list = $db->getALL('SELECT * FROM trajet WHERE stateDriver = 0 AND idChauffeur = ? ORDER BY heureDebut',[$idCollaborateur]);

    //if not a driver
    if (empty($list)) {
        $listLink = $db->getALL('SELECT idTrajet FROM linkservicetrajet WHERE (idService=11 OR idService=12 OR idService=13) AND idAnnexe = ? AND statut=0',[$idCollaborateur]);
        //print_r($listLink);

        $list2 = array();
        foreach ($listLink as $key => $idTrajet) {
          $trip = $db->findOne('SELECT * FROM trajet WHERE idTrajet = ?',[$idTrajet["idTrajet"]]);
          array_push($list2,$trip);
        }
        return $list2;
    }
    return $list;

  }

  public function allTripsValidated(int $idCollaborateur): array{
    $db = DatabaseManager::getDatabase();
    $list = $db->getALL('SELECT * FROM trajet WHERE stateDriver = 1 AND idChauffeur = ? ORDER BY heureDebut',[$idCollaborateur]);

    //if not a driver
    if (empty($list)) {
        $listLink = $db->getALL('SELECT idTrajet FROM linkservicetrajet WHERE (idService=11 OR idService=12 OR idService=13) AND idAnnexe = ? AND statut=1',[$idCollaborateur]);
        //print_r($listLink);

        $list2 = array();
        foreach ($listLink as $key => $idTrajet) {
          $trip = $db->findOne('SELECT * FROM trajet WHERE idTrajet = ?',[$idTrajet["idTrajet"]]);
          array_push($list2,$trip);
        }
        return $list2;
    }
    return $list;
  }

  public function allTripsOld(int $idCollaborateur): array{
    $db = DatabaseManager::getDatabase();
    $list = $db->getALL('SELECT * FROM trajet WHERE state = "Finis"  AND idChauffeur = ? ORDER BY heureDebut',[$idCollaborateur]);

    //if not a driver
    if (empty($list)) {
        $listLink = $db->getALL('SELECT idTrajet FROM linkservicetrajet WHERE (idService=11 OR idService=12 OR idService=13) AND idAnnexe = ? AND statut=1',[$idCollaborateur]);
        //print_r($listLink);

        $list2 = array();
        foreach ($listLink as $key => $idTrajet) {
          $trip = $db->findOne('SELECT * FROM trajet WHERE idTrajet = ? AND state = "Finis" ',[$idTrajet["idTrajet"]]);
          array_push($list2,$trip);
        }
        return $list2;
    }
    return $list;
  }

  public function deleteTrip(int $idTrip): int{
    $db = DatabaseManager::getDatabase();
    $list = $db->exec('DELETE FROM trajet WHERE idTrajet = ?',[$idTrip]);

    return $list;
  }

  public function setTripValidated(int $idTrip, string $metier, int $idCollab): int{
    $db = DatabaseManager::getDatabase();
    switch ($metier) {
      case 'chauffeur':
        $list = $db->exec('UPDATE trajet SET stateDriver = 1 WHERE idTrajet = ?',[$idTrip]);
        break;
      case 'interprete':
        $list = $db->exec('UPDATE linkservicetrajet SET statut = 1 WHERE idTrajet = ? AND idService = 11 AND idAnnexe = ?',[$idTrip,$idCollab]);
        break;
      case 'coachSportif':
        $list = $db->exec('UPDATE linkservicetrajet SET statut = 1 WHERE idTrajet = ? AND idService = 12 AND idAnnexe = ?',[$idTrip,$idCollab]);
        break;
      case 'coachCulture':
        $list = $db->exec('UPDATE linkservicetrajet SET statut = 1 WHERE idTrajet = ? AND idService = 13 AND idAnnexe = ?',[$idTrip,$idCollab]);
        break;
      default:
        $list = -1;
        break;
    }
    return $list;
  }

  public function setTripFinished(int $idTrip): int{
    $db = DatabaseManager::getDatabase();
    $list = $db->exec('UPDATE trajet SET stateDriver = 2 state = "Finis" WHERE idTrajet = ?',[$idTrip]);

    return $list;
  }
}
?>
