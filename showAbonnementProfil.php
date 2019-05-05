<?php

session_start();
require_once __DIR__.'/require_class.php';

$bdd = new App\Database('rip');

$type = 0;
$navbar = new App\Navbar($type);
$navbar->navbar();

?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset='utf-8'>

  <?php require_once 'includehtml/head.html'; ?>
  <link href="css/abonnement/verifAbonnement/style.css" rel="stylesheet">
</head>

<?php

// Création de l'abonnement
$abo = App\Abonnement::createAbonnement($bdd);

$req = $bdd->getPDO()->prepare('SELECT * FROM linkabonnemententreprise INNER JOIN abonnement INNER JOIN users ON linkabonnemententreprise.idClient =  users.id AND users.id = ? AND linkabonnemententreprise.idAbonnement = abonnement.idAbonnement AND linkabonnemententreprise.idAbonnement = ?');
$req->execute(array($_SESSION['id'],$abo->getIdAbonnement()));
$unAbonnement = $req->fetch();
//var_dump($_SESSION['id']);
//var_dump($unAbonnement);



if ($unAbonnement != false) {
?>
<!-- ENTREPRISE <!-->
<?php if ($unAbonnement['idAbonnement'] == 3 || $unAbonnement['idAbonnement'] == 4)
{

  $req = $bdd->getPDO()->prepare('SELECT * FROM linkabonnemententreprise INNER JOIN abonnement INNER JOIN entreprise ON linkabonnemententreprise.idClient = :idClient AND abonnement.idAbonnement = :idAbonnement AND entreprise.idEntreprise = linkabonnemententreprise.idEntreprise');
  $req->execute(array(
    'idClient' => $_SESSION['id'],
    'idAbonnement' => $unAbonnement['idAbonnement']
  ));
  $uneEntreprise = $req->fetch();
}
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
                <input type="text" id="idSession" value="<?= $_SESSION['id'];?>" hidden>
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
                    <input type="text" name="isEngagement" class="form-control" value="<?php   if ($abo->getIsEngagement() == null) {echo ' ';}
                                if ($abo->getIsEngagement() == 1) { echo 'Oui';}
                                if ($abo->getIsEngagement() == 0 && $abo->getIsEngagement() != null) { echo 'Non';}  ?>" disabled/>
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
                  <?php  if ($unAbonnement['idAbonnement'] == 3 || $unAbonnement['idAbonnement'] == 4)
                  {
                    if ($uneEntreprise['idDirecteur'] == $_SESSION['id']) {?>
                      <a href="profil.php"><button type="button" class="btnRegister" data-toggle="modal" data-target="#exampleModal"onclick="deleteAbonnement()">Supprimer abo</button></a>
                    <?php } }
                    else {?>
                      <a href="profil.php"><button type="button" class="btnRegister" data-toggle="modal" data-target="#exampleModal"onclick="deleteAbonnement()">Supprimer abo</button></a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php }

      $idEntreprise = getIdEntreprise($bdd);

      $req = $bdd->getPDO()->prepare('SELECT * FROM entreprise WHERE idEntreprise = :idEntreprise');
      $req->execute(array('idEntreprise' => $idEntreprise));
      $uneEntreprise = $req->fetch();
                                            ?>

<input type="text" id="idEntreprise" value="<?= $uneEntreprise['idEntreprise'];?>" hidden>
<input type="text" id="idSession" value="<?= $_SESSION['id'] ?>" hidden>
        <div class="container register">
          <div class="row">
            <div class="col-md-3 register-left">
              <h3>Ride in Pride</h3>


            </div>

            <div class="col-md-9 register-right">
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <h3 class="register-heading">Récapitulatif de l'entreprise</h3>
                  <div class="row register-form  pb-0 mb-0">


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
                     <?php
                        if ($uneEntreprise['idDirecteur'] == $_SESSION['id']) {?>
                          <a href="profil.php"><button type="button" class="btnRegister" data-toggle="modal" data-target="#exampleModal"onclick="deleteEntreprise()">Supprimer entreprise</button></a>
                        <?php }?>
                      </div>
                    </div>

                    <?php  if ($unAbonnement['idAbonnement'] == 3 || $unAbonnement['idAbonnement'] == 4)
                    {
                      if ($uneEntreprise['idDirecteur'] == $_SESSION['id']) {?>
                        <div class="row register-form m-0 p-0">
                          <div class="col-md-12 offset-2">
                            
                             <div class="row">
                              <h4>Ajouter un utilisateur a votre entreprise</h4>
                             </div>
                             <div class="row">
                              <h4>Cherchez un utilisateur pour lui envoyer une invitation</h4>
                            </div>

                            <div class="row">
                              <input type="text" name="" placeholder="Chercher un utilisateur..." id="searchUser" value="">
                            </div>
                          </div>
                        </div>
                        <div class="row register-form p-0 m-0">

                            <div id="users" class="offset-4 col-md-8">

                            </div>
                        </div>
                        <div class="row register-form m-0 p-0">
                          <div class="col-md-12 offset-2">
                            <div class="row">
                              <h4>Supprimer/gérer un utilisateur</h4>

                            </div>
                          </div>
                        </div>
                        <div class="row register-form p-0 m-0">
                            <?php
                            $users = $bdd->query('SELECT * FROM users WHERE isBanned = 0 AND idEntreprise = '.$uneEntreprise['idEntreprise'].' AND id != '.$_SESSION['id'].'');
                             ?>
                            <div id="users2" class="offset-4 col-md-8">
                              <?php

                              foreach ($users as $user) {
                                echo "<div class='row p-1' id='rowId".$user["id"]."'><div class='btn btn-primary btnNotif' id='".$user["id"]."' onClick='kickEntreprise(".$user["id"].")'>Kick user</div> ".$user["first_name"]." ".$user["last_name"]."</div>";
                              }
                               ?>
                            </div>
                        </div>
                        <br>
                <?php }
              ?>


                </div>
              </div>
            </div>
          </div>
        </div>
                  <?php } ?>

      </form>

    </body>
<html>


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

        if ($nbSalarie <= 10)
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

    function getIdEntreprise($bdd) {
      $req = $bdd->getPDO()->prepare('SELECT idEntreprise FROM users WHERE id = :id');
      $req->execute(array('id' => $_SESSION['id']));
      $id = $req->fetch();
      $req->closeCursor();
      return $id['idEntreprise'];
  }


    ?>
  
    <script src="js/profil/showAbonnementProfil/main.js"></script>
    <script src="js/showAbonnementProfil/main.js"></script>
    <script src="js/showAbonnementProfil/sendNotif.js"></script>
    <script src="js/showAbonnementProfil/kickEntreprise.js"></script>
 <?php /*   <?php include "includehtml/footer.php" */ ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
