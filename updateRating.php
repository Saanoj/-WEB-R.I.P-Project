<?php

require_once __DIR__ . '/API/utils/DatabaseManager.php';
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

$bdd2 = DatabaseManager::getDatabase();

session_start();


$trip = $bdd->queryOne('SELECT * FROM trajet WHERE idTrajet = '.$_POST["idTrajet"].'');

if ($trip["hasVoted"] == 0) {

  $arrayCollab = [];

  //push chauffeur
  $chauffeur = $bdd->queryOne('SELECT * FROM collaborateurs WHERE idCollaborateurs = '.$trip["idChauffeur"].'');
  array_push($arrayCollab,$chauffeur);


  //push autres collabs
  $collabsId = $bdd->query('SELECT idAnnexe FROM linkservicetrajet WHERE idTrajet = '.$_POST["idTrajet"].'');
  foreach ($collabsId as $id) {
    $collab = $bdd->queryOne('SELECT * FROM collaborateurs WHERE idCollaborateurs = '.$id["idAnnexe"].'');
    array_push($arrayCollab,$collab);
  }


  //ajouter vote de
  foreach ($arrayCollab as $collab) {
    echo "\n".$collab["ratingNumber"]." ".$collab["rating"];
    if ($collab["ratingNumber"] != 0) {
      $totalRating = $collab["ratingNumber"] * $collab["rating"] + $_POST["rating"];
      $finalAverageRating = sprintf("%.2f", $totalRating / ( $collab["ratingNumber"] + 1));
      $newNumber = ( $collab["ratingNumber"] + 1);
    } else {
      $finalAverageRating = $_POST["rating"];
      $newNumber = 1;
    }




    $bdd2->exec("UPDATE collaborateurs SET rating = ? , ratingNumber = ? WHERE idCollaborateurs = ".$collab['idCollaborateurs']."", [$finalAverageRating,$newNumber]);

    echo "\nvote ".$_POST["rating"]." pour ".$collab["first_name"]." ".$collab["last_name"]." qui était votre ".$collab["metier"]." ".$finalAverageRating;
  }

  $bdd->exec('UPDATE trajet SET hasVoted = 1 WHERE idTrajet = '.$_POST["idTrajet"].'');

} else {
  echo "Vous avez déja voté";
}



?>
