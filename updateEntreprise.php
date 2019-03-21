<?php
namespace App;
use \PDO;
session_start();
require 'Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
?>

<?php
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
    ?>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <?php
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
    success();

    


}


function success() 
{
    ?>
    <div class="alert alert-success" role="alert">
    Bravo ! Vous venez de rejoindre <?= $_POST['nameEntreprise'];?>. Vous allez être redirigé dans quelques instants.
      </div>
<?php
    header ('Refresh: 3;URL=profil.php');
}








?>