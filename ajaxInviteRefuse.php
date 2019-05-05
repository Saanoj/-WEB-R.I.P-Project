<?php

require_once __DIR__ . '/require_class.php';

$bdd = new App\Database('rip');
session_start();


  //ono supprime de la table notif entreprise
  $abboDirecteur = $bdd->exec('DELETE FROM notifentreprise WHERE idClient = '.$_POST["idClient"].' AND idEntreprise = '.$_POST["idEntreprise"].'');

  echo "2";




 ?>
