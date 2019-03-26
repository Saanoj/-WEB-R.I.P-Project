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


  <?php include 'includehtml/head.html'; ?>


  <link rel="stylesheet" href="css/profil/style.css">

</head>
<body>
  <script type="text/javascript">
  $(document).ready(function(){
    $('#submitAvatar').on('click', function() {
      console.log("clickkkkkkkkkk");
      id = $('#id').val();
      var file_data = $('#file').prop('files')[0];
      var form_data = new FormData();
      form_data.append('file', file_data);
      $.ajax({
        url: 'ajaxAvatar.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response){
          //$('#message').html(php_script_response); // display response from the PHP script, if any
          if (php_script_response.include("images/avatar/")) {
            alert("Image succesfully loaded");
            var image = document.getElementById("avatar")
            $('#avatar').removeAttr('src');
            image.setAttribute("src", php_script_response);
          }else{
            alert(php_script_response);
          }
        }
      });
    });

    $('#resetAvatar').on('click', function() {

      $.ajax({
        url: 'ajaxResetAvatar.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        type: 'post',
        success: function(php_script_response){
          alert(php_script_response);
        }
      });
    });
  });
  </script>

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
            <img class="img-container" id="avatar" src="images/avatar/<?php echo $datas["avatar"] ?>" alt=""/>
          </div>
          <div class="mt-2">
            <div class="offset-4">
              <button type="button" class="btn" data-toggle="modal" data-target="#modalimage"><span class="glyphicon glyphicon-plus-sign" style="font-size: 30px;"></button>
                <button type="button" class="btn" id="resetAvatar"><span class="glyphicon glyphicon-remove-circle" style="font-size: 30px;"></span></button>
              </div>
              <div class="modal fade" id="modalimage" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Ajoutez votre avatar</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body p-5">
                      <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                        <input class="col-md-8 offset-2" type="file" name="file" id="file">
                        <input type="hidden" name="id" id="id" value="<?php echo $_SESSION["id"]; ?>">
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                      <button id='submitAvatar' class="submit btn btn-primary">Upload</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="profile-head">
              <h5 id="mailA" value="<?php echo $_SESSION['email']; ?>">
                <?php echo $_SESSION['email']; ?>
              </h5>

              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo _TITRE_NAVBAR_INFOS?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><?php echo _TITRE_NAVBAR_ABO?></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="trajet-tab" data-toggle="tab" href="#trajet" role="tab" aria-controls="trajet" aria-selected="false"><?php echo _TITRE_NAVBAR_TRAJETS?></a>
                </li>
                <?php if ($uneEntreprise['idEntreprise'] != null) {?>
                  <li class="nav-item">
                    <a class="nav-link" id="entreprise-tab" data-toggle="tab" href="#entreprise" role="tab" aria-controls="entreprise" aria-selected="false"><?php echo _TITRE_NAVBAR_ENTREPRISE?></a>
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
                    <label><?php echo _TITRE_NAVBAR_INFOS_NOM?></label>
                  </div>
                  <div class="col-md-6">
                    <div class="gear">
                      <span id="last_name" class="datainfo"><?= $user->getLast_name(); ?></span>
                      <a href="#" class="editlink"><?php echo _TITRE_NAVBAR_INFOS_EDITER?></a>
                      <a class="savebtn"><?php echo _TITRE_NAVBAR_INFOS_SAUVEGARDER?></a>
                    </div>
                  </div>
                </div>






              </div>
            </div>
            <?php
            if (checkIfAbonnementValide($bdd) == true) {
              ?>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <a href="abonnement.php"> <button type="button"  class="btn btn-success"><?php echo _TITRE_NAVBAR_ABO_SOUSCRIRE?></button></a>

                <?php
                if (checkIfexistEntreprise($bdd) == true) {?>
                  <a href="deleteEntrepriseFromUser.php"> <button type="button"  class="btn btn-danger"><?php echo _TITRE_NAVBAR_INFOS_QUITTER_ENTREPRISE?></button></a>
                  <?php
                } else { ?>

                  <a href="joinEntreprise.php"> <button type="button"  class="btn btn-info"><?php echo _TITRE_NAVBAR_INFOS_REJOINDRE_ENTREPRISE?></button></a>
                  <a href="createEntreprise.php"> <button type="button"  class="btn btn-info"><?php echo _TITRE_NAVBAR_INFOS_CREER_ENTREPRISE?></button></a>

                <?php  }?>

              </div>
              <?php
            } else { ?>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <a href="showAbonnementProfil.php"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"><?php echo _TITRE_NAVBAR_INFOS_VOIR_INFOS_ABONNEMENTS?></button></a>
                <?php  if (checkIfexistEntreprise($bdd) == true) {?>
                <a href="deleteEntrepriseFromUser.php"> <button type="button"  class="btn btn-danger"><?php echo _TITRE_NAVBAR_INFOS_QUITTER_ENTREPRISE?></button></a>
              </div>
            <?php  } }

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
                    <label><?php echo _TITRE_NAVBAR_INFOS_ADRESSE?></label>
                  </div>
                  <div class="col-md-6">
                    <div class="gear">
                      <span id="address" class="datainfo"><?= $user->getAddress(); ?></span>
                      <a href="#" class="editlink"><?php echo _TITRE_NAVBAR_INFOS_EDITER?></a>
                      <a class="savebtn"><?php echo _TITRE_NAVBAR_INFOS_SAUVEGARDER?></a>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label><?php echo _TITRE_NAVBAR_INFOS_CODE_POSTAL?></label>
                  </div>
                  <div class="col-md-6">
                    <div class="gear">
                      <span id="zip_code" class="datainfo"><?= $user->getZipCode(); ?></span>
                      <a href="#" class="editlink"><?php echo _TITRE_NAVBAR_INFOS_EDITER?></a>
                      <a class="savebtn"><?php echo _TITRE_NAVBAR_INFOS_SAUVEGARDER?></a>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label><?php echo _TITRE_NAVBAR_INFOS_PRENOM?></label>
                  </div>
                  <div class="col-md-6">
                    <div class="gear">
                      <span id="first_name" class="datainfo"><?= $user->getFirst_name(); ?></span>
                      <a href="#" class="editlink"><?php echo _TITRE_NAVBAR_INFOS_EDITER?></a>
                      <a class="savebtn" ><?php echo _TITRE_NAVBAR_INFOS_SAUVEGARDER?></a>
                    </div>


                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label><?php echo _TITRE_NAVBAR_INFOS_DATE_NAISSANCE?></label>
                  </div>
                  <div class="col-md-6">
                    <div class="gear">
                      <span id="birthday" class="datainfo"><?php
                      setlocale(LC_TIME, "fr_FR","French");
                      $date = strftime("%d %B %Y", strtotime($user->getBirthday()));
                      echo  $date; ?></span>
                      <a href="#" class="editlink"><?php echo _TITRE_NAVBAR_INFOS_EDITER?></a>
                      <a class="savebtn" ><?php echo _TITRE_NAVBAR_INFOS_SAUVEGARDER?></a>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label><?php echo _TITRE_NAVBAR_INFOS_GENRE?></label>
                  </div>
                  <div class="col-md-6">
                    <div class="gear">
                      <span id="gender" class="datainfo"><?= $user->getGender(); ?></span>
                      <a href="#" class="editlink"><?php echo _TITRE_NAVBAR_INFOS_EDITER?></a>
                      <a class="savebtn"><?php echo _TITRE_NAVBAR_INFOS_SAUVEGARDER?></a>
                    </div>
                  </div>






                </div>
              </div>
              <?php
              if (checkIfAbonnementValide($bdd) == true) {
                ?>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <a href="abonnement.php"> <button type="button"  class="btn btn-success"><?php echo _TITRE_NAVBAR_ABO_SOUSCRIRE?></button></a>
                  <?php
                  if (checkIfexistEntreprise($bdd) == true) {?>
                    <a href="deleteEntrepriseFromUser.php"> <button type="button"  class="btn btn-danger"><?php echo _TITRE_NAVBAR_INFOS_QUITTER_ENTREPRISE?></button></a>
                    <?php
                  } else { ?>

                    <a href="joinEntreprise.php"> <button type="button"  class="btn btn-info"><?php echo _TITRE_NAVBAR_INFOS_REJOINDRE_ENTREPRISE?></button></a>
                    <a href="createEntreprise.php"> <button type="button"  class="btn btn-info"><?php echo _TITRE_NAVBAR_INFOS_CREER_ENTREPRISE?></button></a>

                  <?php  }?>

                </div>
                <?php
              } else { ?>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <a href="showAbonnementProfil.php"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"><?php echo _TITRE_NAVBAR_INFOS_VOIR_INFOS_ABONNEMENTS?></button></a>
                  <?php  if (checkIfexistEntreprise($bdd) == true) {?>
                    <a href="deleteEntrepriseFromUser.php"> <button type="button"  class="btn btn-danger"><?php echo _TITRE_NAVBAR_INFOS_QUITTER_ENTREPRISE?></button></a>
                  </div>
                <?php  } }

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
    <?php include "includehtml/footer.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/profil/profil.js"></script>

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
