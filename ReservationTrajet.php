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
<html lang="fr">
<head>
<title>Reservation de trajets</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Ride in pride">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/ReservationTrajet/bootstrap4/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/ReservationTrajet/main_styles.css">
<link rel="stylesheet" type="text/css" href="css/ReservationTrajet/responsive.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<script src="js/popper.min.js"></script>

<?php

  include 'includehtml/head.html';

  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $backOffice=0;
  $navbar = new App\Navbar($backOffice);
  $navbar->navbar();
  $Session = new App\Session($_SESSION['id']);
  $Session->isConnect();
  $form = new App\Form();

  ?>
</head>
<body>


<div class="super_container">

	<!-- Home -->

	<div class="home">

		<!-- Home Slider -->
		<div class="home_slider_container">

      </div>




	<!-- Recherche -->

	<div class="home_search">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_search_container">
						<div class="home_search_title"><?php echo _TITRE_RESERVATION_TRAJET ?></div>
						<div class="home_search_content">
							<form action="valideReservation.php" method="post" class="home_search_form d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start" id="home_search_form">

									<input type="text" name="start"  id="autocomplete" class="search_input search_input_1" placeholder="<?php echo _ADRESSE_DEPART_RESERVATION ?>" required="required">
									<input type="text" name="end"  id="autocomplete2" class="search_input search_input_2" placeholder="<?php echo _ADRESSE_ARRIVEE_RESERVATION ?>" required="required">
									<!--<input type="number" name="price"  id="price" class="search_input search_input_4" placeholder="Budget" required="required">-->

									<label for="dateDebut"><?php echo _DATE_DEBUT_RESERVATION_TRAJET ?></label>
									<?php echo $form->input('dateDebut','date'); ?>

									<label for="heureDebut"><?php echo _HEURE_DEBUT_RESERVATION_TRAJET ?></label>
									<?php echo $form->input('heureDebut','time'); ?>
									<button class="home_search_button"><?php echo _BOUTTON_RESERVATION_TRAJET ?></button>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
  </div>

	<!-- Intro -->

	<div class="intro">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="intro_container">
						<div class="row">

							<!-- Premier element -->
							<div class="col-lg-4 intro_col">
								<div class="intro_item d-flex flex-row align-items-end justify-content-start">
									<div class="intro_icon"><img src="images/shield.svg" alt=""></div>
									<div class="intro_content">
										<div class="intro_title"><?php echo _TITRE_INFO1_RESERVATION ?></div>
										<div class="intro_subtitle"><p><?php echo _INFO1_RESERVATION ?></p></div>
									</div>
								</div>
							</div>

							<!-- Deuxieme element -->
							<div class="col-lg-4 intro_col">
								<div class="intro_item d-flex flex-row align-items-end justify-content-start">
									<div class="intro_icon"><img src="images/shopping-cart.svg" alt=""></div>
									<div class="intro_content">
										<div class="intro_title"><?php echo _TITRE_INFO2_RESERVATION ?></div>
										<div class="intro_subtitle"><p><?php echo _INFO2_RESERVATION ?></p></div>
									</div>
								</div>
							</div>

							<!-- Trosième element-->
							<div class="col-lg-4 intro_col">
								<div class="intro_item d-flex flex-row align-items-end justify-content-start">
									<div class="intro_icon"><img src="images/support.svg" alt=""></div>
									<div class="intro_content">
										<div class="intro_title"><?php echo _TITRE_INFO3_RESERVATION ?></div>
										<div class="intro_subtitle"><p><?php echo _INFO3_RESERVATION ?></p></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

	<?php include "includehtml/footer.php" ?>

		<script src="js/ReservationTrajet/main.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyUEYzEivgVQJxxot06Z6ZsqfbIR4p_wU&libraries=places&callback=initAutocomplete"
        async defer></script>


</body>
</html>
