<?php
namespace App;
use \PDO;


require 'Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
session_start();


$req=$bdd->getPDO()->prepare('DELETE FROM collaborateurs WHERE idCollaborateurs='.$_SESSION["id"].'');
$req->execute();
$req->closeCursor();

$req=$bdd->getPDO()->prepare('DELETE FROM car WHERE idCollaborateur='.$_SESSION["id"].'');
$req->execute();
$req->closeCursor();

$req=$bdd->getPDO()->prepare('UPDATE users SET isCollaborateur=0 WHERE id='.$_SESSION["id"].'');
$req->execute();
$req->closeCursor();

$_SESSION["isCollaborateur"]=0;
header('location: inscriptionCollab.php')
?>
