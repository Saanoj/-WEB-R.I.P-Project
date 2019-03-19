<?php
namespace App;
use \PDO;
session_start();
require 'Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
// On recupere l'id de l'entreprise
$req = $bdd->getPDO()->prepare('SELECT idEntreprise FROM users WHERE id = :id');
$req->execute(array('id' => $_SESSION['id']));
$uneEntreprise = $req->fetch();
$idEntreprise = $uneEntreprise['idEntreprise'];
$req->closeCursor();

// On fait -1 salarié dans l'entreprise

$req = $bdd->getPDO()->prepare('UPDATE entreprise SET nbSalarie = nbSalarie -1  WHERE idEntreprise = :id');
$req->execute(array('id' => $idEntreprise));
$req->closeCursor();


// UPDATE USER 
$req = $bdd->getPDO()->prepare('UPDATE users SET idEntreprise = NULL WHERE id = :id');
$req->execute(array('id' => $_SESSION['id']));
$req->closeCursor();

header('location:profil.php');