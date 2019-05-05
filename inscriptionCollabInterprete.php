<?php
session_start();


require_once __DIR__ .'/require_class.php';


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
      Inscription Interprete
    </div>
    <div class="container">

      <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">Inscrivez vous</div>
          </div>

          <?php var_dump($_SESSION["infoCollab"]);  ?>

          <form  class="form-horizontal container" method="post" action="verifInscriptionCollabBDD.php">
            <div class="form-group required mt-3">
              <label class="control-label col-md-4  requiredField"> Description de votre domaine d'expertise en langues<span class="asteriskField">*</span> </label>
              <div class="controls col-md-8 ">
                <?php //echo $form->input('description','textarea','Votre description'); ?>
                <textarea style="resize: none;" name="description" cols="40" rows="2" placeholder="ex: 'English(anglais) - Francais' pour de l'anglais"></textarea>
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
