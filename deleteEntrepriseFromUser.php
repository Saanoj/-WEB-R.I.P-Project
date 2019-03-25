<?php


session_start();
require_once 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
// On recupere l'id de l'entreprise
$req = $bdd->getPDO()->prepare('SELECT idEntreprise FROM users WHERE id = :id');
$req->execute(array('id' => $_SESSION['id']));
$uneEntreprise = $req->fetch();
$idEntreprise = $uneEntreprise['idEntreprise'];
$req->closeCursor();

// On selectionne l'idDirecteur de l'entreprise
$req = $bdd->getPDO()->prepare('SELECT idDirecteur FROM entreprise WHERE idEntreprise = :idEntreprise');
$req->execute(array('idEntreprise' => $idEntreprise));
$unDirecteur = $req->fetch();
$idDirecteur = $unDirecteur['idDirecteur'];
$req->closeCursor();

if ($idDirecteur == $_SESSION['id'])
{
        require_once 'lib/Stripe.php';
    Stripe::setApiKey("sk_test_ze3ZePlRbWuZCbCAfKs4DOTc");
    
    $req = $bdd->getPDO()->prepare('DELETE FROM entreprise WHERE idEntreprise = :idEntreprise');
    $req->execute(array('idEntreprise' => $idEntreprise));
    $req->closeCursor();

    // On delete tous les liens d'abonnements entre l'entreprise et les users
    $req = $bdd->getPDO()->prepare('DELETE FROM linkabonnemententreprise WHERE idEntreprise = :idEntreprise');
    $req->execute(array('idEntreprise' => $idEntreprise));
    $req->closeCursor();
    
    $plan = Stripe_Plan::retrieve($idEntreprise);
    $plan->delete();
    
}
else 
{
    $req = $bdd->getPDO()->prepare('DELETE FROM linkabonnemententreprise WHERE idClient = :idClient');
    $req->execute(array('idClient' => $_SESSION['id']));
    $req->closeCursor();

    // On fait -1 salarié dans l'entreprise

    $req = $bdd->getPDO()->prepare('UPDATE entreprise SET nbSalarie = nbSalarie -1  WHERE idEntreprise = :id');
    $req->execute(array('id' => $idEntreprise));
    $req->closeCursor();
}

// UPDATE USER 
$req = $bdd->getPDO()->prepare('UPDATE users SET idEntreprise = NULL,isDirecteur = 0 WHERE id = :id');
$req->execute(array('id' => $_SESSION['id']));
$req->closeCursor();


  header('location:profil.php');