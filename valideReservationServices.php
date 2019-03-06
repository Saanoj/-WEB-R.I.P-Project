<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');


//On recuperer la valeur de l'heure du trajet. Il faut que la date du début de l'interprete soit supérieur a la date du trajet . Il faut aussi
// que la date de fin soit supérieur a la date du début
// Enfin, j'ai mis qu'on peux reserver un interprete au maximum pendant 8h ( a modifier si vous voulez)
$hour = $_SESSION['timeStart'];
$res=explode(' ',$hour);
$startInterprete = strtotime($_POST['startInterprete']);
$endInterprete = strtotime($_POST['endInterprete']);
$_SESSION['startInterprete']  = $_POST['startInterprete'];
$_SESSION['endInterprete']  = $_POST['endInterprete'];


// POUR LE COACH SPORTIF CETTE FOIS CI

$startCoachSportif = strtotime($_POST['startCoachSportif']);
$endCoachSportif = strtotime($_POST['endCoachSportif']);
$_SESSION['startCoachSportif']  = $_POST['startCoachSportif'];
$_SESSION['endCoachSportif']  = $_POST['endCoachSportif'];

// Pour le coach culture

$startCoachCulture = strtotime($_POST['startCoachCulture']);
$endCoachCulture = strtotime($_POST['endCoachCulture']);
$_SESSION['startCoachCulture']  = $_POST['startCoachCulture'];
$_SESSION['endCoachCulture']  = $_POST['endCoachCulture'];


// QUELQUES TEST
var_dump(checkInterprete($startInterprete,$endInterprete,$res) == true);
var_dump((isset($_POST['services'])));
var_dump(!empty($_POST['services']));
var_dump(isset($_POST['quantite']));
var_dump((!empty($_POST['quantite'])));


var_dump($_POST['emailContact']);
var_dump($_POST['messageContact']);






//verifications que les variables récupérées ne sont pas vides et existent bien
if (isset($_POST['services']) && (!empty($_POST['services'])) && isset($_POST['quantite']) && (!empty($_POST['quantite'])) && checkInterprete($startInterprete,$endInterprete,$res) == true) {

  $servicesChoisi=$_POST['services'];
  $quantiteCertainService=$_POST['quantite'];

  //on boucle nos services choisis
  foreach ($servicesChoisi as $service) {
    // On recupere la quantite si c'est un service qui a une quantité en foncition de son id
    foreach ($quantiteCertainService as $key => $quantite) {
      if ($key == $service) {
        $thisQuantite=$quantite;
      }
    }

    //affectation de l'id annexe du service si besoin
    switch ($service) {
      case 1:
      $idAnnexe=$_POST["idRestaurant"];
      break;
      case 7:
      $idAnnexe=$_POST["idHotel"];
      break;
      case 8:
      $idAnnexe=$_POST["idBillet"];
      break;
      case 10:
      $idAnnexe=10;
      $thisQuantite=0;
      break;
      case 11:
      $idAnnexe=$_POST["idInterprete"];
      break;
      case 12:
      $idAnnexe=$_POST["idCoachSportif"];
      break;
      case 12:
      $idAnnexe=$_POST["idCoachCulture"];
      break;
      default:
      $idAnnexe=-1;
      $thisQuantite=0;
      break;
    }
    


    
    if (isset($_POST['emailContact']) && isset($_POST['messageContact']) && (!empty($_POST['emailContact'])) && (!empty($_POST['messageContact'])))
    {
      $req=$bdd->getPDO()->prepare('INSERT INTO serviceautre (`contenuMessage`,`dateMessage`,`emailClient`) VALUES (:contenuMessage,NOW(),:emailClient)');
      $req->bindValue(':contenuMessage',$_POST['messageContact']);
      $req->bindValue(':emailClient',$_POST['emailContact']);
      $req->execute();
      $req->closeCursor();


      $req=$bdd->getPDO()->prepare('SELECT idMessage FROM serviceautre WHERE emailClient = :emailClient AND contenuMessage =:contenuMessage ');
      $req->bindValue(':contenuMessage',$_POST['messageContact']);
      $req->bindValue(':emailClient',$_POST['emailContact']);
      $req->execute();

      $monIdMessage = $req->fetch();
      $monIdMessage['idMessage'];
      $req->closeCursor();

      $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (`idTrajet`,`idService`,`idAnnexe`,`quantite`) VALUES (:idTrajet,:idService,:idAnnexe,:quantite)');
      $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
      $req->bindValue(':idService', $service);
      $req->bindValue(':idAnnexe',$monIdMessage['idMessage']);
      $req->bindValue(':quantite', $thisQuantite);
      $req->execute();
      $req->closeCursor();
    }
    else {
    //on insere les id et la quantité pour lier ce choix de service au trajet dans cette table e liaison
    $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (`idTrajet`,`idService`,`idAnnexe`,`quantite`) VALUES (:idTrajet,:idService,:idAnnexe,:quantite)');
    $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
    $req->bindValue(':idService', $service);
    $req->bindValue(':idAnnexe', $idAnnexe);
    $req->bindValue(':quantite', $thisQuantite);
    $req->execute();
    $req->closeCursor();

    }

  }

  //redirection
   header("location:resevationChooseDriver.php");
}
else {

   header("location:resevationChooseService.php?probleme");
}


function checkInterprete($startInterprete,$endInterprete,$res) {
  if ((!empty($_SESSION['startInterprete'])) && (!empty($_SESSION['endInterprete'])))
  {
    if ($startInterprete - strtotime($res[1]) >= 0 &&  $endInterprete - $startInterprete > 0 && $endInterprete - $startInterprete <= 28800)
    {
      return true;
    }
    else {
      return false;
    }
  
  }
  else {
    return true;
  }
  }

?>
