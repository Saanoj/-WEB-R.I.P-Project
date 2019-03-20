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


  // On obtients les informations de l'entreprise

  $uneEntreprise = infosEntreprise($bdd);
  //CREATION DE L'ABONNEMENT

  $abo = App\Abonnement::createAbonnement($bdd);
  // serialize($abo);




  ?>

  <div class="container emp-profile bg-light rounded">
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
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mes abonnements/Mon entreprise</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="trajet-tab" data-toggle="tab" href="#trajet" role="tab" aria-controls="trajet" aria-selected="false">Mes trajets</a>
              </li>
              <?php if ($uneEntreprise['idEntreprise'] != null) {?>
              <li class="nav-item">
                <a class="nav-link" id="entreprise-tab" data-toggle="tab" href="#entreprise" role="tab" aria-controls="entreprise" aria-selected="false">Mon entreprise</a>
              </li>
              <?php } ?>
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
            <?php
            if (checkIfAbonnementValide($bdd) == true) { 
              ?>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
             <a href="abonnement.php"> <button type="button"  class="btn btn-success">Souscrire à un abonnement</button></a>
             <?php 
             if (checkIfexistEntreprise($bdd) == true) {?>
              <a href="deleteEntrepriseFromUser.php"> <button type="button"  class="btn btn-danger">Quitter/Supprimer une entreprise</button></a>
               <?php
             } else { ?>
               
               <a href="joinEntreprise.php"> <button type="button"  class="btn btn-info">Rejoindre une entreprise</button></a>
               <a href="createEntreprise.php"> <button type="button"  class="btn btn-info">Créer une entreprise</button></a>

            <?php  }?>
            
            </div>
           <?php
             } else { ?>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <a href="showAbonnementProfil.php"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"> Voir les informations de mon abonnements</button></a>
            </div>
             <?php  } 
          
            ?>


                <div class="tab-pane fade" id="trajet" role="tabpanel" aria-labelledby="trajet-tab">

                  <div class="card">
                    <div class="card-header">
                      <div class="display-4">Vos trajets</div>
                    </div>
                    <div class="card-body ">

                    <?php
                    $trajets = $bdd->queryPrepareForWhile("SELECT * FROM trajet WHERE idClient=".$_SESSION["id"]."",$bdd);

                    while ($trajet = $trajets->fetch()) {
                      echo "<div class='row list-group-item'>";
                      echo "<p>ID:".$trajet["idTrajet"]."<p><div class='h4'>".$trajet["debut"]." <div class='glyphicon glyphicon-arrow-right'></div> ".$trajet["fin"]."</div>";
                      echo "<p>".$trajet["duration"]."<p>";
                      echo "<button class='btn btn-success p-3'>PDF</button>";
                      echo "</div>";
                    }
                     ?>
                  </div>
                </div>
              </div>

           
          

                     

    <?php //// DEBUT ENTREPRISE ?>
          <div class="tab-content entreprise-tab" id="myTabContent">
          <div class="tab-pane fade" id="entreprise" role="tabpanel" aria-labelledby="entreprise-tab">
              <div class="row">
                <div class="col-md-6">
                  <label>Id de l'entreprise</label>
                </div>
                <div class="col-md-6">
                  <span id="idEntreprise" class="datainfo" value="'<?= $uneEntreprise['idEntreprise'];?>'"><?= $uneEntreprise['idEntreprise']; ?></span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label>Nom de l'entreprise</label>
                </div>
                <div class="col-md-6">
                  <div class="gear">
                    <span id="nameEntreprise" class="datainfo"><?= $uneEntreprise['nameEntreprise']; ?></span>
                    <?php if($uneEntreprise['idDirecteur'] == $_SESSION['id']) {?>
                    <a href="#" class="editlink">Editer</a>
                    <a class="savebtn">Sauvegarder</a>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label>Adresse de l'entreprise</label>
                </div>
                <div class="col-md-6">
                  <div class="gear">
                    <span id="adresse" class="datainfo"><?= $uneEntreprise['adresse']; ?></span>
                    <?php if($uneEntreprise['idDirecteur'] == $_SESSION['id']) {?>
                    <a href="#" class="editlink">Editer</a>
                    <a class="savebtn">Sauvegarder</a>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label>Numéro de l'entreprise</label>
                </div>
                <div class="col-md-6">
                  <div class="gear">
                    <span id="numEntreprise" class="datainfo"><?= $uneEntreprise['numEntreprise']; ?></span>
                    <?php if($uneEntreprise['idDirecteur'] == $_SESSION['id']) {?>
                    <a href="#" class="editlink">Editer</a>
                    <a class="savebtn">Sauvegarder</a>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label>Numéro SIRET de l'entreprise</label>
                </div>
                <div class="col-md-6">
                  <div class="gear">
                    <span id="numSiret" class="datainfo"><?= $uneEntreprise['numSiret']; ?></span>
                    <?php if($uneEntreprise['idDirecteur'] == $_SESSION['id']) {?>
                    <a href="#" class="editlink">Editer</a>
                    <a class="savebtn" >Sauvegarder</a>
                    <?php } ?>
                  </div>
                </div>
              </div>

          
          

<?php // -------- DELIMITATION ENTREPRISE ?>

              
              </div>
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
<?php
      function checkIfAbonnementValide($bdd) 
            {
            $req = $bdd->getPDO()->prepare('SELECT * FROM linkabonnemententreprise WHERE idClient = :idClient');
            $req->execute(array('idClient' => $_SESSION['id']));
            $req->closeCursor();
            if ($req->rowCount() == 0)
            {
                return true;
            }
            else
            {
                return false;
            }
            }

            function infosEntreprise($bdd)
            {
              $req = $bdd->getPDO()->prepare('SELECT * FROM `entreprise` WHERE idDirecteur = idDirecteur');
              $req->execute(array("idDirecteur" => $_SESSION['id']));
              return $req->fetch();
              $req->closeCursor();

            }

            function checkIfexistEntreprise($bdd) 
            {
            $req = $bdd->getPDO()->prepare('SELECT * FROM users WHERE idEntreprise > 0 AND id = :id');
            $req->execute(array('id' => $_SESSION['id']));
            $req->closeCursor();
            if ($req->rowCount() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
            }

            
            ?>