<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="css/abonnement/verifAbonnement/style.css" rel="stylesheet"></link>
</head>
<!------ Include the above in your HEAD tag ---------->
<body><?php 
if (isset( $_GET['isEngagement']))  {
    $isEngagement = $_GET['isEngagement'];
}
else {
    $isEngagement='';
}
 ?>
<form action='verifEntreprise.php?isEngagement=<?= $isEngagement;?>' method="post" onsubmit="return checkGlobal(this)">
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
                                            <input type="text" name="nameEntreprise" class="form-control" placeholder="Nom de l'entreprise *" value="" onblur="checknameEntreprise(this)" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="numEntreprise" class="form-control" placeholder="Numéro de téléphone *" value="" onblur="checknumEntreprise(this)"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="numSiret" class="form-control" placeholder="Numéro SIRET/SIREN *" value="" onblur="checknumSiret(this)" />
                                        </div>
                                       
                                       
                                      
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <input type="text" name="adresse" id="adresse" class="form-control"  placeholder="Adresse de l'entreprise *" value="" onblur="checkadresse(this)"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="nbSalarie" class="form-control"  placeholder="Nombre d'employés *" value="" onblur="checknbSalarie(this)"/>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="pays" onblur="checkpays(this)">
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
                                        <?php if(!isset($_GET['isEngagement'])) { ?>
                                            <div class="form-group">
                                            <select class="form-control" name="isEngagement">
                                                <option class="hidden"  selected disabled>Engagement ? </option>
                                                <option>Avec engagement</option>
                                                <option>Sans engagement</option>
                                    
                                            </select>
                                        </div>


                                         <?php } ?>

                                       
                                        <input type="submit" class="btnRegister"  value="Valider"/>
                                    </div>
                                </div>

                            </div>
                            </form>
                            </body>
                            <footer>
                            <script src="js/createEntreprise/main.js"></script>
                            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyUEYzEivgVQJxxot06Z6ZsqfbIR4p_wU&libraries=places&callback=initAutocomplete"
    async defer></script>
                            </footer>