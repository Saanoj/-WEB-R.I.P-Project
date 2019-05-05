<?php
session_start();


?>

<!DOCTYPE html>
<html class="no-js">
<!--<![endif]-->
<link rel="stylesheet" href="css/connexion/style.css">
<?php include "includehtml/head.html" ?>

<body>
  <?php

  require_once __DIR__ .'/require_class.php';

  // init des objets
  $bdd = new App\Database('rip');
  $form = new App\Form(array());
  $backOffice=0;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();

  ?>
  <div class="container">
    <div class="display-1 text-center">
      Connexion Client
    </div>
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="panel panel-info" >
        <div class="panel-heading">
          <div class="panel-title"><?php echo _TITRE_CONNEXION ?></div>


          <div style="float:right; font-size: 80%; position: relative; top:-10px" >
            <a href="#" data-toggle="modal" data-target="#exampleModalCenter"><?php echo _PASSWORD_OUBLIE_CONNEXION ?></a>



            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo _PASSWORD_OUBLIE_CONNEXION ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body container">

                    <form class="" action="connexion.php" method="post">
                      <input type="text" name="email" value="" placeholder="Email">
                      <button type="submit" name="forget" class="btn-primary">Envoyer un mail</button>
                    </form>


                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                  </div>
                </div>
              </div>
            </div>

          </div>

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



  <?php
   function chiffrerPassword($password) {
    $salage='SuP4rS4aL4g3';
    return hash('md5',$salage.$password);

  }

  function generateRandomString($length = 10) {
      return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  }


if (isset($_POST["forget"])){
    if (isset($_POST["email"])&&!empty($_POST["email"])) {

      require_once __DIR__ . '/require_class.php';

      $bdd = new App\Database('rip');

      $query = $bdd->queryOne('SELECT * FROM users where email = "'.$_POST["email"].'" ');
      if (isset($query)&&!empty($query)){


      $password = generateRandomString();
      $passwordHash = chiffrerPassword($password);
      $email = $_POST['email'];
      $query = $bdd->getPDO()->prepare("UPDATE users SET
        password = :password
        WHERE email = :email");
        $query->execute([
          "email"=>$email,
          "password"=>$passwordHash

        ]);
      $subject = "Nouveau mot de passe";
      $body = "Bonjour ,\n Voici votre nouveau mot de passe : ".$password;

      require_once "mail.php";
        \App\sendMail($email,$subject,$body);

      ?>
      <div class="alert alert-success" role="alert">
      Un mail avec votre nouveau mot de passe a été envoyé.
      </div>
      <?php
    }else {
      ?>
      <div class="alert alert-warning" role="alert">
      Votre email n'est pas dans notre base de donnée
      </div>
      <?php
    }
  }
}
   ?>



  <?php include "includehtml/footer.php" ?>

</body>
</html>
