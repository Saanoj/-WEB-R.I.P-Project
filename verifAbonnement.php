<?php 
namespace App;
use \PDO;
session_start();
require 'Class/Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="css/abonnement/verifAbonnement/style.css" rel="stylesheet"></link>
<!------ Include the above in your HEAD tag ---------->
<form action="verifEntreprise.php" method="post">
<div class="container register">
                <div class="row">
                    <div class="col-md-3 register-left">
                        <h3>Ride in Pride</h3>
                        <p>Renseignez les informations de votre entreprise</p>
                        
                    </div>
                   
                    <div class="col-md-9 register-right">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <h3 class="register-heading">Enrengistrer votre entreprise</h3>
                                <div class="row register-form">
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="nameEntreprise" class="form-control" placeholder="Nom de l'entreprise *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="numEntreprise" class="form-control" placeholder="Numéro de téléphone *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="numSiret" class="form-control" placeholder="Numéro SIRET/SIREN *" value="" />
                                        </div>
                                       
                                       
                                      
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <input type="text" name="adresse" class="form-control"  placeholder="Adresse de l'entreprise *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="nbSalarie" class="form-control"  placeholder="Nombre d'employés *" value="" />
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="pays">
                                                <option class="hidden"  selected disabled>Selectionner votre pays</option>
                                                <option>France</option>
                                                <option>Belgique</option>
                                                <option>Allemagne</option>
                                                <option>Suisse</option>
                                                <option>Angleterre</option>
                                                <option>Espagne</option>
                                                <option>Portugal</option>
                                                <option>Irlande</option>
                                                <option>Finlande</option>
                                            </select>
                                        </div>
                                       
                                        <input type="submit" class="btnRegister"  value="Valider"/>
                                    </div>
                                </div>

                            </div>
                            </form>

<?php
switch ($_POST['submit'])
{
    case 'engagementStandard':
    $isEngagement = 1;
    $typeAbonnement = 'Standard';
    $dateFin=date("Y-m-d", strtotime("+1 year"));
    req($isEngagement,$typeAbonnement,$dateFin,$bdd);
    break;

    case 'nonEngagementStandard':
    $isEngagement = 0;
    $typeAbonnement = 'Standard';
    $dateFin=date("Y-m-d", strtotime("+10 year"));
    req($isEngagement,$typeAbonnement,$dateFin,$bdd);
    break;

    case 'nonEngagementEntreprise':
    $isEngagement = 0;
    $typeAbonnement = 'Entreprise';
    $dateFin=date("Y-m-d", strtotime("+10 year"));
    req($isEngagement,$typeAbonnement,$dateFin,$bdd);
    break;

    case 'engagementEntreprise':
    $isEngagement = 1;
    $typeAbonnement = 'Entreprise';
    $dateFin=date("Y-m-d", strtotime("+1 year"));
    req($isEngagement,$typeAbonnement,$dateFin,$bdd);
    break;

    default:
    header('location:abonnement.php');
    break;
}


function req($isEngagement,$typeAbonnement,$dateFin,$bdd)
{
    $req = $bdd->getPDO()->prepare('INSERT INTO abonnement(idClient,dateDebut,dateFin,typeAbonnement,isEngagement) VALUES(:idClient,NOW(),:dateFin,:typeAbonnement,:isEngagement)');
    $req->execute(array(
        'idClient' => $_SESSION['id'],
        'dateFin' => $dateFin,
        'typeAbonnement' => $typeAbonnement,
        'isEngagement' => $isEngagement
    ));
}
?>
