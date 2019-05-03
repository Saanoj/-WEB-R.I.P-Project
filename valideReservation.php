<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

// VERIFICATION DE LA DATE DU TRAJET : IL DOIT ETRE SUPERIEUR A LA DATE DU JOUR
$timeStart = $_POST["dateDebut"]." ".$_POST["heureDebut"];
$dateTrajet = new DateTime($timeStart, new DateTimeZone('Europe/Paris'));
$dateNow = new DateTime("now", new DateTimeZone('Europe/Paris'));
$interval = $dateTrajet->diff($dateNow);

if ($interval->format('%R') == "-")
{
  if($interval->format('%i') > 0 || $interval->format('%S') > 0 || $interval->format('%H') > 0 || $interval->format('%D') > 0|| $interval->format('%M') > 0 || $interval->format('%Y') > 0)
  {



$timestampStart = strtotime($timeStart);

$start = str_replace(' ',"%20",$_POST["start"]);
$end = str_replace(' ',"%20",$_POST["end"]);
$start = str_replace(',',"",$start);
$end = str_replace(',',"",$end);


$apiReturn = App\Trajet::getDistanceTime($start, $end);

$estimatedTime=60*$apiReturn["time"];

$timestampEnd = $timestampStart+$estimatedTime;

$dateFin = getEstimateTime($bdd,$apiReturn,$timeStart);




$trajet = new App\Trajet($_POST["start"],$_POST["end"],0,$_SESSION['id'],date('Y-m-d G:i:s'),$timeStart,$dateFin,$apiReturn["distance"],$apiReturn["time"],"Attente Collab");
$idTrajet = $trajet->addTrajetStart($bdd,'INSERT INTO `trajet` (`idClient`, `debut`, `fin`, `prixTrajet`, `heureDebut`,`heureFin`,`dateResevation`,`distanceTrajet`,`duration`,`state`) VALUES (:idClient,:debut,:fin,:prixTrajet,:dateDebut,:dateFin,:dateReservation,:distanceTrajet,:duration,:state)',$trajet);
$trajet->startSessionId($bdd); //add idTrajet in SESSION

$_SESSION['trajet'] = serialize($trajet);
$_SESSION['timeStart'] = $timeStart;


$data=$bdd->query('SELECT * FROM linkabonnemententreprise WHERE idClient='.$_SESSION['id'].'');
if (!empty($data)) {

  header("location: resevationChooseService.php");
}else{
   header("location: resevationChooseDriver.php");
}
  }
  else {
    header('location:ReservationTrajet.php');
  }
}
else {
  header('location:ReservationTrajet.php');

}



function getEstimateTime($bdd,$apiReturn,$timeStart) {
  $hour = explode("hours",$apiReturn['time']);
  $minutes = explode("mins",$hour[1]);
  $arrayEstimate = array("heures" => $hour[0],"minutes" => $minutes[0]);

  $arrayEstimate["heures"] = intval($arrayEstimate["heures"]);
  $arrayEstimate["minutes"] = intval($arrayEstimate["minutes"]);
  $dateFin = new DateTime($timeStart, new DateTimeZone('Europe/Paris'));
  $heureDebutTrajet = convertDate($bdd,$timeStart);
  $dateFin->setTime($arrayEstimate['heures']+$heureDebutTrajet,$arrayEstimate['minutes']);
  $_SESSION['finTrajet'] = $dateFin->format('Y-m-d H:i');
  return $dateFin->format('Y-m-d H:i');

}

function convertDate($bdd,$timeStart) {
  $timeStart = explode(" ",$timeStart);
  $res = explode(":",$timeStart[1]);
  $heureDebutTrajet = intval($res[0]);
  return $heureDebutTrajet;
}
