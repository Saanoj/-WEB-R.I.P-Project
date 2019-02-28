<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');


if (isset($_POST['services']) && (!empty($_POST['services']))) {
$servicesChoisi=$_POST['services'];

var_dump($servicesChoisi);
foreach ($servicesChoisi as $service) {

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

    default:
      $idAnnexe=-1;
      break;
  }

  $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (`idTrajet`,`idService`,`idAnnexe`) VALUES (:idTrajet,:idService,:idAnnexe)');
  $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
  $req->bindValue(':idService', $service);
  $req->bindValue(':idAnnexe', $idAnnexe);
  $req->execute();
  $req->closeCursor();
}
//header("location: resevationChooseDriver.php");
}
else {
  header("location:resevationChooseService.php?probleme_de_case");
}
?>
