<?php
session_start();

//multilingue
if (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = "fr";
}
include "multilingue/multilingue.php";
loadLanguageFromSession($_SESSION['lang']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>
  <?php
  include 'includehtml/head.html'; ?>
  <link rel="stylesheet" href="css/profil/style.css">
</head>
<body>


  <?php


  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');
  $backOffice=0;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();

  // REQUETE POUR RECUPER LES INFOS DU USER
  $req = $bdd->getPDO()->prepare('SELECT * FROM users WHERE id = ?');
  $req->execute(array($_SESSION['id']));
  $datas = $req->fetch();
  $req->closeCursor();
  $user = new App\Profil($datas['first_name'],$datas['last_name'],$datas['birthday'],$datas['gender'],$datas['address'],$datas['zip_code']);


//CREATION DE L'ABONNEMENT

 $abo = App\Abonnement::createAbonnement($bdd);




  ?>

  <div class="container emp-profile">
    <form method="post">
      <div class="row">
        <div class="col-md-4">
          <div class="profile-img">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>

          </div>
        </div>
        <div class="col-md-6">
          <div class="profile-head">
            <h5 id="mailA" value="<?php echo $_SESSION['email']; ?>">
              <?php echo $_SESSION['email']; ?>
            </h5>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mes informations</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mes abonnements</a>
              </li>
            </ul>
          </div>
        </div>


      </div>
      <div class="row">
        <div class="col-md-4">

        </div>
        <div class="col-md-8">
          <div class="tab-content profile-tab" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="row">
                <div class="col-md-6">
                  <label>Id</label>
                </div>
                <div class="col-md-6">
                  <span id="idProfil" class="datainfo" value="'<?= $_SESSION['id']?>'"><?= $_SESSION['id'] ?></span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Nom</label>
                </div>
                <div class="col-md-6">
                  <div class="gear">
                    <span id="last_name" class="datainfo"><?= $user->getLast_name(); ?></span>
                    <a href="#" class="editlink">Editer</a>
                    <a class="savebtn">Sauvegarder</a>
                  </div>
                </div>
              </div>

                      <div class="row">
                <div class="col-md-6">
                  <label>Adresse</label>
                </div>
                <div class="col-md-6">
                  <div class="gear">
                    <span id="address" class="datainfo"><?= $user->getAddress(); ?></span>
                    <a href="#" class="editlink">Editer</a>
                    <a class="savebtn">Sauvegarder</a>
                  </div>
                </div>
              </div>

                      <div class="row">
                <div class="col-md-6">
                  <label>Code postal</label>
                </div>
                <div class="col-md-6">
                  <div class="gear">
                    <span id="zip_code" class="datainfo"><?= $user->getZipCode(); ?></span>
                    <a href="#" class="editlink">Editer</a>
                    <a class="savebtn">Sauvegarder</a>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label>Prenom</label>
                </div>
                <div class="col-md-6">
                  <div class="gear">
                    <span id="first_name" class="datainfo"><?= $user->getFirst_name(); ?></span>
                    <a href="#" class="editlink">Editer</a>
                    <a class="savebtn" >Sauvegarder</a>
                  </div>


                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Date de naissance</label>
                </div>
                <div class="col-md-6">
                  <div class="gear">
                    <span id="birthday" class="datainfo"><?php
                    setlocale(LC_TIME, "fr_FR","French");
                    $date = strftime("%d %B %Y", strtotime($user->getBirthday()));
                    echo  $date; ?></span>
                    <a href="#" class="editlink">Editer</a>
                    <a class="savebtn" >Sauvegarder</a>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label>Genre</label>
                </div>
                <div class="col-md-6">
                  <div class="gear">
                    <span id="gender" class="datainfo"><?= $user->getGender(); ?></span>
                    <a href="#" class="editlink">Editer</a>
                    <a class="savebtn">Sauvegarder</a>
                  </div>
                </div>
              </div>
            </div>

            <?php if ($abo->getIdAbonnement() == null) {?>

                 <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                 <div class="demo">
    <div class="container">


        <div class="row">

            <div class="col-md-4 col-sm-6">
                <div class="pricingTable">
                    <div class="pricingTable-header">
                        <h3 class="title" data-content="Simple">Simple</h3>
                    </div>
                    <ul class="pricing-content">
                        <li>Tarifs préférentiels</li>
                        <li>Accès aux différents services</li>
                        <li>Soutenir Ride in Pride</li>
                        <li>Sans engagement</li>
                        <li></li>
                    </ul>
                    <div class="price-value">
                        <span class="amount" data-content="28 €">28€ TTC /mois</span>
                    </div>

                    <a href="#" class="pricingTable-signup">Souscrire à l'offre</a>
                </div>

            </div>

            <div class=" offset-md-4 col-md-4 col-sm-6">
                <div class="pricingTable orange">
                    <div class="pricingTable-header">
                        <h3 class="title" data-content="Simple">Simple</h3>
                    </div>
                    <ul class="pricing-content">
                    <li id="0">Tarifs préférentiels</li>
                        <li id="1">Accès aux différents services</li>
                        <li id="2">Soutenir Ride in Pride</li>
                        <li id="3">Engagement sur 12 mois</li>
                        <li></li>
                    </ul>
                    <div class="price-value">
                        <span class="amount" data-content="$20.00">20€ TTC /mois</span>
                    </div>
                    <a href="#" class="pricingTable-signup">Souscrire à l'offre</a>
                </div>

            </div>
        </div>
    </div>
</div>
                                        </div>
            <?php } else {?>


<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


<div class="demo">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="pricingTables">
                    <div class="pricingTable-header">
                        <h3 class="title" data-content="Simple">SIMPLE</h3>
                    </div>
                    <ul class="pricing-content">
                        <li>Date d'achat : <?php
                    setlocale(LC_TIME, "fr_FR","French");
                    $date = strftime("%d/%m/%Y", strtotime($abo->getDateDebut()));
                    echo  $date; ?></li>
                        <li>Date de fin résiliation : <?php
                    setlocale(LC_TIME, "fr_FR","French");
                    $date = strftime("%d/%m/%Y", strtotime($abo->getDateFin()));
                    echo  $date; ?></li>
                        <li>Type d'abonnement : <?php
                         if($abo->getTypeAbonnement() == 1) {
                           echo "Simple";} else if($abo->getTypeAbonnement() == 2){echo "Entreprise";}
                           else{echo "Sans abonnement";}?> </li>
                        <li>Engagement sur 12 mois : <?php
                        if ($abo->getIsEngagement() == 1){
                          echo "Oui"; }
                          else {
                            echo "Non";}?> </li>

                    </ul>
                    <div class="price-value">
                        <span class="amount" data-content="$10.00">// A définir</span>
                    </div>
                    <a href="#" class="pricingTable-signup"></a>
                </div>
            </div>

        </div>
    </div>
</div>



                    <div class="gear">
                    <span id="idAbonnement" class="datainfo" value="'<?= $abo->getIdAbonnement(); ?>'"><?= $abo->getIdAbonnement(); ?></span>
                    <a href="#" class="profile-edit-btn">Supprimer</a>
                  </div>

                                        </div>
                          <?php } ?>


                            </div>


                        </div>

                    </div>
                </div>
            </form>
        </div>
</body>
<script type="text/javascript" src="js/profil/profil.js"></script>
<?php include "includehtml/footer.php" ?>
</html>
