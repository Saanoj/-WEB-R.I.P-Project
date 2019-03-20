<!DOCTYPE html>
<html lang="en" dir="ltr">
<body>
  <section class="banner" role="banner">
    <!--header navigation -->
    <header id="header">
      <div class="header-content clearfix"> <a class="" href="index.php"><img src="images/RIP2small2.png" alt=""></a>
        <nav class="navigation" role="navigation">
          <ul class="primary-nav">
            <li><a href="index.php">Accueil</a></li>
            <?php if ($_SESSION['isCollaborateur']==0) { ?>
              <li><a href="inscriptionCollab.php">Espace Collaborateur</a></li>
              <li><a href="reservationTrajet.php">Reserver un trajet</a></li>
            <?php }else{ ?>
              <li><a href="homeCollab.php">Espace Collaborateur</a></li>
            <?php } ?>
            <li><a href="services.php">Services</a></li>
            <li><a href="profil.php">Profil</a></li>
            <li><a href="deconnexion.php">Deconnexion</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </nav>
        <a href="#" class="nav-toggle">Menu<span></span></a> </div>
      </header>
      <!--header navigation -->
      <!-- banner text -->
      <div class="container">
        <div class="col-md-10 col-md-offset-1">
          <div class="banner-text text-center">
            <h1>Ride in Pride</h1>
            <p>Services VTC de luxe</p>

          </div>
        </div>
      </div>
    </section>

  </body>
  </html>
