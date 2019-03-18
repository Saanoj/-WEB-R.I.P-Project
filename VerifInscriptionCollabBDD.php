<?php
namespace App;
use \PDO;


require 'Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
session_start();

$infoCollab=$_SESSION["infoCollab"];

switch ($infoCollab["metier"]) {

  case 'interprete':

    $price=80;
    break;
  case 'coachSportif':

    $price=75;
    break;
  case 'coachCulture':

    $price=120;
    break;
  case 'chauffeur':
    $req=$bdd->getPDO()->prepare('INSERT INTO car (idCollaborateur,carBrand,carModel,carColor,nbPlaces) VALUES ( :idCollaborateur, :carBrand, :carModel, :carColor, :nbPlaces)');
    $req->bindValue(':idCollaborateur', $_SESSION["id"]);
    $req->bindValue(':carBrand', $_POST["make"]);
    $req->bindValue(':carModel', $_POST["model"]);
    $req->bindValue(':carColor', $_POST["color"]);
    $req->bindValue(':nbPlaces', $_POST["places"]);
    $req->execute();
    $req->closeCursor();

    $price=$_POST["prix_collaborateur"];
    break;
  default:
    // code...
    break;
}
$reqUser = $bdd->queryOne('SELECT * FROM users WHERE id='.$_SESSION["id"].'');

$req=$bdd->getPDO()->prepare('INSERT INTO collaborateurs (idCollaborateurs,email,last_name,first_name,metier,description,prixCollaborateur,dateEmbauche,ville,heuresTravailees,ratingNumber,isOff) VALUES ( :idCollaborateur, :email, :last_name, :first_name, :metier, :description, :prixCollaborateur, :dateEmbauche, :ville, 0, 0, 0)');
$req->bindValue(':idCollaborateur', $_SESSION["id"]);
$req->bindValue(':email', $reqUser["email"]);
$req->bindValue(':last_name', $reqUser["last_name"]);
$req->bindValue(':first_name', $reqUser["first_name"]);
$req->bindValue(':metier', $infoCollab["metier"]);
$req->bindValue(':description', $_POST["description"]);
$req->bindValue(':prixCollaborateur', $price);
$req->bindValue(':dateEmbauche', date('Y-m-d H:i:s'));
$req->bindValue(':ville', $infoCollab["ville"]);
$req->execute();
$req->closeCursor();

$req=$bdd->getPDO()->prepare('UPDATE users SET isCollaborateur=1 WHERE id=:id');
$req->bindValue(':id', $_SESSION["id"]);
$req->execute();
$req->closeCursor();

$_SESSION["isCollaborateur"]=1;
header('location: index.php');

?>
