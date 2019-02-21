<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

  <?php
  include 'includehtml/head.html'; ?>
  <link rel="stylesheet" href="css/profil/style.css">
</head>
<body>


  <?php


  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');
  $navbar = new App\Navbar();
  $backOffice=0;
  $navbar->navbar($backOffice);

  // REQUETE POUR RECUPER LES INFOS DU USER
  $req = $bdd->getPDO()->prepare('SELECT * FROM users WHERE id = ?');
  $req->execute(array($_SESSION['id']));
  $datas = $req->fetch();
  $user = new App\Profil($datas['first_name'],$datas['last_name'],$datas['birthday'],$datas['gender'],$datas['address'],$datas['zip_code']);

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
        <div class="col-md-2">

          <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>

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

         

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <div class="row">
                <div class="col-md-6">
                  <label>Mon abonnement</label>
                </div>
                <div class="col-md-6">
                <p> PAS ENCORE CODER</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
           
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

</body>
<script type="text/javascript" src="js/profil/profil.js"></script>
<?php include "includehtml/footer.html" ?>
</html>
