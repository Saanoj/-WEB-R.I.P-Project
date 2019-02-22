<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

echo "string";
$servicesChoisi=$_POST['services'];

var_dump($servicesChoisi);
foreach ($servicesChoisi as $service) {
  $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (`idTrajet`,`idService`) VALUES (:idTrajet,:idService)');
  $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
  $req->bindValue(':idService', $service);
  $req->execute();
  $req->closeCursor();
}
header("location: resevationChooseDriver.php");
?>
