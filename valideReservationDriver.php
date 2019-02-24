<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');


App\Trajet::addDriverToTrajet($bdd,'UPDATE trajet SET idChauffeur = :idChauffeur WHERE idTrajet = :idTrajet',$_POST["idChauffeur"]);

header("location: reservationDevis.php");
?>
