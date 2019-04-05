<?php 
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

checkIfTrajetStarted($bdd);
checkStatusChauffeur($bdd);

function checkIfTrajetStarted($bdd) {

    $date = new DateTime("now", new DateTimeZone('Europe/Paris'));
    $req = $bdd->getPDO()->prepare('SELECT * FROM trajet');
    $req->execute();
    while ($unTrajet = $req->fetch())
   {
    // On convertie la date de début de trajet en DateTime afin de faire les différences.
    $dateTrajetDebut = new DateTime($unTrajet['heureDebut'], new DateTimeZone('Europe/Paris'));
    $interval = $date->diff($dateTrajetDebut);
    // On convertie la date de fin de trajet en DateTime afin de faire les différences.
    $dateTrajetFin = new DateTime($unTrajet['heureFin'], new DateTimeZone('Europe/Paris'));
    $intervalFin = $date->diff($dateTrajetFin);
    
    // Si la date du jour se situe dans l'intervalle de la date du début et la date de fin du trajet :
    if ($interval->format('%R') == "-" && $intervalFin->format('%R') == "+")
    {
    $reqTrajet = $bdd->getPDO()->prepare('UPDATE trajet SET state="En cours" WHERE idTrajet = :idTrajet');
    $reqTrajet->bindValue('idTrajet',$unTrajet['idTrajet']);
    $reqTrajet->execute();
    }
    // Si la date du jours est supérieur a la date de fin et supérieur a la date du début :
    else if ($interval->format('%R') == "-" && $intervalFin->format('%R') == "-") {
    $reqTrajet = $bdd->getPDO()->prepare('UPDATE trajet SET state="Finis" WHERE idTrajet = :idTrajet');
    $reqTrajet->bindValue('idTrajet',$unTrajet['idTrajet']);
    $reqTrajet->execute();
    }
    // Le reste ( donc si la date du jour est inférieur a la date de début et fin de trajet)
    else 
    {
    $reqTrajet = $bdd->getPDO()->prepare('UPDATE trajet SET state="Pas commencé" WHERE idTrajet = :idTrajet');
    $reqTrajet->bindValue('idTrajet',$unTrajet['idTrajet']);
    $reqTrajet->execute();
    }
   }
  }

  function checkStatusChauffeur($bdd) {

    $req = App\Trajet::getStateChauffeur($bdd,"En cours");
    while ($trajet = $req->fetch())
    {
     $reqUpdate = App\Trajet::updateChauffeur($bdd,$trajet['idChauffeur'],1);
    }
    $req->closeCursor();

    $req = App\Trajet::getStateChauffeur($bdd,"Pas commencé");
    while ($trajet = $req->fetch())
    {
     $reqUpdate = App\Trajet::updateChauffeur($bdd,$trajet['idChauffeur'],0);
    }
    $req->closeCursor();

    $req = App\Trajet::getStateChauffeur($bdd,"Finis");
    while ($trajet = $req->fetch())
    {
     $reqUpdate = App\Trajet::updateChauffeur($bdd,$trajet['idChauffeur'],0);
    }
    $req->closeCursor();

    

  }
  
    



    

?>
