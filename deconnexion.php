<?php
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

session_start();

if ($_SESSION['isCollaborateur']==1) {
  $req=$bdd->getPDO()->prepare('UPDATE collaborateurs SET isOnline=:isOnline WHERE idCollaborateurs=:idCollaborateurs');
  $req->bindValue(':idCollaborateurs', $_SESSION["id"]);
  $req->bindValue(':isOnline', 0);
  $req->execute();
  $req->closeCursor();
}
session_destroy();
header('location: index.php');
exit;
?>
