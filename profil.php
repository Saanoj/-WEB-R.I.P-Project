<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>


  <?php require_once 'includehtml/head.html'; ?>

  <title>Profil</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/profil/style.css">

</head>
<body class="bg-secondary">
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

          if (php_script_response.includes("images/avatar/")) {
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


  require_once 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');
  $type = 0;
  $navbar = new App\Navbar($type);
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
            <p><?php echo $datas['email'] ?></p>
            <p class="proile-rating">Notes : <span>10/10</span></p>
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
        <?php /* ?>
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
          <?php */ ?>
        </div>


        <div class="col-md-8">
          <div class="tab-content profile-tab" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
              <div class="row">
                <div class="col-md-12">
                  <h4>Espace collaborateur</h4>

                  <?php if ($_SESSION['isCollaborateur']==0) { ?>
                    <a class="btn btn-dark" href="inscriptionCollab.php">Inscription Collaborateur</a>
                  <?php }else{ ?>
                    <a class="btn btn-dark" href="homeCollab.php">Espace Collaborateur</a>
                  <?php } ?>

                </div>
              </div>

              <div class="dropdown-divider"></div>

              <div class="row">
                <div class="col-md-12">
                  <h4>Invitation a des entreprises</h4>

                  <?php
                  $invitations = $bdd->query('SELECT * FROM notifentreprise WHERE idClient = '.$_SESSION["id"].'',$bdd);

                  if (sizeof($invitations) == 0) {
                    echo "Vous n'avez aucune invitation à une entreprise";
                  } else {
                    foreach ($invitations as $invitation) {

                      $entreprise = $bdd->queryOne('SELECT * FROM entreprise WHERE idEntreprise = '.$invitation['idEntreprise'].'');

                      echo "<div id='inviteID".$entreprise["idEntreprise"]."'><p class='row pl-3'>Vous avez été invité par ".$entreprise["nameEntreprise"]." pour le service d'abonnement <button class='mr-2 ml-2' onclick='acceptInvite(".$invitation['idEntreprise'].",".$_SESSION["id"].")'> Accepter </button> <button class='' onclick='refuseInvite(".$invitation['idEntreprise'].",".$_SESSION["id"].")'> Refuser </button></p>";
                      echo "<div class='dropdown-divider'></div></div>";
                    }
                  }

                   ?>



                </div>
              </div>

              <div class="dropdown-divider"></div>

              <div class="row">
                <div class="col-md-5">
                  <h4>Mes informations</h4>
                  <!-- Button to Open the Modal -->
                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myInformations">
                    Ouvrir
                  </button>
                </div>

                <div class="col-md-5">
                  <h4>Mon entreprise</h4>
                  <!-- Button to Open the Modal -->
                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myCompany">
                    Ouvrir
                  </button>
                </div>
                </div>
                <div class="row">
                <div class="col-md-5">

                  <h4>Mon abonnement</h4>
                  <!-- Button to Open the Modal -->
                  <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#mySubscription">
                    Ouvrir
                  </button>
                </div>

              <div class="col-md-5">
              <h4>Mes trajets</h4>
              <!-- Button to Open the Modal -->
              <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myTrajet">
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
                    <form method="post">
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
                            <span id="first_name" class="datainfo"><?= $user->getFirst_name(); ?></span>
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
                      </form>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



              <!-- The Modal -->
              <div class="modal fade" id="myCompany">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Informations de mon entreprise</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
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



                          <?php

                if (checkIfexistEntreprise($bdd) == true) {?>

                <div>
                  <a href="deleteEntrepriseFromUser.php"> <button type="button"  class="btn btn-danger"><?php echo _TITRE_NAVBAR_INFOS_QUITTER_ENTREPRISE?></button></a>
                  </div>
                  <br>
                  <div>
                  <a href="showAbonnementProfil.php"><button type="button" class="btn btn-info"><?php echo 'Voir les informations de l\'entreprise';?></button></a>
                  </div>
                  <br>
                  <?php
                } else { ?>
                  <div>
                  <a href="joinEntreprise.php"> <button type="button"  class="btn btn-info"><?php echo _TITRE_NAVBAR_INFOS_REJOINDRE_ENTREPRISE?></button></a>
                  </div>
                  <br>
                  <div>
                  <a href="createEntreprise.php"> <button type="button"  class="btn btn-info"><?php echo _TITRE_NAVBAR_INFOS_CREER_ENTREPRISE?></button></a>
                  </div>

                <?php  }?>

              </div>
           </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>






              <!-- The Modal -->
              <div class="modal fade" id="mySubscription">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Informations de mon abonnement</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                          <div class="row">
                            <div class="col-md-6">
                              <label>Id de l'abonnement</label>
                            </div>
                            <div class="col-md-6">
                              <span id="idAbonnement" class="datainfo" value="'<?= $abo->getIdAbonnement();?>'"><?= $abo->getIdAbonnement(); ?></span>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <label>Type de l'abonnement</label>
                            </div>
                            <div class="col-md-6">
                              <div class="gear">
                                <span id="typeAbonnement" class="datainfo"><?= $abo->getTypeAbonnement(); ?></span>

                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <label>Engagement sur 12 mois.</label>
                            </div>
                            <div class="col-md-6">
                              <div class="gear">
                                <span id="isEngagement" class="datainfo"><?php if ( $abo->getIsEngagement() == 1) { echo 'Oui';} if ( $abo->getIsEngagement() == 0) { echo 'Non';} else {
                                  echo ' ';}?></span>


                              </div>
                            </div>
                          </div>
                        <?php if ($abo->getIdAbonnement() != null) {?>
                       <a href="showAbonnementProfil.php"><button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"><?php echo _TITRE_NAVBAR_INFOS_VOIR_INFOS_ABONNEMENTS?></button></a>
                        <?php } ?>
                    </div>
                    <div>
                    <?php
                    if (checkIfAbonnementValide($bdd) == true) {
                      ?>
                    <a href="abonnement.php"> <button type="button"  class="btn btn-success"><?php echo _TITRE_NAVBAR_ABO_SOUSCRIRE?></button></a> <?php } ?>
                    </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>







<div id="myTrajet" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

            <h4 class="modal-title">Mes trajets</h4>
            </div>
            <div class="modal-body">
            <div class="row">
            <div class="offset-md-1 md-3">
            <div><p> Vous pouvez consulter vos trajets ici.</p></div>
            </div>
            </div>
            <div class="row">
            <div class="offset-md-4 md-3">
                <a href="#myOldTrajet" role="button" class="btn btn-primary" data-toggle="modal">Mes anciens trajets</a>
                </div>
                </div>
                <br>
                <br>
                <div class="row">
                <div class="offset-md-4 md-3">
                <a href="#myTrajetEnCours" role="button" class="btn btn-primary" data-toggle="modal">Mes trajets en cours</a>
                </div>
                </div>
                <br>
                <br>
                <div class="row">
                <div class="offset-md-4 md-3">
                <a href="#myNextTrajet" role="button" class="btn btn-primary" data-toggle="modal">Mes prochains trajets</a>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
             </div>
              </div>


        </div>
    </div>
</div>

<div id="myOldTrajet" class="modal fade modal-child" data-backdrop-limit="1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-modal-parent="#myTrajet">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Mes anciens trajets</h4>
            </div>
            <div class="modal-body">
            <?php
        $reqTrajet = getTrajets($bdd,"Finis");
            while ($trajet = $reqTrajet->fetch())
        {
          ?>
          <div class="row">
            <div class=" col-md-8">
              <?php
              $destination = 'factures/facture'.$trajet['idTrajet'].'.pdf';
              echo ' <p>Numéro de trajet : '. $trajet['idTrajet'] . ' | Voir le récapitulatif : '
              ?> <a href="<?= $destination;?>" target=_blank><button type="button" class="btn btn-info" id="<?=$trajet['idTrajet'];?>">Cliquer ici</button></a>
              <?php echo "</p>"; ?>
            </div>
          <!-- Rating old trips part :) -->
          <div class="col-md-4">

              <select id="<?php echo "input".$trajet['idTrajet'] ?>">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5" selected="true">5</option>
              </select>
              <button type="button" name="buttonRating" class="ratingbtn" onclick="validateRating(<?php echo $trajet['idTrajet'] ?>)">Valider rating</button>
          </div>
          </div>
          <?php
        }
        $reqTrajet->closeCursor();

        ?>
            </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
             </div>

        </div>
    </div>
</div>

<div id="myTrajetEnCours" class="modal fade modal-child" data-backdrop-limit="1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-modal-parent="#myTrajet">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Mes trajets en cours</h4>
            </div>
            <div class="modal-body">
            <?php

        $reqTrajet = getTrajets($bdd,"En cours");
            while ($trajet = $reqTrajet->fetch())
        {
          ?>
          <div class="row">
          <div class="offset-md-1 md-3">
          <?php
          $destination = 'factures/facture'.$trajet['idTrajet'].'.pdf';
          echo 'Numéro de trajet : '. $trajet['idTrajet'] . ' | Voir le récapitulatif : '  ?> <a href="<?= $destination;?>" target=_blank><button type="button" class="btn btn-info" id="<?=$trajet['idTrajet'];?>">Cliquer ici</button></a>
          <br>
          <br>
          </div>
          </div>
          <?php
        }
        $reqTrajet->closeCursor();



        ?>
            </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                      </div>

        </div>
    </div>
</div>

<div id="myNextTrajet" class="modal fade modal-child" data-backdrop-limit="1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-modal-parent="#myTrajet">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Vos trajets finis</h4>
            </div>
            <div class="modal-body">
            <?php

        $reqTrajet = getTrajets($bdd,"Pas commencé");
            while ($trajet = $reqTrajet->fetch())
        {
          ?>
          <div class="row">
          <div class="offset-md-1 md-3">
          <?php
          $destination = 'factures/facture'.$trajet['idTrajet'].'.pdf';
          echo 'Numéro de trajet : '. $trajet['idTrajet'] . ' | Voir le récapitulatif : '  ?> <a href="<?= $destination;?>" target=_blank><button type="button" class="btn btn-info" id="<?=$trajet['idTrajet'];?>">Cliquer ici</button></a>
          <br>
          <br>
          </div>
          </div>
          <?php
        }
        $reqTrajet->closeCursor();



        ?>
            </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                      </div>

        </div>
    </div>
</div>



            </div>
          </div>
        </div>
      </div>
    </div>


  </body>
  <?php include "includehtml/footer.php" ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/profil/profil.js"></script>
  <script type="text/javascript" src="js/profil/jsAjax.js"></script>



  <script type="text/javascript">

    function validateRating(idTrajet){

      var input = document.getElementById("input" + idTrajet );

      updateRating(input.value, idTrajet);
    }

    function updateRating(rating, idTrajet)
    {
    	datas='rating=' + rating + '&idTrajet=' + idTrajet;

    	$.ajax({
            url: "updateRating.php",
            type: "post",
            data: datas ,
            success: function (response) {
                alert(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }


        });
    }
  </script>

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

    $req = $bdd->getPDO()->prepare('SELECT idEntreprise FROM users WHERE id = ?');
    $req->execute(array($_SESSION['id']));
    $unProfil = $req->fetch();
    $req = $bdd->getPDO()->prepare('SELECT * FROM `entreprise` WHERE idEntreprise = :idEntreprise');
    $req->execute(array("idEntreprise" => $unProfil['idEntreprise']));
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

  function getTrajets($bdd,$state) {
    $req = $bdd->getPDO()->prepare('SELECT * FROM trajet WHERE idClient = :idClient AND state = :state ORDER BY idTrajet ASC LIMIT 10');
    $req->execute(array(
      'idClient' => $_SESSION['id'],
      'state' => $state));
      return  $req;
  }



  ?>
