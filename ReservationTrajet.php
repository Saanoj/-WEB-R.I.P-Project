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

<?php
  include 'includehtml/head.html'; ?>
</head>
<body>
  <?php
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
$navbar = new App\Navbar();
$backOffice=0;
$navbar->navbar($backOffice);
  ?>

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
						<div class="home_search_title">Recherche un trajet</div>
						<div class="home_search_content">
							<form action="#" class="home_search_form" id="home_search_form">
								<div class="d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start" id="locationField">
									<input id="autocomplete" type="text" class="search_input search_input_1" placeholder="Adresse de départ" required="required">
									<input id="autocomplete2" type="text" class="search_input search_input_2" placeholder="Adresse d'arrivé" required="required">
									<input type="number" value='20€' .'€'.'' max="200" min="0" step="10" class="search_input search_input_4" placeholder="Budget" required="required">
									<button class="home_search_button">Rechercher</button>
								</div>
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
										<div class="intro_title">Course sécurisé</div>
										<div class="intro_subtitle"><p>Nous prenons très au sérieux le confort de nos clients.</p></div>
									</div>
								</div>
							</div>

							<!-- Deuxieme element -->
							<div class="col-lg-4 intro_col">
								<div class="intro_item d-flex flex-row align-items-end justify-content-start">
									<div class="intro_icon"><img src="images/shopping-cart.svg" alt=""></div>
									<div class="intro_content">
										<div class="intro_title">Courses les moins chers</div>
										<div class="intro_subtitle"><p>Prix les plus abordables grâce à notre algorithme qui calcul le meilleur itinéraire.</p></div>
									</div>
								</div>
							</div>

							<!-- Trosième element-->
							<div class="col-lg-4 intro_col">
								<div class="intro_item d-flex flex-row align-items-end justify-content-start">
									<div class="intro_icon"><img src="images/support.svg" alt=""></div>
									<div class="intro_content">
										<div class="intro_title">Services </div>
										<div class="intro_subtitle"><p>En plus de notre course, nous proposons des services qui améliorent votre c.</p></div>
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

	<?php include "includehtml/footer.html" ?>

				<script src="js/ReservationTrajet/main.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyUEYzEivgVQJxxot06Z6ZsqfbIR4p_wU&libraries=places&callback=initAutocomplete"
        async defer></script>


</body>
</html>