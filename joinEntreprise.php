<?php
namespace App;
use \PDO;
session_start();
require_once __DIR__ .'/require_class.php';

$bdd = new Database('rip');
?>
<!DOCTYPE HTML>
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="css/abonnement/verifAbonnement/style.css" rel="stylesheet">
</head>
<!------ Include the above in your HEAD tag ---------->

<?php


$req = $bdd->getPDO()->prepare('SELECT isDirecteur FROM users WHERE id = :id');
$req->execute(array('id' => $_SESSION['id']));
$unUser = $req->fetch();
if ($unUser['isDirecteur'] == 1)
{
    header('location:profil.php?Deja_directeur');
}
$req = $bdd->getPDO()->prepare('SELECT * FROM `entreprise`');
$req->execute();



?>
<body>
<form  method="post" action="updateEntreprise.php">
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <h3>Ride in Pride</h3>
                        <p>Rejoindre une entreprise</p>
                        
                    </div>
                   
                    <div class="col-md-9 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Rejoindre une entreprise</h3>
                                
                                <div class="row register-form">
                           
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <span >Entreprise :</span>
                                            <select class="form-control" name="nameEntreprise" id="tests">
                                            <option class="" value="Selectionner une entreprise" selected disabled>Selectionner une entreprise</option>
                                            <?php while ($uneEntreprise = $req->fetch()) { ?>
                                                <option class="hidden" id="nameEntreprise" value="<?= $uneEntreprise['nameEntreprise'];?>"   ><?= $uneEntreprise['nameEntreprise'];?></option>
                                           <?php     } ?>
                                                </select>
                                        </div>
                                   

                                        <div class="form-group">
                                        <span >Numéro de téléphone de l'entreprise :</span>
                                            <input type="text" name="numEntreprise" id="numEntreprise" class="form-control" placeholder="<?= $uneEntreprise['numEntreprise'];?>" value="<?= $uneEntreprise['numEntreprise'];?>" disabled/>
                                        </div>
                                        
                                        <div class="form-group">
                                        <span >Numéro SIRET de l'entreprise :</span>
                                            <input type="text" name="numSiret" id="numSiret"class="form-control"  placeholder="<?= $uneEntreprise['numSiret'];?>" value="<?= $uneEntreprise['numSiret'];?>" disabled />
                                        </div>
                                       
                                       
                                       
                                      
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <span >Adresse de l'entreprise :</span>
                                            <input type="text" name="adresse" id="adresse" class="form-control"  placeholder="<?= $uneEntreprise['adresse'];?>" value="<?= $uneEntreprise['adresse'];?>" disabled/>
                                        </div>
                                        <div class="form-group">
                                        <span >Nombre de salariés :</span>
                                            <input type="text" name="nbSalarie" id="nbSalarie" class="form-control"  placeholder="<?= $uneEntreprise['nbSalarie'];?>" value="<?= $uneEntreprise['nbSalarie'];?>" disabled/>
                                        </div>
                                        <div class="form-group">
                                        <span >Pays de l'entreprise :</span>
                                            
                                        <input type="text" name="pays" id="pays" class="form-control"  placeholder="<?= $uneEntreprise['pays'];?>" value="<?= $uneEntreprise['pays'];?>" disabled/>
                                        </div>
                                
                                       
                                        <input type="submit" name="submit" class="btnRegister"  value="Valider"/>
                                    </div>
                                </div>

                            </div>
                            </form>

                            </body>
                            <footer>
                            <script src="js/profil/joinEntreprise/main.js"></script>
                            </footer>