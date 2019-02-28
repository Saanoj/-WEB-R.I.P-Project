<?php

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
  $navbar = new App\Navbar($backOffice);
  $navbar->navbar();?>

  <div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="panel panel-info" >
        <div class="panel-heading">
          <div class="panel-title">Se connecter</div>
          <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="forgotPassword.php">Mot de passe oubllié ?</a></div>
        </div>

        <div style="padding-top:30px" class="panel-body" >

          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>


          <form method="POST" id="signup-form" class="signup-form" onsubmit="return checkGlobal(this)" action="VerifInscription.php" >

            <div class="form-row">

              <div class="form-group">
                <label for="password">Email</label>
                <?php echo $form->input('email','text'); ?>
              </div>

            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="firstName">Prenom</label>
                <?php echo $form->input('firstName','text'); ?>
              </div>
              <div class="form-group">
                <label for="lastName">Nom</label>
                <?php echo $form->input('lastName','text'); ?>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group form-icon">
                <label for="birthday">Date de naissance (16 ans minimum) </label>
                <?php echo $form->input('birthday','date'); ?>
              </div>
              <div class="form-radio">
                <label for="gender">Genre</label>
                <div class="form-flex">
                  <input type="radio" name="gender" value="Man" id="Man" checked="checked" />
                  <label for="male">Homme</label>

                  <input type="radio" name="gender" value="Woman" id="Woman" />
                  <label for="female">Femme</label>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="password">Mot de passe ( 6 caractères au minimum, 1 majuscule et un chiffre)</label>
                <?php echo $form->input('password','password'); ?>
              </div>
              <div class="form-group">
                <label for="re_password">Confirmation mot de passe</label>
                <?php echo $form->input('confirmPassword','password'); ?>
              </div>
            </div>



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
<?php include "includehtml/footer.html" ?>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
