<?php 
namespace App;
use \PDO;
session_start();
require_once __DIR__ .'/require_class.php';

$bdd = new Database('rip');
?>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>
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
?>
<div class="alert alert-success" role="alert">
Votre entreprise possède désormais un abonnement. Dîtes à vos salariés de rejoindre l'entreprise afin de profiter des différents services ! <br>
Vous allez être redirigé dans quelques secondes.
</div>
<?php
 header ("Refresh: 6;URL=index.php");

?>