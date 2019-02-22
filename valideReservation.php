<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

$trajet = new App\Trajet($_POST["start"],$_POST["end"],$_POST["price"],$_SESSION['id'],date('Y-m-d G:i:s'));
$trajet->addTrajetStart($bdd,'INSERT INTO `trajet` (`idClient`, `debut`, `fin`, `prixTrajet`, `heureDebut`,`heureFin`,`dateTrajet`,`distanceTrajet`) VALUES (:idClient,:debut,:fin,:prixTrajet,:heureDebut,:heureFin,:dateTrajet,:distanceTrajet)',$trajet);
$trajet->startSessionId($bdd); //add idTrajet in SESSION

echo $_SESSION["idTrajet"];
$data=$bdd->query('SELECT * FROM abonnement WHERE idClient='.$_SESSION['id'].'');

if (!empty($data)) {
  echo "found";
  var_dump($data);
  header("location: resevationChooseService.php");
}else{
  echo "not found";
  header("location: resevationChooseDriver.php");
}
 ?>
