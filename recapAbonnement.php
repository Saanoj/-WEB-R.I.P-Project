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
<meta charset='utf-8'>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="css/abonnement/verifAbonnement/style.css" rel="stylesheet"></link>
</head>
<!------ Include the above in your HEAD tag ---------->
<?php
$req = $bdd->getPDO()->prepare('SELECT * FROM users INNER JOIN abonnement ON users.id = ? AND abonnement.idAbonnement = ?');
$req->execute(array($_SESSION['id'],$_GET['idAbonnement']));
$unAbonnement = $req->fetch();

if ($_GET['isEngagement'] == 0)
{
    $prixTotal = 28;
}
else
{
    $prixTotal = 20;
}

?>
<body>
<form onsubmit="return checkGlobal(this)">

<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <h3>Ride in Pride</h3>
                        <p>Récapitulatif de l'abonnement</p>
                        
                    </div>
                   
                    <div class="col-md-9 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Récapitulatif de l'abonnement</h3>
                                <div class="row register-form">
                                <input type="text" name="success" id="success"  class="form-control"  disabled hidden />
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <span >Votre nom :</span>
                                            <input type="text" name="nameEntreprise" class="form-control" placeholder="<?= $unAbonnement['first_name']." ".$unAbonnement['last_name'];?>" value="<?= $unAbonnement['first_name']." ".$unAbonnement['last_name'];?>" disabled />
                                        </div>
                                        <div class="form-group">
                                        <span >Votre adresse : </span>
                                            <input type="text" name="numEntreprise" class="form-control" placeholder="<?= $unAbonnement['address'];?>" value="<?= $unAbonnement['address'];?>" disabled/>
                                        </div>

                                        <div class="form-group">
                                        <span >Engagement sur 12 mois</span>
                                            <input type="text" name="isEngagement" class="form-control" value="<?php if($_GET['isEngagement'] == 1) {echo "Oui";} else{echo "Non";}?>" disabled/>
                                        </div>

                                        <div class="form-group">
                                        <span >Durée : </span>
                                            <input type="text" name="duree" class="form-control" value="<?php if($_GET['isEngagement'] == 1) {echo "12 mois";} else{echo "Indéterminé";}?>" disabled/>
                                        </div>
                                       
                                       
                                      
                                    </div>
                                    <div class="col-md-6">

                                    <div class="form-group">
                                        <span >Votre genre : </span>
                                            <input type="text" name="numSiret" class="form-control"  placeholder="<?= $unAbonnement['gender'];?>" value="<?= $unAbonnement['gender'];?>" disabled />
                                        </div>
                                    <div class="form-group">
                                    <span >Type d'abonnement : </span>
                                            <input type="text" name="adresse" id="adresse" class="form-control"  placeholder="<?= $unAbonnement['typeAbonnement'];?>" value="<?= $unAbonnement['typeAbonnement'];?>" disabled/>
                                        </div>
                                        <div class="form-group">
                                        <span >Prix total : </span>
                                            <input type="text" name="nbSalarie" class="form-control"   value="<?= $prixTotal.'€/mois';?>" disabled/>

                                          
                                        </div>
                                       
                                    </div>
                                </div>

                            </div>
                            </form>

                            </body>

                            <footer>
                            <script src="js/abonnement/recapAbonnement/main.js"></script>
                            </footer>