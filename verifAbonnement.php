<?php 
namespace App;
use \PDO;
session_start();
require 'Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');

?>
<!DOCTYPE HTML>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="css/abonnement/verifAbonnement/style.css" rel="stylesheet"></link>
</head>
<!------ Include the above in your HEAD tag ---------->

<?php

switch ($_POST['submit'])
{
    case 'engagementStandard':
    $isEngagement = 1;
    $idAbonnement = 2;
    $typeAbonnement = 'Standard';
    $dateFin=date("Y-m-d", strtotime("+1 year"));
    req($idAbonnement,$isEngagement,$dateFin,$bdd);
    break;

    case 'nonEngagementStandard':
    $isEngagement = 0;
    $idAbonnement = 1;
    $dateFin=date("Y-m-d", strtotime("+10 year"));
    req($idAbonnement,$isEngagement,$dateFin,$bdd);
    break;

    case 'nonEngagementEntreprise':
    /*
    $isEngagement = 0;
    $typeAbonnement = 'Entreprise';
    $dateFin=date("Y-m-d", strtotime("+10 year"));
    req($isEngagement,$typeAbonnement,$dateFin,$bdd);
    */
    $isEngagement = 0;
    reqEntreprise($bdd,$isEngagement);
    break;

    case 'engagementEntreprise':
    /*
    $isEngagement = 1;
    $typeAbonnement = 'Entreprise';
    $dateFin=date("Y-m-d", strtotime("+1 year"));
    req($isEngagement,$typeAbonnement,$dateFin,$bdd);
    break;
    */
    $isEngagement =1;
    reqEntreprise($bdd,$isEngagement);
    break;
   
    default:
    header('location:abonnement.php');
    break;
}


function req($idAbonnement,$isEngagement,$dateFin,$bdd)
{
    $req = $bdd->getPDO()->prepare('INSERT INTO linkabonnemententreprise(idAbonnement,idClient,dateDebut,dateFin) VALUES(:idAbonnement,:idClient,NOW(),:dateFin)');
    $req->execute(array(
        'idAbonnement' => $idAbonnement,
        'idClient' => $_SESSION['id'],
        'dateFin' => $dateFin
    ));
?>
    <div class="alert alert-success" role="alert">
    Vous venez de souscrire à un abonnement ! Vous allez être rediriger dans quelques secondes.
    </div>
    <?php 
    header ("Refresh: 6;URL=index.php");

}

function reqEntreprise($bdd,$isEngagement)

 {
 // On check si l'utilisateur n'a aucune entreprise créer avec son id ( donc si le nb de lignes dans la bdd est egal a 0)
 $req = $bdd->getPDO()->prepare('SELECT * FROM entreprise WHERE idDirecteur = :idDirecteur');
 $req->execute(array('idDirecteur' => $_SESSION['id']));
 $req->closeCursor();
 if ( $req->rowCount() == 0) {
    header('location:createEntreprise.php?isEngagement='.$isEngagement.'');
 }
 else
 {
    header('location:configAbonnementEntreprise.php?isEngagement='.$isEngagement.'');
 }
 }
?>
