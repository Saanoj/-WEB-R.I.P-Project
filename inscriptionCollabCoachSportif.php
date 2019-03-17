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

<body>
  <?php
  $backOffice=0;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();
  ?>

  <div class="container">
    <div class="display-1 text-center">
      Inscription Coach Sportif
    </div>
    <div class="container">

      <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">Inscrivez vous</div>
            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="connexionCollab.php">ou connectez vous si vous etes deja inscris</a></div>
          </div>


          <form  class="form-horizontal container" method="post" action="verifInscriptionCollab.php">
            <div class="form-group required mt-3">
              <label class="control-label col-md-4  requiredField"> Votre domaine d'expertise sportive<span class="asteriskField">*</span> </label>
              <div class="controls col-md-8 ">
                <?php //echo $form->input('description','textarea','Votre description'); ?>
                <textarea style="resize: none;" name="description" cols="40" rows="2" placeholder="ex: 'Course a pieds' 'CrossFit' ..."></textarea>
              </div>
            </div>

            <hr class="bg-light">

            <div style="margin-top:10px" class="form-group">
              <div class="col-sm-12 controls">
                <?php echo $form->submit(); ?>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

</div>
<?php include "includehtml/footer.php" ?>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
