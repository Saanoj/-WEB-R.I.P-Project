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

$req=$bdd->getPDO()->prepare('UPDATE users SET isCollaborateur=0 WHERE id='.$_SESSION["id"].'');
$req->execute();
$req->closeCursor();

header('location: inscriptionCollab.php')
?>
