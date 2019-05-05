<?php

require_once __DIR__ . '/Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
session_start();



$abbo = $bdd->query('SELECT idClient FROM linkabonnemententreprise');

$sentNotif = $bdd->query('SELECT idClient FROM notifentreprise');

$stmtStr = "";
$idRemove = [];
//ajoute dans la liste a bannir
foreach ($abbo as $one) {
    if (!in_array($one["idClient"],$idRemove)) {
      $stmtStr.=" AND id != ".$one["idClient"];
      array_push($idRemove, $one["idClient"]);
    }
}

//ajoute dans la liste cux qui ont deja une notif
foreach ($sentNotif as $notif) {

  if (!in_array($notif["idClient"],$idRemove)) {
    $stmtStr.=" AND id != ".$notif["idClient"];
    array_push($idRemove, $notif["idClient"]);
  }
}

$stmtStr.=" AND id != ".$_SESSION["id"];

$users = $bdd->query('SELECT * FROM users WHERE isBanned = 0 '.$stmtStr.' AND CONCAT(id, email, last_name, first_name, birthday, gender, isAdmin, isBanned) LIKE "%'.$_GET["inputText"].'%" LIMIT 5');


foreach ($users as $user) {
  echo "<div class='row p-1' id='rowId".$user["id"]."'><div class='btn btn-primary btnNotif' id='".$user["id"]."' onClick='sendNotifEntreprise(".$user["id"].")'>Envoyer une invitation</div>".$user["first_name"]." ".$user["last_name"]."</div>";
}

 ?>
