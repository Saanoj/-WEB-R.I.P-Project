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
<html class="no-js">
<!--<![endif]-->
<?php include "includehtml/head.html" ?>

<body>
  <?php

  require 'Class/Autoloader.php';
  App\Autoloader::register();
  // init des objets
  $bdd = new App\Database('rip');
  $form = new App\Form(array());
  $backOffice=0;
  $navbar = new App\Navbar($backOffice);
  $navbar->navbar();

  ?>
  <div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="panel panel-info" >
        <div class="panel-heading">
          <div class="panel-title"><?php echo _TITRE_CONNEXION ?></div>
          <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#"><?php echo _PASSWORD_OUBLIE_CONNEXION ?></a></div>
        </div>

        <div style="padding-top:30px" class="panel-body" >

          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

          <form action="VerifConnexion.php" id="signupform" class="form-horizontal" role="form" method="POST">

            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <?php echo $form->inputConnexion('email','text',_LOGIN_CONNEXION,'form-control'); ?>
            </div>

            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <?php echo $form->inputConnexion('password','password',_PASSWORD_CONNEXION,'form-control'); ?>
            </div>



            <div class="input-group">
              <div class="checkbox">
                <label>
                  <input id="login-remember" type="checkbox" name="remember" value="1"><?php echo _SOUVENIR_CONNEXION ?></input>
                </label>
              </div>
            </div>


            <div style="margin-top:10px" class="form-group">
              <div class="col-sm-12 controls">
                <?php  echo $form->submitConnexion();?>
              </div>
            </div>


            <div class="form-group">
              <div class="col-md-12 control">
                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                  <?php echo _PAS_COMPTE_CONNEXION ?>
                  <a href="inscription.php" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                    <?php echo _INSCRIPTION_CONNEXION ?>
                  </a>
                </div>
              </div>
            </div>
          </form>



        </div>
      </div>
    </div>

  </div>


  <?php include "includehtml/footer.php" ?>

</body>
</html>
