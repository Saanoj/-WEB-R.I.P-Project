<?php 
namespace App;
use \PDO;
session_start();
require 'Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');

if (isset($_POST['nameEntreprise']) && !empty($_POST['nameEntreprise']) &&
isset($_POST['numEntreprise']) && !empty($_POST['numEntreprise']) &&
isset($_POST['numSiret']) && !empty($_POST['numSiret']) &&
isset($_POST['adresse']) && !empty($_POST['adresse']) &&
isset($_POST['nbSalarie']) && !empty($_POST['nbSalarie']) &&
isset($_POST['pays']) && !empty($_POST['pays']) &&
isset($_SESSION['id']) && !empty($_SESSION['id'])
)
{
    // On check si l'utilisateur n'a aucune entreprise créer avec son id ( donc si le nb de lignes dans la bdd est egal a 0)
    $req = $bdd->getPDO()->prepare('SELECT * FROM entreprise WHERE idDirecteur = :idDirecteur');
    $req->execute(array('idDirecteur' => $_SESSION['id']));
    $req->closeCursor();
    if ( $req->rowCount() == 0)
    {

        // On insert dans la bdd l'entreprise avec les infos du formulaire
        $req = $bdd->getPDO()->prepare('INSERT INTO entreprise(nameEntreprise,numSiret,adresse,nbSalarie,pays,idDirecteur,numEntreprise) VALUES (:nameEntreprise,:numSiret,:adresse,:nbSalarie,:pays,:idDirecteur,:numEntreprise)');
        $req->execute(array(
            'nameEntreprise' => $_POST['nameEntreprise'],
            'numSiret' => $_POST['numSiret'],
            'adresse' => $_POST['adresse'],
            'nbSalarie' => $_POST['nbSalarie'],
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
        
        // On modifie le idEntreprise du user avec l'id de l'entreprise qu'on vient de créer
        $req = $bdd->getPDO()->prepare('UPDATE users SET idEntreprise = :idEntreprise WHERE id = :id');
        $req->execute(array(
            'idEntreprise' => $idEntreprise,
            'id' => $_SESSION['id']
        ));
        $req->closeCursor();
        
    
    }
    else 
    {

    }
}
else 
{
    header('location:abonnement.php');
}

?>