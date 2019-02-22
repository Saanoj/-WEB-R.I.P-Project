<?php


require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

if (isset($_POST['id']) && isset($_POST['newval']) && isset($_POST['columnName'])) {
$id = $_POST['id'];
$newval = $_POST['newval'] ;
$columnName  = $_POST['newid'] ;


$req = $bdd->getPDO()->prepare('UPDATE users SET '.$columnName.' = :columnValue WHERE id =:id');
$req->bindValue(':columnValue', $newval);
$req->bindValue(':id', $id);
$req->execute();
$req->closeCursor();
}

if (isset($_POST['idAbo'])){

// DELETE DE L'ABONNEMENT

$idAbo = $_POST['idAbo'];
$req = $bdd->getPDO()->prepare('DELETE FROM abonnement WHERE '.$idAbo.' = :columnValue');
$req->bindValue(':columnValue', $idAbo);
$req->execute();
$req->closeCursor();
}


exit;



?>
