<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');


$timeStart = $_POST["dateDebut"]." ".$_POST["heureDebut"];
echo $timeStart;
$timestampStart = strtotime($timeStart);
echo "<br>".$timestampStart;

$start = str_replace(' ',"%20",$_POST["start"]);
$end = str_replace(' ',"%20",$_POST["end"]);
$start = str_replace(',',"",$start);
$end = str_replace(',',"",$end);

echo "<br>".$start;
echo "<br>".$end;

$apiReturn = App\Trajet::getDistanceTime($start, $end);

$estimatedTime=60*$apiReturn["time"]; //temps estimé de 34 minutes
$timestampEnd = $timestampStart+$estimatedTime;
$dateFin = gmdate('Y-m-d G:i:s', $timestampEnd);

$trajet = new App\Trajet($_POST["start"],$_POST["end"],0,$_SESSION['id'],date('Y-m-d G:i:s'),$timeStart,$dateFin,$apiReturn["distance"],$apiReturn["time"]);
$trajet->addTrajetStart($bdd,'INSERT INTO `trajet` (`idClient`, `debut`, `fin`, `prixTrajet`, `heureDebut`,`heureFin`,`dateResevation`,`distanceTrajet`) VALUES (:idClient,:debut,:fin,:prixTrajet,:dateDebut,:dateFin,:dateReservation,:distanceTrajet)',$trajet);
$trajet->startSessionId($bdd); //add idTrajet in SESSION
echo "<br> temps trajet: ".$trajet->getTimeTrajet();

echo "<br>";
echo "id trajet: ".$_SESSION["idTrajet"];
echo "<br>";
echo "id: ".$_SESSION["id"];


$_SESSION['trajet'] = serialize($trajet);

$data=$bdd->query('SELECT * FROM abonnement WHERE idClient='.$_SESSION['id'].'');
if (!empty($data)) {
  echo "found";

  header("location: resevationChooseService.php");
}else{
  echo "not found";
  header("location: resevationChooseDriver.php");
}
 ?>
