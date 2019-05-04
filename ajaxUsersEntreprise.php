<?php

require_once __DIR__ . '/Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
session_start();



$abbo = $bdd->query('SELECT idClient FROM linkabonnemententreprise');

$stmtStr = "";
$idRemove = [];
foreach ($abbo as $one) {
  if (!in_array($one["idClient"],$idRemove)) {
    $stmtStr.=" AND id != ".$one["idClient"];
    array_push($idRemove, $one["idClient"]);
  }
}
$stmtStr.=" AND id != ".$_SESSION["id"];

$users = $bdd->query('SELECT * FROM USERS WHERE isBanned = 0 '.$stmtStr.' AND CONCAT(id, email, last_name, first_name, birthday, gender, isAdmin, isBanned) LIKE "%'.$_GET["inputText"].'%" LIMIT 5');


foreach ($users as $user) {
  echo "<div class='row p-1'><button class='btn' onClick=''>Envoyer une invitation</button>".$user["first_name"]." ".$user["last_name"]."</div>";

}
 ?>
