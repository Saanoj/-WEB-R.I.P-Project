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

$req = $bdd->getPDO()->prepare('SELECT * FROM `entreprise` INNER JOIN abonnement where entreprise.idDirecteur = idDirecteur');
$req->execute(array("idDirecteur" => $_SESSION['id']));
$uneEntreprise = $req->fetch();


    
    $nbSalarie = $uneEntreprise['nbSalarie'];
    $count=0;
    if ($nbSalarie <= 10)
    {
        $prixTotal = 65;
    }
    if ($nbSalarie > 10 )
    {
        
        for ($i=$nbSalarie;$i>0;)
        {
            $count +=1;
            $i -=10;
         
        }

        $prixTotal = 85+(12*$count);

    }

?>
<body>
<form  method="post" action="verifConfigAbonnementEntreprise.php?isEngagement='<?= $_GET['isEngagement'];?>'">
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <h3>Ride in Pride</h3>
                        <p>Confirmation de l'abonnement de votre entreprise</p>
                        
                    </div>
                   
                    <div class="col-md-9 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Confirmation d'abonnement</h3>
                                <div class="row register-form">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <span >Nom de l'entreprise :</span>
                                            <input type="text" name="nameEntreprise" class="form-control" placeholder="<?= $uneEntreprise['nameEntreprise'];?>" value="<?= $uneEntreprise['nameEntreprise'];?>" disabled />
                                        </div>
                                        <div class="form-group">
                                        <span >Numéro de téléphone de l'entreprise :</span>
                                            <input type="text" name="numEntreprise" class="form-control" placeholder="<?= $uneEntreprise['numEntreprise'];?>" value="<?= $uneEntreprise['numEntreprise'];?>" disabled/>
                                        </div>
                                        
                                        <div class="form-group">
                                        <span >Numéro SIRET de l'entreprise :</span>
                                            <input type="text" name="numSiret" class="form-control"  placeholder="<?= $uneEntreprise['numSiret'];?>" value="<?= $uneEntreprise['numSiret'];?>" disabled />
                                        </div>
                                        <div class="form-group">
                                        <span >Engagement sur 12 mois</span>
                                            <input type="text" name="isEngagement" class="form-control" value="<?php if($_GET['isEngagement'] == 1) {echo "Oui";} else{echo "Non";}?>" disabled/>
                                        </div>
                                       
                                       
                                      
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                    <span >Adresse de l'entreprise :</span>
                                            <input type="text" name="adresse" id="adresse" class="form-control"  placeholder="<?= $uneEntreprise['adresse'];?>" value="<?= $uneEntreprise['adresse'];?>" disabled/>
                                        </div>
                                        <div class="form-group">
                                        <span >Nombre de salariés :</span>
                                            <input type="text" name="nbSalarie" class="form-control"  placeholder="<?= $uneEntreprise['nbSalarie'];?>" value="<?= $uneEntreprise['nbSalarie'];?>" disabled/>
                                        </div>
                                        <div class="form-group">
                                        <span >Pays de l'entreprise :</span>
                                            <select class="form-control" name="pays"  >
                                                <option class="hidden" value="<?= $uneEntreprise['nbSalarie'];?>" selected disabled><?= $uneEntreprise['pays'];?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        <span >Prix total : </span>
                                            <input type="text" name="nbSalarie" class="form-control"   value="<?= $prixTotal.'€/mois';?>" disabled/>

                                          
                                        </div>
                                       
                                        <input type="submit" class="btnRegister"  value="Valider"/>
                                    </div>
                                </div>

                            </div>
                            </form>

                            </body>
                            <footer>
                            </footer>