<?php
namespace App;
use \PDO;


require_once __DIR__ .'/require_class.php';

$bdd = new Database('rip');
session_start();


$req=$bdd->getPDO()->prepare('UPDATE collaborateurs SET isOFF=1 AND isOnline=1 WHERE idCollaborateurs='.$_SESSION["id"].'');
$req->execute();
$req->closeCursor();

$req=$bdd->getPDO()->prepare('UPDATE users SET isCollaborateur=0 WHERE id='.$_SESSION["id"].'');
$req->execute();
$req->closeCursor();

$_SESSION["isCollaborateur"]=0;
header('location: deconnexion.php')
?>
