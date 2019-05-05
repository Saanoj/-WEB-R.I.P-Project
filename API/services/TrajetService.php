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
    $list = $db->getALL('SELECT * FROM trajet WHERE stateDriver = 0 AND idChauffeur = ? AND state = "Attente Collab" ORDER BY heureDebut',[$idCollaborateur]);

    //if not a driver
    if (empty($list)) {
        $listLink = $db->getALL('SELECT idTrajet FROM linkservicetrajet WHERE (idService=11 OR idService=12 OR idService=13) AND idAnnexe = ? AND statut=0',[$idCollaborateur]);
        //print_r($listLink);

        $list2 = array();
        foreach ($listLink as $key => $idTrajet) {
          $trip = $db->findOne('SELECT * FROM trajet WHERE idTrajet = ? AND state = "Attente Collab" ',[$idTrajet["idTrajet"]]);
          array_push($list2,$trip);
        }
        return $list2;
    }
    return $list;

  }

  public function allTripsValidated(int $idCollaborateur): array{
    $db = DatabaseManager::getDatabase();
    $list = $db->getALL('SELECT * FROM trajet WHERE stateDriver = 1 AND idChauffeur = ? AND (state = "Attente Collab" OR state = "Pas Commencé") ORDER BY heureDebut',[$idCollaborateur]);

    $returnList = array();
    foreach ($list as $trip) {

      if (time() > strtotime($trip["heureDebut"])) {
        $trip["aboveStartTime"]="1";
      } else {
        $trip["aboveStartTime"]="0";
      }
      array_push($returnList,$trip);
    }

    //if not a driver
    if (empty($list)) {
        $listLink = $db->getALL('SELECT idTrajet FROM linkservicetrajet WHERE (idService=11 OR idService=12 OR idService=13) AND idAnnexe = ? AND statut=1',[$idCollaborateur]);
        //print_r($listLink);

        $list2 = array();
        foreach ($listLink as $key => $idTrajet) {
          $trip = $db->findOne('SELECT * FROM trajet WHERE idTrajet = ? ',[$idTrajet["idTrajet"]]);
          if($trip["state"] == "Attente Collab" || $trip["state"] == "Pas commencé"){

              if (time() > strtotime($trip["heureDebut"])) {
                $trip["aboveStartTime"]="1";
              } else {
                $trip["aboveStartTime"]="0";
              }
              array_push($list2,$trip);
          }

        }
        return $list2;
    }
    return $returnList;
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
          $trip = $db->findOne('SELECT * FROM trajet WHERE idTrajet = ? ',[$idTrajet["idTrajet"]]);
          if($trip["state"] == "Finis"){
              array_push($list2,$trip);
          }
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

    if($this->checkAllCollabValidated($idTrip)){
      $db->exec('UPDATE trajet SET state = "Pas commencé" WHERE idTrajet = ? ',[$idTrip]);
    }
    return 1;
  }

  public function checkAllCollabValidated(int $idTrip): bool{
    $db = DatabaseManager::getDatabase();

    //check si chauffeur est ok
    $driver = $db->getALL('SELECT stateDriver FROM trajet WHERE idTrajet = ?',[$idTrip]);
    if ($driver[0]["stateDriver"] == 0) {
      return false;
    }

    //check si tous les collab autre que chauffeurs sont ok
    for ($i=11; $i < 14 ; $i++) {
      $result = $db->getALL('SELECT statut FROM linkServicetrajet WHERE idTrajet = ? AND idService = ?',[$idTrip,$i]);
      if(!empty($result)){
          if ($result[0]["statut"] == 0) {
            return false;
          }
      }
    }
    return true;
  }

  public function setTripFinished(int $idTrip): int{
    $db = DatabaseManager::getDatabase();
    $list = $db->exec('UPDATE trajet SET state = "Finis" WHERE idTrajet = ?',[$idTrip]);

    return $list;
  }
}
?>
