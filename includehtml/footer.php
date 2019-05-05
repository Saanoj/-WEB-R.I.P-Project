<?php
namespace App;
use \PDO;
use \DateTime;
use \DateTimeZone;

require_once __DIR__ . '/../require_class.php';

$bdd = new Database('rip');
checkAbonnementValide($bdd);
checkIfTrajetStarted($bdd);
checkStatusChauffeur($bdd);

?>


    <!-- Footer section -->

    <footer class="footer">
      <div class="footer-top section">
        <div class="container">
          <div class="row">
            <div class="footer-col col-md-4">
              <h5><?php echo _FOOTER_LOCAUX ?></h5>
              <p>242 rue faubourg saint antoine, Paris 12ème France.<br>
                06 10 07 32 40<br>
                email@email.com</p>
              <p>Copyright © 2019 Ride in Pride Inc. All Rights Reserved. Made with <i class="fa fa-heart pulse"></i> by Arthur, Jonas et Maxime</p>
            </div>
            <div class="footer-col col-md-2">
              <h5><?php echo _FOOTER_SERVICES ?></h5>
              <p>
              <ul>
                <li><a href="#"><?php echo _FOOTER_INTERPRETES_COACH ?></a></li>
                <li><a href="#"><?php echo _FOOTER_VOITURE ?></a></li>
                <li><a href="#"><?php echo _FOOTER_BOISSON ?></a></li>
                <li><a href="#"><?php echo _FOOTER_SOCIAL ?></a></li>
                <li><a href="#"><?php echo _FOOTER_EXP ?></a></li>
              </ul>
              </p>
            </div>
            <div class="footer-col col-md-2">
              <h5><?php echo _FOOTER_LANGUE ?></h5>
              <p>
              <ul>
                <li><a href="multilingue/changeLanguage.php?lang=fr">Francais</a></li>
                <li><a href="multilingue/changeLanguage.php?lang=en">English</a></li>
                <li><a href="#"><?php echo _FOOTER_VENIR ?></a></li>
                <li><a href="#"><?php echo _FOOTER_VENIR ?></a></li>
                <li><a href="#"><?php echo _FOOTER_VENIR ?></a></li>
              </ul>
              </p>
            </div>
            <div class="footer-col col-md-3">
              <h5><?php echo _FOOTER_PARTAGE ?></h5>
              <ul class="footer-share">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      </footer>
      <!-- footer top -->
      <!-- JS -->

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      <!-- JS FILES -->
      <script src="js/jquery.flexslider-min.js"></script>
      <script src="js/jquery.fancybox.pack.js"></script>
      <script src="js/retina.min.js"></script>
      <script src="js/modernizr.js"></script>
      <script src="js/main.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
      <script src="plugins/Isotope/isotope.pkgd.min.js"></script>
      <script src="plugins/scrollTo/jquery.scrollTo.min.js"></script>
      <script src="plugins/easing/easing.js"></script>
      <script src="plugins/parallax-js-master/parallax.min.js"></script>
      <script src="js/index/custom.js"></script>
      <script src="js/ReservationTrajet/main.js"></script>

      <?php
function checkAbonnementValide($bdd) {
  $date = new DateTime('', new DateTimeZone('Europe/Paris'));
  // echo $date->format('Y-m-d ') . "\n";

  $req = $bdd->getPDO()->prepare('SELECT * FROM linkabonnemententreprise');
  $req->execute();

  while ($unAbonnement = $req->fetch())
  {
      $dateDebut = $unAbonnement['dateDebut'];
      $dateDebut = date($dateDebut);
      $dateDebut = new \DateTime($dateDebut);

      $dateFin = $unAbonnement['dateFin'];
      $dateFin = date($dateFin);
      $dateFin = new \DateTime($dateFin);


      $dateNowLessDateDebut = $dateFin->diff($date);


  if ($dateNowLessDateDebut->format('%R') == '+')
      {
      $req = $bdd->getPDO()->prepare('DELETE FROM linkabonnemententreprise WHERE idClient = :idClient');
      $req->execute(array('idClient' => $unAbonnement['idClient']));
      $req->closeCursor();

      $reqUser  = $bdd->getPDO()->prepare('SELECT * FROM users WHERE id = :id');
      $reqUser->execute(array('id' => $unAbonnement['idClient']));
      $user = $reqUser->fetch();
      $reqUser->closeCursor();


      $subject = "Votre abbonement a Ride In Pride est terminé";
      $body = "Bonjour ".$user['first_name']." votre abbonement est terminé, si vous voulez le renouveller <br> cliquez-ici";
      require_once 'mail.php';
      sendMail($user['email'],$subject,$body);
      }
  }
 }


function checkIfTrajetStarted($bdd) {

  $date = new DateTime("now", new DateTimeZone('Europe/Paris'));
  $req = $bdd->getPDO()->prepare('SELECT * FROM trajet');
  $req->execute();
  while ($unTrajet = $req->fetch())
 {
  // On convertie la date de début de trajet en DateTime afin de faire les différences.
  $dateTrajetDebut = new DateTime($unTrajet['heureDebut'], new DateTimeZone('Europe/Paris'));
  $interval = $date->diff($dateTrajetDebut);
  // On convertie la date de fin de trajet en DateTime afin de faire les différences.
  $dateTrajetFin = new DateTime($unTrajet['heureFin'], new DateTimeZone('Europe/Paris'));
  $intervalFin = $date->diff($dateTrajetFin);

  // Si la date du jour se situe dans l'intervalle de la date du début et la date de fin du trajet :
  if ($interval->format('%R') == "-" && $intervalFin->format('%R') == "+")
  {
  $reqTrajet = $bdd->getPDO()->prepare('UPDATE trajet SET state="En cours" WHERE idTrajet = :idTrajet');
  $reqTrajet->bindValue('idTrajet',$unTrajet['idTrajet']);
  $reqTrajet->execute();
  }
  // Si la date du jours est supérieur a la date de fin et supérieur a la date du début :
  else if ($interval->format('%R') == "-" && $intervalFin->format('%R') == "-") {
  $reqTrajet = $bdd->getPDO()->prepare('UPDATE trajet SET state="Finis" WHERE idTrajet = :idTrajet');
  $reqTrajet->bindValue('idTrajet',$unTrajet['idTrajet']);
  $reqTrajet->execute();
  }
  // Le reste ( donc si la date du jour est inférieur a la date de début et fin de trajet)
  else
  {
  $reqTrajet = $bdd->getPDO()->prepare('UPDATE trajet SET state="Pas commencé" WHERE idTrajet = :idTrajet');
  $reqTrajet->bindValue('idTrajet',$unTrajet['idTrajet']);
  $reqTrajet->execute();
  }
 }
}

function checkStatusChauffeur($bdd) {

  $req = Trajet::getStateChauffeur($bdd,"En cours");
  while ($trajet = $req->fetch())
  {
   $reqUpdate = Trajet::updateChauffeur($bdd,$trajet['idChauffeur'],0);
  }
  $req->closeCursor();

  $req = Trajet::getStateChauffeur($bdd,"Pas commencé");
  while ($trajet = $req->fetch())
  {
   $reqUpdate = Trajet::updateChauffeur($bdd,$trajet['idChauffeur'],1);
  }
  $req->closeCursor();

  $req = Trajet::getStateChauffeur($bdd,"Finis");
  while ($trajet = $req->fetch())
  {
   $reqUpdate = Trajet::updateChauffeur($bdd,$trajet['idChauffeur'],1);
  }
  $req->closeCursor();



}




      ?>
