<?php 
namespace App;
use \PDO;
session_start();
require_once __DIR__ .'/require_class.php';

$bdd = new Database('rip');
?>

<?php


// On récupere l'id de l'entreprise
$req = $bdd->getPDO()->prepare('SELECT * FROM entreprise WHERE idDirecteur = :idDirecteur');
$req->execute(array('idDirecteur' => $_SESSION['id']));


$uneEntreprise = $req->fetch(); 
$idEntreprise = $uneEntreprise['idEntreprise'];
$req->closeCursor();
if ($_GET['isEngagement'] == '1')
 {
     $idAbo = 4;
 }
 else
 {
     $idAbo = 3;
 }

// On créer un abonnement pour toutes les personnes appartenant a l'entreprise
$dateFin=date("Y-m-d", strtotime("+1 year"));


$req = $bdd->getPDO()->prepare('SELECT * FROM `users` INNER JOIN entreprise ON entreprise.idEntreprise = users.idEntreprise AND entreprise.idEntreprise = :idEntreprise ');
$req->execute(array('idEntreprise' => $idEntreprise));
while ($uneEntreprise = $req->fetch())
{
    $reqInsertAbonnement = $bdd->getPDO()->prepare('INSERT INTO linkabonnemententreprise(idAbonnement,idClient,idEntreprise,dateDebut,dateFin) VALUES (:idAbo,:idClient,:idEntreprise,NOW(),:dateFin)');
    $reqInsertAbonnement->execute(array(
        'idAbo' => $idAbo,
        'idClient' => $uneEntreprise['id'],
        'idEntreprise' => $idEntreprise,
        'dateFin' => $dateFin
    ));
}
$req->closeCursor();

 header ("location:index.php");

?>