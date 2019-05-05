<?php

require_once __DIR__ . '/Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
session_start();


  //ono supprime de la table notif entreprise
  $bdd->exec('DELETE FROM linkabonnemententreprise WHERE idClient = '.$_GET["idClient"].' AND idEntreprise = '.$_GET["idEntreprise"].'');

  $bdd->exec('UPDATE users SET idEntreprise = NULL WHERE id = '.$_GET["idClient"].'');

  echo "L'utilisateur a bien été supprimé de votre formule d'abonnement et entreprise";



 ?>
