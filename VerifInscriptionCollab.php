<?php
namespace App;
use \PDO;


require_once __DIR__ .'/require_class.php';

$bdd = new Database('rip');
session_start();

$_SESSION["infoCollab"]=array('metier' => $_POST['metier'], 'ville' => $_POST['ville']);

var_dump($_SESSION["infoCollab"]);

switch($_POST["metier"]){
  case "chauffeur":
    header("location: inscriptionCollabChauffeur.php");
    break;
  case "interprete":
    header("location: inscriptionCollabInterprete.php");
    break;
  case "coachSportif":
    header("location: inscriptionCollabCoachSportif.php");
    break;
  case "coachCulture":
    header("location: inscriptionCollabCoachCulture.php");
    break;
  }
?>
