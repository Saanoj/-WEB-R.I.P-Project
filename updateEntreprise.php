<?php
namespace App;
use \PDO;
session_start();
require 'Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
if (isset($_GET['name']) && !empty($_GET['name']))
{
    $req = $bdd->getPDO()->prepare('SELECT * FROM entreprise WHERE nameEntreprise = :nameEntreprise');
$req->execute(array("nameEntreprise" => $_GET['name']));
$uneEntreprise = $req->fetch();
echo $uneEntreprise['nameEntreprise'].':'; 
echo $uneEntreprise['adresse'].':';  
echo $uneEntreprise['nbSalarie'].':';  
echo $uneEntreprise['numEntreprise'].':';  
echo $uneEntreprise['numSiret'].':';
echo $uneEntreprise['pays'].':';
$req->closeCursor();
}
if (isset($_POST['submit'])) {

    $req = $bdd->getPDO()->prepare('SELECT * FROM entreprise WHERE nameEntreprise = :nameEntreprise');
    $req->execute(array("nameEntreprise" => $_POST['nameEntreprise']));
    $uneEntreprise = $req->fetch();
    $idEntreprise = $uneEntreprise['idEntreprise'];
    $req2 = $bdd->getPDO()->prepare('UPDATE users SET idEntreprise = :idEntreprise WHERE id = :id');
    $req2->execute(array(
        'idEntreprise' => $idEntreprise,
        'id' => $_SESSION['id']
    ));
    $req2->closeCursor();


    $req = $bdd->getPDO()->prepare('UPDATE entreprise SET nbSalarie = Nbsalarie +1 WHERE nameEntreprise = :nameEntreprise');
    $req->execute(array("nameEntreprise" => $_POST['nameEntreprise']));
    $req->closeCursor();

    
    header('location:profil.php');
}











?>