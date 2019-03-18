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
$req = $bdd->getPDO()->prepare('SELECT * FROM users INNER JOIN abonnement INNER JOIN linkabonnemententreprise ON users.id = ? AND abonnement.idAbonnement = linkabonnemententreprise.idAbonnement');
$req->execute(array($_SESSION['id']));
$unAbonnement = $req->fetch();
?>
<body>
<form action="profil.php">

<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <h3>Ride in Pride</h3>
                        
                    </div>
                   
                    <div class="col-md-9 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Récapitulatif de l'abonnement</h3>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <span >Votre type d'abonnement :</span>
                                            <input type="text" name="typeAbonnement" class="form-control" placeholder="<?= $unAbonnement['typeAbonnement'];?>" value="<?= $unAbonnement['typeAbonnement'];?>" disabled />
                                        </div>
                                        <div class="form-group">
                                        <span >Abonnement d'entreprise : </span>
                                            <input type="text" name="idEntreprise" class="form-control" placeholder="<?php if ($unAbonnement['idEntreprise'] == NULL){echo 'Non';}else{echo 'Oui';};?>" value="<?php if ($unAbonnement['idEntreprise'] == NULL){echo 'Non';}else{echo 'Oui';};?>" disabled/>
                                        </div>

                                        <div class="form-group">
                                        <span >Engagement sur 12 mois</span>
                                            <input type="text" name="isEngagement" class="form-control" value="<?php if($unAbonnement['isEngagement'] == 1) {echo "Oui";} else{echo "Non";}?>" disabled/>
                                        </div>

                                      
                                       
                                       
                                      
                                    </div>
                                    <div class="col-md-6">

                                    <div class="form-group">
                                        <span >Date de début :  </span>
                                            <input type="text" name="dateDebut" class="form-control"  placeholder="<?= $unAbonnement['dateDebut'];?>" value="<?= $unAbonnement['dateDebut'];?>" disabled />
                                        </div>
                                    <div class="form-group">
                                    <span >Date de fin : </span>
                                            <input type="text" name="dateFin" id="dateFin" class="form-control"  placeholder="<?= $unAbonnement['dateFin'];?>" value="<?= $unAbonnement['dateFin'];?>" disabled/>
                                        </div>
                                        <div class="form-group">
                                        <span >Prix /mois : </span>
                                            <input type="text" name="prixTotal" class="form-control"   value="<?= prixTotal($unAbonnement,$bdd).'€/mois';?>" disabled/> 
                                        </div>

                                    
                                        <input type="submit" class="btnRegister"  value="Profil"/>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            

                            <!-- ENTREPRISE <!-->
                            <?php if ($unAbonnement['idAbonnement'] == 3 || $unAbonnement['idAbonnement'] == 4)
                            $req = $bdd->getPDO()->prepare('SELECT * FROM `entreprise` INNER JOIN abonnement where entreprise.idDirecteur = idDirecteur AND abonnement.idAbonnement = 4');
                            $req->execute(array("idDirecteur" => $_SESSION['id']));
                            $uneEntreprise = $req->fetch();
                            { ?>
                            <div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <h3>Ride in Pride</h3>
                        
                        
                    </div>
                   
                    <div class="col-md-9 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Récapitulatif de l'entreprise</h3>
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
                                            <input type="text" name="isEngagement" class="form-control" value="<?php if($unAbonnement['isEngagement'] == 1) {echo "Oui";} else{echo "Non";}?>" disabled/>
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
                                       
                                       
                                        <input type="submit" class="btnRegister"  value="Profil"/>
                                    </div>
                                </div>

                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <?php } ?>
                            </form>

                            </body>

                            <footer>
                            </footer>

                            <?php

                            function prixTotal($unAbonnement,$bdd)
                            {
                                $req = $bdd->getPDO()->prepare('SELECT * FROM `entreprise` INNER JOIN abonnement where entreprise.idDirecteur = idDirecteur');
                                    $req->execute(array("idDirecteur" => $_SESSION['id']));
                                    $uneEntreprise = $req->fetch();
                                    $nbSalarie = $uneEntreprise['nbSalarie'];
                                    $count=0;
                                if ($unAbonnement['idAbonnement'] == 1)
                                {
                                    $prix = 28;
                                }
                                else if ($unAbonnement['idAbonnement'] == 2)
                                {
                                    $prix = 20;
                                }
                                else if ($unAbonnement['idAbonnement'] == 3)
                                {
                                    
                                    if ($nbSalarie < 10)
                                    {
                                        $prix = 80;
                                    }
                                    if ($nbSalarie > 10 )
                                    {
                                        
                                        for ($i=$nbSalarie;$i>0;)
                                        {
                                            $count +=1;
                                            $i -=10;
                                         
                                        }
                                
                                        $prix = 100+(15*$count);
                                
                                    }
                                }
                                else 
                                {
                                
                                    if ($nbSalarie < 10)
                                    {
                                        $prix = 65;
                                    }
                                    if ($nbSalarie > 10 )
                                    {
                                        
                                        for ($i=$nbSalarie;$i>0;)
                                        {
                                            $count +=1;
                                            $i -=10;
                                         
                                        }
                                
                                        $prix = 85+(12*$count);
                                
                                    }
                                }

                                return $prix;

                            }


?>