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
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
switch ($_POST['submit'])
{
    case 'engagementStandard':
    $isEngagement = 1;
    $idAbonnement = 2;
    $dateFin=date("Y-m-d", strtotime("+1 year"));
    if (existEntreprise($bdd) == true) 
    {
    req($idAbonnement,$isEngagement,$dateFin,$bdd);
    
    }
    else 
    {
        header('location:appartientEntreprise.php?isValide=0');
    }
    break;

    case 'nonEngagementStandard':
    $isEngagement = 0;
    $idAbonnement = 1;
    $dateFin=date("Y-m-d", strtotime("+10 year"));
    if (existEntreprise($bdd) == true) 
    {
    req($idAbonnement,$isEngagement,$dateFin,$bdd);
    }
    else 
    {
        header('location:appartientEntreprise.php?isValide=0');
    }
    break;

    case 'nonEngagementEntreprise':
    $isEngagement = 0;
    reqEntreprise($bdd,$isEngagement);
    break;

    case 'engagementEntreprise':
    $isEngagement =1;
    reqEntreprise($bdd,$isEngagement);
    break;
   
    default:
    header('location:abonnement.php');
    break;
}

}
else
{
    header('location:abonnement.php');
}


function checkIfAbonnementValide($bdd) 
{
$req = $bdd->getPDO()->prepare('SELECT * FROM linkabonnemententreprise WHERE idClient = :idClient');
$req->execute(array('idClient' => $_SESSION['id']));
$req->closeCursor();
if ($req->rowCount() == 0)
{
    return true;
}
else
{
    return false;
}
}


// Requete qui ajouteu un abonnement dans linkabonnemententreprise si c'est un utilisateur standard sans entreprise
function req($idAbonnement,$isEngagement,$dateFin,$bdd)
{
    if (checkIfAbonnementValide($bdd) == true)
    {
    $req = $bdd->getPDO()->prepare('INSERT INTO linkabonnemententreprise(idAbonnement,idClient,dateDebut,dateFin) VALUES(:idAbonnement,:idClient,NOW(),:dateFin)');
    $req->execute(array(
        'idAbonnement' => $idAbonnement,
        'idClient' => $_SESSION['id'],
        'dateFin' => $dateFin
    ));
    $req->closeCursor();
?>
    <?php 
    header('location:paiementAbonnement.php?isEngagement='.$isEngagement.'&idAbonnement='.$idAbonnement.'');
  //  header ('Refresh: 0;URL=recapAbonnement?isEngagement='.$isEngagement.'&idAbonnement='.$idAbonnement.'');
}
else 
{
    header('location:profil?Deja_abonne');

}

}

 // On check si l'utilisateur n'a aucune entreprise créer avec son id ( donc si le nb de lignes dans la bdd est egal a 0)
function reqEntreprise($bdd,$isEngagement)
 {
    if (checkIfAbonnementValide($bdd) == true)
    {
       
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
else
{
    header('location:abonnement?Deja_abonne');
}
}
// On check si l'utilisateur est un directeur, sinon il ne pourra pas créer d'entreprise
/*
var_dump(reqIsDirecteur($bdd));
function reqIsDirecteur($bdd)
{
    $req = $bdd->getPDO()->prepare('SELECT isDirecteur FROM users WHERE id = :id ');
    $req->execute(array('id' => $_SESSION['id']));
    $unUser = $req->fetch();
    $req->closeCursor();
    if ($unUser['isDirecteur'] == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
    
}
*/

function existEntreprise($bdd) {
    $req = $bdd->getPDO()->prepare('SELECT * FROM entreprise WHERE idDirecteur = :idDirecteur');
    $req->execute(array('idDirecteur' => $_SESSION['id']));
    if($req->rowCount() == 0)
    {
        $req->closeCursor();
        return true;
    } 
    else {
        $req->closeCursor();
        return false;
    }
    

}
?>
