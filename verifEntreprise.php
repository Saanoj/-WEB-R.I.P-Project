<?php 
namespace App;
use \PDO;
session_start();
require_once __DIR__ .'/require_class.php';

$bdd = new Database('rip');
?>
<?php


if (isset($_POST['nameEntreprise']) && !empty($_POST['nameEntreprise']) &&
isset($_POST['numEntreprise']) && !empty($_POST['numEntreprise']) &&
isset($_POST['numSiret']) && !empty($_POST['numSiret']) &&
isset($_POST['adresse']) && !empty($_POST['adresse']) &&
isset($_POST['pays']) && !empty($_POST['pays']) &&
isset($_SESSION['id']) && !empty($_SESSION['id'])
)
{
    $req = $bdd->getPDO()->prepare('DELETE  FROM linkabonnemententreprise WHERE idClient = :idClient');
    $req->execute(array('idClient' => $_SESSION['id']));
    $req->closeCursor();

        // On insert dans la bdd l'entreprise avec les infos du formulaire
        $req = $bdd->getPDO()->prepare('INSERT INTO entreprise(nameEntreprise,numSiret,adresse,nbSalarie,pays,idDirecteur,numEntreprise) VALUES (:nameEntreprise,:numSiret,:adresse,:nbSalarie,:pays,:idDirecteur,:numEntreprise)');
        $req->execute(array(
            'nameEntreprise' => $_POST['nameEntreprise'],
            'numSiret' => $_POST['numSiret'],
            'adresse' => $_POST['adresse'],
            'nbSalarie' => 1,
            'pays' => $_POST['pays'],
            'idDirecteur' => $_SESSION['id'],
            'numEntreprise' => $_POST['numEntreprise']
        ));
        $req->closeCursor();

        // On récupère l'id de l'entreprise qu'on vient de créer afin de modifier idEntreprise dans le user
        $req = $bdd->getPDO()->prepare('SELECT * FROM entreprise WHERE idDirecteur = :idDirecteur');
        $req->execute(array('idDirecteur' => $_SESSION['id']));
        while ($uneEntreprise = $req->fetch())
        {
            $idEntreprise = $uneEntreprise['idEntreprise'];
            
        }
        $req->closeCursor();
        
        // On modifie le idEntreprise du user avec l'id de l'entreprise qu'on vient de créer et on met isDirecteur a 1
        $req = $bdd->getPDO()->prepare('UPDATE users SET idEntreprise = :idEntreprise, isDirecteur = 1 WHERE id = :id');
        $req->execute(array(
            'idEntreprise' => $idEntreprise,
            'id' => $_SESSION['id']
        ));
        $req->closeCursor();

   header('location:profil.php');
}
else 
{
    header('location:abonnement.php?erreur');
}




?>

