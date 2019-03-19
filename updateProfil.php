<?php


require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

if (isset($_POST['idProfil']) && isset($_POST['newval']) && isset($_POST['newid']) && isset($_POST['idEntreprise'])) {
$idProfil = $_POST['idProfil'];
$newval = $_POST['newval'] ;
$columnName  = $_POST['newid'] ;
$idEntreprise  = $_POST['idEntreprise'] ;

if ($columnName == "email" || $columnName == "last_name" || $columnName == "birthday" || $columnName == "gender" || $columnName == "first_name" || $columnName == "zipcode")
{
$req = $bdd->getPDO()->prepare('UPDATE users SET '.$columnName.' = :columnValue WHERE id =:idProfil');
$req->bindValue(':columnValue', $newval);
$req->bindValue(':idProfil', $idProfil);
$req->execute();
$req->closeCursor();
}

else 
{
    $req = $bdd->getPDO()->prepare('UPDATE entreprise SET '.$columnName.' = :columnValue WHERE idEntreprise =:idEntreprise');
    $req->bindValue(':columnValue', $newval);
    $req->bindValue(':idEntreprise', $idEntreprise);
    $req->execute();
    $req->closeCursor();
}

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
