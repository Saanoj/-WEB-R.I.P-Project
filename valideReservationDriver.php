<?php
session_start();
require_once __DIR__ .'/require_class.php';

$bdd = new App\Database('rip');


App\Trajet::addDriverToTrajet($bdd,'UPDATE trajet SET idChauffeur = :idChauffeur WHERE idTrajet = :idTrajet',$_POST["idChauffeur"]);

header("location: reservationDevis.php");
?>
