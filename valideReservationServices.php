<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');


if (isset($_POST['services']) && (!empty($_POST['services']))) {
  $servicesChoisi=$_POST['services'];

  $quantiteCertainService=$_POST['quantite'];



  echo "<br>spacer<br>";
  var_dump($_POST['quantite']);
  var_dump($servicesChoisi);

  if(isset($servicesChoisi)){
    foreach ($servicesChoisi as $service) {

      foreach ($quantiteCertainService as $key => $quantite) {
        if ($key == $service) {
          $thisQuantite=$quantite;

        }
      }
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
        $thisQuantite=0;
        break;
      }

      $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (`idTrajet`,`idService`,`idAnnexe`,`quantite`) VALUES (:idTrajet,:idService,:idAnnexe,:quantite)');
      $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
      $req->bindValue(':idService', $service);
      $req->bindValue(':idAnnexe', $idAnnexe);
      $req->bindValue(':quantite', $thisQuantite);
      $req->execute();
      $req->closeCursor();

    }
  }
    header("location: resevationChooseDriver.php");
}
else {
  header("location:resevationChooseService.php?probleme_de_case");
}
?>
