<!doctype html>

<?php

require 'Class/Autoloader.php';
App\Autoloader::register();
// init des objets
$bdd = new App\Database('rip');
$form = new App\Form(array());
?>


<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<?php include "includehtml/head.html" ?>

<body>
  <?php   include "navbar/chooseNav.php";  ?>
  <div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="panel panel-info" >
        <div class="panel-heading">
          <div class="panel-title">Se connecter</div>
          <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Mot de passe oubllié ?</a></div>
        </div>

        <div style="padding-top:30px" class="panel-body" >

          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

          <form action="Class/VerifConnexion.php" id="signupform" class="form-horizontal" role="form" method="POST">

            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <?php echo $form->inputConnexion('email','text','Login','form-control'); ?>
            </div>

            <div style="margin-bottom: 25px" class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <?php echo $form->inputConnexion('password','password','Mot de passe','form-control'); ?>
            </div>



            <div class="input-group">
              <div class="checkbox">
                <label>
                  <input id="login-remember" type="checkbox" name="remember" value="1">Se souvenir de moi
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
                  Vous n'avez pas de compte ?
                  <a href="inscription.php" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                    Inscrivez-vous  ici.
                  </a>
                </div>
              </div>
            </div>
          </form>



        </div>
      </div>
    </div>

  </div>


  <?php include "includehtml/footer.html" ?>

</body>
</html>
