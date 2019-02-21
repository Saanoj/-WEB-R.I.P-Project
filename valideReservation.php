<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');


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
