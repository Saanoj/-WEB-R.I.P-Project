<?php


require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

if (isset($_POST['id']) && isset($_POST['newval']) && isset($_POST['newid'])) {
$id = $_POST['id'];
$newval = $_POST['newval'] ;
$columnName  = $_POST['newid'] ;


$req = $bdd->getPDO()->prepare('UPDATE users SET '.$columnName.' = :columnValue WHERE id =:id');
$req->bindValue(':columnValue', $newval);
$req->bindValue(':id', $id);
$req->execute();
$req->closeCursor();
}



if (isset($_POST['id']) && !empty($_POST['id']))
{
$req = $bdd->getPDO()->prepare('DELETE FROM linkabonnemententreprise WHERE idClient = :idClient');
$req->execute(array('idClient' => $_POST['id']));
$req->closeCursor();
}

if (isset($_POST['idEntreprise']) && !empty($_POST['idEntreprise']) && isset($_POST['id']) && !empty($_POST['id']))
{
$req = $bdd->getPDO()->prepare('DELETE FROM entreprise WHERE idEntreprise = :idEntreprise');
$req->execute(array('idEntreprise' => $_POST['idEntreprise']));
$req->closeCursor();

$req = $bdd->getPDO()->prepare('DELETE FROM linkabonnemententreprise WHERE idEntreprise = :idEntreprise');
$req->execute(array('idEntreprise' => $_POST['idEntreprise']));
$req->closeCursor();

$req = $bdd->getPDO()->prepare('UPDATE users SET idEntreprise = NULL WHERE idEntreprise = :idEntreprise');
$req->execute(array('idEntreprise' => $_POST['idEntreprise']));
$req->closeCursor();
}

exit;



?>
