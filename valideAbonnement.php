<?php
    session_start();

    //multilingue
    if (!isset($_SESSION['lang'])) {
      $_SESSION['lang'] = "fr";
    }
    include "multilingue/multilingue.php";
    loadLanguageFromSession($_SESSION['lang']);
 ?>




  <body>
    <?php

    require_once __DIR__ .'/require_class.php';

    $bdd = new App\Database('rip');
    $backOffice=0;
    $navbar = new App\Navbar($backOffice);
    $navbar->navbar();
    $form =new App\Form(array());


    $form = new App\Form(array());
    $abo = App\Abonnement::createAbonnement($bdd);
    ?>

    <div class="container">
       <div class="row">
         <div class="offset-md-3 col-md-6">
           <div class="card" style="margin:50px 0">
                <!-- Default panel contents -->
                <div class="card-header">
                  <h1 class="display-3">Récapitulatif de l'abonnement</h1>
                </div>

                <div>
                <ul>
                <li><?php

                ?></li>
                <li>b</li>


                </ul>
                </div>




            </div>
          </div>
        </div>
      </div>

    <?php include "includehtml/footer.php" ?>
  </body>
</html>
