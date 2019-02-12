<?php




require "Class/Form.php";

$form = new Form(array());

      
       // echo $form->input('password','password');
        //echo $form->submit();
?>

<?php

$db = new DataBase\Config('rip');
$datas = $db->query('SELECT * FROM users');
var_dump($datas);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inscription</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../vendor/jquery-ui/jquery-ui.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../css/inscription/style.css"> 
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form" action="Class/VerifInscription">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="first_name">Prenom</label>
                               <?php echo $form->input('firstName','text'); ?>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Nom</label>
                                <?php echo $form->input('lastName','text'); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group form-icon">
                                <label for="birth_date">Date de naissance</label>
                                <?php echo $form->input('birthday','text'); ?>
                            </div>
                            <div class="form-radio">
                                <label for="gender">Genre</label>
                                <div class="form-flex">
                                    <input type="radio" name="gender" value="male" id="male" checked="checked" />
                                    <label for="male">Homme</label>
    
                                    <input type="radio" name="gender" value="female" id="female" />
                                    <label for="female">Femme</label>
                                </div>
                            </div>
                        </div>
                  
                        <div class="form-row">
                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <?php echo $form->input('password','password'); ?>
                            </div>
                            <div class="form-group">
                                <label for="re_password">Confirmation mot de passe</label>
                                <?php echo $form->input('confirmPassword','password'); ?>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Inscription"/>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="../vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="../vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="../js/inscriptionjs/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>

