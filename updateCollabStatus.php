<?php


require_once __DIR__ .'/require_class.php';

$bdd = new App\Database('rip');
session_start();

if (isset($_POST['isOnline'])) {

  $req=$bdd->getPDO()->prepare('UPDATE collaborateurs SET isOnline=:isOnline WHERE idCollaborateurs=:idCollaborateurs');
  $req->bindValue(':idCollaborateurs', $_SESSION["id"]);
  $req->bindValue(':isOnline', $_POST['isOnline']);
  $req->execute();
  $req->closeCursor();

}
//exit;



?>
