<?php
session_start();

//multilingue
if (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = "fr";
}
include "multilingue/multilingue.php";
loadLanguageFromSession($_SESSION['lang']);


require 'Class/Autoloader.php';
App\Autoloader::register();

$form = new App\Form(array());

?>


<!DOCTYPE html>
<html class="no-js">
<?php include "includehtml/head.html" ?>
<script type="text/javascript" src="js/inscription/main.js"></script>

<body class="bg-secondary">
  <?php
  $bdd = new App\Database('rip');
  $backOffice=0;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();
  ?>

  <div class="container">
    <div class="display-1 text-center">
      Inscription Collaborateur
    </div>
    <div class="container">

      <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">Inscrivez vous</div>
            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="connexionCollab.php">ou connectez vous si vous etes deja inscris</a></div>
          </div>

          <?php
          $reqCollab = $bdd->queryOne('SELECT * FROM collaborateurs WHERE idCollaborateurs = '.$_SESSION["id"].'');
          $reqUser = $bdd->queryOne('SELECT * FROM users WHERE id = '.$_SESSION["id"].'');

          //si addr et zip ne sont pas rempli
          if (!isset($reqUser["address"]) || empty($reqUser["address"]) || !isset($reqUser["zip_code"]) || empty($reqUser["zip_code"])) {
            echo "<div class='h1'>Remplissez votre adresse et code postal dans votre profil avant de continuer</div>";
          }else {
            //si le comte n'existe pas en collaborateur
            if ($reqCollab === false) {
              echo "<div class='h1'>Choisisez vos options</div>";
              ?>
              <form  class="form-horizontal container" method="post" action="verifInscriptionCollab.php">
                <div class="form-group required mt-3">
                  <label class="control-label col-md-4  requiredField">Votre secteur<span class="asteriskField">*</span> </label>
                  <div class="controls col-md-8 ">
                    <select name="metier" class="form-control" id="exampleFormControlSelect1">
                      <option value="chauffeur">Chauffeur</option>
                      <option value="interprete">Interprete</option>
                      <option value="coachSportif">Coach sportif</option>
                      <option value="coachCulture">coachCulture</option>
                    </select>
                  </div>
                </div>

                <div class="form-group required mt-3">
                  <label class="control-label col-md-4  requiredField">Votre Ville<span class="asteriskField">*</span> </label>
                  <div class="controls col-md-8 ">
                    <select name="ville" class="form-control" id="exampleFormControlSelect1">
                      <option value="Paris">Paris</option>
                      <option value="Bordeaux">Bordeaux</option>
                      <option value="Lyon">Lyon</option>
                      <option value="Marseille">Marseille</option>
                      <option value="Orange">Orange</option>
                      <option value="Montpellier">Montpellier</option>
                      <option value="Lille">Lille</option>
                    </select>
                  </div>
                </div>

                <hr class="bg-light">

                <div style="margin-top:10px" class="form-group">
                  <div class="col-sm-12 controls">
                    <?php echo $form->submit(); ?>
                  </div>
                </div>

              </form>
              <?php
            }else{
              ?>
              <div class="container">
                <div class="row h3 offset-2">
                  Récuperation:
                </div>
                <div class="row mb-2">
                  <div class='h4 col-md-10 offset-1'>Vous avez deja créé un compte, voulez vous le reprendre?(dire non vas supprimer vos infos collaborateurs pour que vous puissiez vous réinscrire)</div>
                </div>
                <div class="row mb-2 mt-2">
                  <a href="verifActiverCollab.php" class="btn btn-success col-md-5 offset-1">Oui (récupérer)</a>
                  <a href="verifDeleteCollab.php" class="btn btn-danger col-md-5 ">Non (réinscrire)</a>
                </div>

              </div>
              <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>

</div>
<?php include "includehtml/footer.php" ?>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
