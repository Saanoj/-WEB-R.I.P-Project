<?php

require_once __DIR__ . '/Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
session_start();


  //on prends l'entreprise
  $entreprise = $bdd->queryOne('SELECT * FROM entreprise WHERE idEntreprise = '.$_POST["idEntreprise"].'');

  //on prends les infos abbo du directeur
  $abboDirecteur = $bdd->queryOne('SELECT * FROM linkabonnemententreprise WHERE idClient = '.$entreprise["idDirecteur"].'');


  //on supp l'abbo du client deja existant
  $abbos = $bdd->query('SELECT * FROM linkabonnemententreprise');
  foreach ($abbos as $abbo) {
    if ($abbo['idClient'] == $_POST["idClient"]) {
      $bdd->exec('DELETE FROM linkabonnemententreprise WHERE idClient = '.$_POST["idClient"].'');
    }
  }

//update idEntrepise dans users
  $bdd->exec('UPDATE users SET idEntreprise = '.$_POST["idEntreprise"].' WHERE id = '.$_POST["idClient"].'');

  //on ajoute pour le user le meme abbo que le directeur
  $req = $bdd->getPDO()->prepare('INSERT INTO linkabonnemententreprise (idAbonnement,idClient,dateDebut,dateFin,idEntreprise) VALUES(:idAbonnement,:idClient,:dateDebut,:dateFin,:idEntreprise)');
  $req->execute(array(
      'idAbonnement' => $abboDirecteur["idAbonnement"],
      'idClient' => intval($_POST['idClient']),
      'dateDebut' => $abboDirecteur["dateDebut"],
      'dateFin' => $abboDirecteur["dateFin"],
      'idEntreprise' => $abboDirecteur["idEntreprise"]
  ));
  $req->closeCursor();


  //ono supprime de la table notif entreprise
  $res2 = $bdd->exec('DELETE FROM notifentreprise WHERE idClient = '.intval($_POST["idClient"]).' AND idEntreprise = '.$_POST["idEntreprise"].'');

  echo $_POST["idClient"]." 1 ".$res2;



 ?>
