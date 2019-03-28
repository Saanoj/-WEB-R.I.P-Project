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

  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

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

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                <div class="col-md-4 mb-5">
          <div class="profile-img">
            <img class="img-container" id="avatar" src="images/avatar/<?php echo $datas["avatar"] ?>" alt=""/>
          </div>
          <div class="mt-2">
            <div class="offset-4">
              <button type="button" class="btn" data-toggle="modal" data-target="#modalimage"><span class="fas fa-plus" style="font-size: 30px;"></button>
                <button type="button" class="btn " id="resetAvatar"><span class="fas fa-minus" style="font-size: 30px;"></span></button>
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
                                    <h5>
                                        <?= $user->getFirst_Name()." ". $user->getLast_Name(); ?>
                                    </h5>
                                    <h6>
                                        <?php if ($datas['isAdmin'] == 1)
                                        {
                                          echo 'Administrateur';
                                        }
                                        else
                                        {
                                          echo 'Membre';
                                        }
                                        ?>
                                    </h6>
                                    <p class="proile-rating">Notes : <span>8/10</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Information</a>
                                </li>   
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p>Informations</p>
                            <a href="">A définir</a><br/>
                            <a href="">A définir</a><br/>
                            <a href="">A définir</a>
                            <p>Compétences</p>
                            <a href="">A définir</a><br/>
                            <a href="">A définir</a><br/>
                            <a href="">A définir</a><br/>
                            <a href="">A définir</a><br/>
                            <a href="">A définir</a><br/>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
<div class="row">
   <div class="col-md-4">                         
  <h2>Mes informations</h2>
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myInformations">
    Ouvrir
  </button>
  </div>

  <div class="col-md-4">                         
  <h2>Mon entreprise</h2>
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myCompany">
    Ouvrir
  </button>
  </div>
  <div class="col-md-4">                         

  <h2>Mon abonnement</h2>
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mySubscription">
    Ouvrir
  </button>
  </div>
  </div>

  <!-- The Modal -->
  <div class="modal fade" id="myInformations">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Informations</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          
        <div class="row">
                                            <div class="col-md-6">
                                                <label>Id utilisateur</label>
                                            </div>
                                            <div class="col-md-6">
                                            <p><span id="idProfil" class="datainfo" value="'<?= $_SESSION['id']?>'"><?= $_SESSION['id'] ?></span></p>

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
                                        <div class="row">
                                            <div class="col-md-6">
                                            <label><?php echo _TITRE_NAVBAR_INFOS_PRENOM?></label>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="gear">
                                            <span id="last_name" class="datainfo"><?= $user->getLast_name(); ?></span>
                                            <a href="#" class="editlink"><?php echo _TITRE_NAVBAR_INFOS_EDITER?></a>
                                            <a class="savebtn"><?php echo _TITRE_NAVBAR_INFOS_SAUVEGARDER?></a>
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
                                            <label><?php echo _TITRE_NAVBAR_INFOS_ADRESSE?></label>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="gear">
                                            <span id="last_name" class="datainfo"><?= $user->getAddress(); ?></span>
                                            <a href="#" class="editlink"><?php echo _TITRE_NAVBAR_INFOS_EDITER?></a>
                                            <a class="savebtn"><?php echo _TITRE_NAVBAR_INFOS_SAUVEGARDER?></a>
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
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </div>




  <!-- The Modal -->
  <div class="modal fade" id="myCompany">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Informations</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          
        <div class="row">
                                            <div class="col-md-6">
                                                <label>Id utilisateur</label>
                                            </div>
                                            <div class="col-md-6">
                                            <p><span id="idProfil" class="datainfo" value="'<?= $_SESSION['id']?>'"><?= $_SESSION['id'] ?></span></p>

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
                                        <div class="row">
                                            <div class="col-md-6">
                                            <label><?php echo _TITRE_NAVBAR_INFOS_PRENOM?></label>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="gear">
                                            <span id="last_name" class="datainfo"><?= $user->getLast_name(); ?></span>
                                            <a href="#" class="editlink"><?php echo _TITRE_NAVBAR_INFOS_EDITER?></a>
                                            <a class="savebtn"><?php echo _TITRE_NAVBAR_INFOS_SAUVEGARDER?></a>
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
                                            <label><?php echo _TITRE_NAVBAR_INFOS_ADRESSE?></label>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="gear">
                                            <span id="last_name" class="datainfo"><?= $user->getAddress(); ?></span>
                                            <a href="#" class="editlink"><?php echo _TITRE_NAVBAR_INFOS_EDITER?></a>
                                            <a class="savebtn"><?php echo _TITRE_NAVBAR_INFOS_SAUVEGARDER?></a>
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
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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
