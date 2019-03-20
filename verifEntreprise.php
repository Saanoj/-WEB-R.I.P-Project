<?php 
namespace App;
use \PDO;
session_start();
require 'Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
?>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
</body>


<?php


if (isset($_POST['nameEntreprise']) && !empty($_POST['nameEntreprise']) &&
isset($_POST['numEntreprise']) && !empty($_POST['numEntreprise']) &&
isset($_POST['numSiret']) && !empty($_POST['numSiret']) &&
isset($_POST['adresse']) && !empty($_POST['adresse']) &&
isset($_POST['nbSalarie']) && !empty($_POST['nbSalarie']) &&
isset($_POST['pays']) && !empty($_POST['pays']) &&
isset($_SESSION['id']) && !empty($_SESSION['id'])
)
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
        
        // On modifie le idEntreprise du user avec l'id de l'entreprise qu'on vient de créer et on met isDirecteur a 1
        $req = $bdd->getPDO()->prepare('UPDATE users SET idEntreprise = :idEntreprise, isDirecteur = 1 WHERE id = :id');
        $req->execute(array(
            'idEntreprise' => $idEntreprise,
            'id' => $_SESSION['id']
        ));
        $req->closeCursor();

        
        ?>
        <div class="alert alert-success" role="alert">
  Votre entreprise est bien enrengistré ! Vous allez être redirigé dans quelques secondes.
    </div>
    <?php
  
   // header('location:verifAbonnement');
   if (($_GET['isEngagement']) != '') {
  header ('Refresh: 3;URL=configAbonnementEntreprise.php?isEngagement='.$_GET['isEngagement'].'');
   }
   else 
   {
       if ($_POST['isEngagement'] == 'Avec engagement')
       {
           
        header ('Refresh: 3;URL=configAbonnementEntreprise.php?isEngagement=1');
       }
       else 
       {
        header ('Refresh: 3;URL=configAbonnementEntreprise.php?isEngagement=0');
       }
   }
    
  
}
else 
{
    header('location:abonnement.php?erreur');
}




?>

