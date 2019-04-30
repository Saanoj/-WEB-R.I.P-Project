<?php
session_start();

//multilingue
if (!isset($_SESSION['lang'])) {
  $_SESSION['lang'] = "fr";
}
require_once "multilingue/multilingue.php";
loadLanguageFromSession($_SESSION['lang']);
require_once 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>RIP</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Travello template project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php include "includehtml/head.html" ?>

<script type="text/javascript">
function autoFillStart(home) {
  console.log(home);
  $('#autocomplete').val(home);
  $('#autocomplete2').val("");
  console.log("start addr");
}
function autoFillEnd(home) {
  console.log(home);
  $('#autocomplete2').val(home);
  $('#autocomplete').val("");
  console.log("end addr");
}
</script>

</head>
<body>

<div class="super_container">

	<!-- Header -->

<?php
$type = 0;
$navbar = new App\Navbar($type);
$navbar->navbar();
if(isset($_SESSION["id"])){
  $user=$bdd->queryOne('SELECT * FROM users WHERE id='.$_SESSION["id"].'');
}

 ?>

	<!-- Menu -->



	<!-- Home -->

	<div class="home">

		<!-- Home Slider -->
		<div class="home_slider_container">
			<div class="owl-carousel owl-theme home_slider">

				<!-- Slide -->
				<div class="owl-item">
					<div class="background_image" style="background-image:url(images/paris.jpg)"></div>
					<div class="home_slider_content_container">
						<div class="container">
							<div class="row">
								<div class="col">
									<div class="home_slider_content">
										<div class="home_title"><h2><?php echo _TITRE_BODY; ?></h2></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Search -->

	<div class="home_search">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_search_container">
						<div class="home_search_title"><?php echo _TITRE_BODY; ?> </div>
						<div class="home_search_content">
							<form action="valideReservation.php" method="post" class="home_search_form" id="home_search_form" onsubmit="return checkGlobal(this)">
								<div class="d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start">
                    <!-- boutton d'autocomplétion de depart depuis son adresse -->
                    <?php if (!empty($user["address"])) {
                      ?>
                      <div class="col-md-2">
                        <button class="fas fa-home btn btn-dark row col-md-12 mt-1 start" style="height: 25px;" href="#" onClick="autoFillStart('<?php echo $user["address"]." ".$user["zip_code"];?>'); return false;">From</button>
                        <button class="fas fa-home btn btn-dark row col-md-12 mt-1 end" style="height: 25px;" href="#" onClick="autoFillEnd('<?php echo $user["address"]." ".$user["zip_code"];?>'); return false;">Go</button>
                      </div>
                      <?php } ?>
                  <input type="text" name="start"  id="autocomplete" class="search_input search_input_1" placeholder="Adresse de départ" required="required">
									<input type="text"  name="end"  id="autocomplete2" class="search_input search_input_2" placeholder="Adresse d'arrivée" required="required">
									<input type="date" id="dateDebut" name="dateDebut" class="search_input search_input_3" placeholder="Date du trajet" required="required" onblur="checkdateDebut(this)">
									<input type="time" id="heureDebut" name="heureDebut" class="search_input search_input_4" placeholder="Heure du trajet" required="required" onblur="checkheureDebut(this)">
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
		<div class="intro_background" ></div>
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

							<!-- Intro Item -->
							<div class="col-lg-4 intro_col">
								<div class="intro_item d-flex flex-row align-items-end justify-content-start">
									<div class="intro_icon"><img src="images/wallet.svg" alt=""></div>
									<div class="intro_content">
										<div class="intro_title"><?php echo _TITRE_INFO3_RESERVATION ?></div>
										<div class="intro_subtitle"><p><?php echo _INFO3_RESERVATION ?></p></div>
									</div>
								</div>
							</div>

							<!-- Intro Item -->
							<div class="col-lg-4 intro_col">
								<div class="intro_item d-flex flex-row align-items-end justify-content-start">
									<div class="intro_icon"><img src="images/suitcase.svg" alt=""></div>
									<div class="intro_content">
										<div class="intro_title"><?php echo _TITRE_INFO1_RESERVATION ?></div>
										<div class="intro_subtitle"><p><?php echo _INFO1_RESERVATION ?></p></div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Destinations -->

	<div class="destinations" id="destinations">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_subtitle">Des collaborateurs compétents</div>
					<div class="section_title"><h2>Les meilleurs chauffeurs</h2></div>
				</div>
			</div>
			<div class="row destinations_row">
				<div class="col">
					<div class="destinations_container item_grid">
<style>
.glyphicon { margin-right:5px;}
.rating .glyphicon {font-size: 22px;}
.rating-num { margin-top:0px;font-size: 54px; }
.progress { margin-bottom: 5px;}
.progress-bar { text-align: left; }
.rating-desc .col-md-3 {padding-right: 0px;}
.sr-only { margin-left: 5px;overflow: visible;clip: auto; }
</style>
						 <?php
      // Affichage d'un service
      $chauffeurs = $bdd->queryPrepareForWhile('SELECT * FROM collaborateurs WHERE metier="chauffeur" ORDER BY rating DESC LIMIT 6',$bdd);
	  $i=0;
	  while($unChauffeur = $chauffeurs->fetch())
      {
        $car=App\Chauffeur::getCar($unChauffeur["idCollaborateurs"],$bdd);
        $chauffeur = new App\Chauffeur($unChauffeur["idCollaborateurs"],$unChauffeur["email"],$unChauffeur["last_name"],$unChauffeur["first_name"],$unChauffeur["metier"],$unChauffeur["prixCollaborateur"],
        $unChauffeur["dateEmbauche"],$unChauffeur["ville"],$unChauffeur["heuresTravailees"],$unChauffeur["rating"],$unChauffeur["ratingNumber"],$unChauffeur["description"],$car["carId"],$car["carBrand"],$car["carModel"],$car["carColor"],$car["nbPlaces"]);
        ?>

						<!-- Destination -->
						<div class="destination item">
							<div class="destination_image">
								<img src="images/henni.jpg" alt="">
								<!-- <div class="spec_offer text-center"><a href="#">Special Offer</a></div> !-->
							</div>
							<div class="destination_content">
								<div class="destination_title"><a href="#"><?php echo $chauffeur->getFirst_name()." ".$chauffeur->getLast_name();?></a></div>
								<div class="destination_subtitle"><p><b>Prix: <?php echo $chauffeur->getPrixCollaborateur()."€ / Km | Note: ".$chauffeur->getRating()."/5 sur ".$chauffeur->getRatingNumber()." votes" ?></b></p></div>
								<div class="destination_price"> <button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal<?php echo $i ?>">Plus d'informations</button></div>
							</div>
							<div class="row">
        <div class="col-xs-12 col-md-6">
            <div class="well well-sm">
                <div class="row">
                    <div class="col-xs-12 col-md-6 text-center">
                        <h1 style="font-size : 20px" class="rating-num">
                        <div class="rating">
                            <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">
                            </span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">
                            </span><span class="glyphicon glyphicon-star-empty"></span>
                        </div>

                    </div>
                    <div class="col-xs-12 col-md-12">
                        <div class="row rating-desc">
                            <div class="col-xs-3 col-md-3 text-right">
                                <span class="glyphicon glyphicon-star"></span>
                            </div>

														<?php if ($chauffeur->getRating() > 0 && $chauffeur->getRating() < 2) { ?>

                            <div class="col-xs-8 col-md-12">
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="<?=$chauffeur->getRating();?>"
                                        aria-valuemin="0" aria-valuemax="5" style="width:<?=$chauffeur->getRating()*20?>%"><?=$chauffeur->getRating()."/5"?>

                                    </div>
                                </div>
                            </div>
														<?php } ?>

										<?php if ($chauffeur->getRating() >= 2 && $chauffeur->getRating() < 3.5) { ?>
                            <div class="col-xs-8 col-md-12">
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-valuenow="<?=$chauffeur->getRating();?>"
                                        aria-valuemin="0" aria-valuemax="5" style="width:<?=$chauffeur->getRating()*20?>%"><?=$chauffeur->getRating()."/5"?>

                                    </div>
                                </div>
                            </div>
										<?php } ?>

										<?php if ($chauffeur->getRating() >= 3.5 && $chauffeur->getRating() <= 5) {  ?>
											<div class="col-xs-8 col-md-12">
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="<?=$chauffeur->getRating();?>"
                                        aria-valuemin="0" aria-valuemax="5" style="width:<?=$chauffeur->getRating()*20?>%"><?=$chauffeur->getRating()."/5"?>

                                    </div>
                                </div>
                            </div>
										<?php } ?>

										<?php if ($chauffeur->getRating() == 0) {  ?>
											<div class="col-xs-8 col-md-12">
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" aria-valuenow="<?=$chauffeur->getRating();?>"
                                        aria-valuemin="0" aria-valuemax="5" style="width:0">

                                    </div>
                                </div>
                            </div>
										<?php } ?>

										<div>
                            <span class="glyphicon glyphicon-user"></span><?=$chauffeur->getRatingNumber()." votes totals";?>
                     </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </div>


		<div class="modal fade" id="exampleModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $i ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel<?php echo $i ?>"><?php echo $chauffeur->getFirst_name()." ".$chauffeur->getLast_name();?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-4">
                      <h4>Infos: </h4>
                      <ul>
                        <li><?php echo "Ville d'operation: ".$chauffeur->getVille(); ?></li>
                        <li><?php echo "Heures Travailées: ".$chauffeur->getHeuresTravailees(); ?></li>
                        <li><?php echo "Date d'embauche: ".$chauffeur->getDateEmbauche(); ?></li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h4>Véhicule: </h4>
                      <ul>
                        <li><?php echo "Marque: ".$chauffeur->getCarBrand(); ?></li>
                        <li><?php echo "Modèle: ".$chauffeur->getCarModel(); ?></li>
                        <li><?php echo "Couleur: ".$chauffeur->getCarColor(); ?></li>
                        <li><?php echo "Places: ".$chauffeur->getCarSeats(); ?></li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h4>Description: </h4>
                      <p><?php echo $chauffeur->getDescription(); ?></p>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </div>
		</div>

						   <?php
        $i++;
      }
      ?>

						</div>



					</div>
				</div>
			</div>
		</div>
	</div>

<?php /*
	<!-- Footer -->

	<footer class="footer">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="images/footer_1.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter">
						<div class="newsletter_title_container text-center">
							<div class="newsletter_title">Subscribe to our newsletter to get the latest trends & news</div>
							<div class="newsletter_subtitle">Join our database NOW!</div>
						</div>
						<div class="newsletter_form_container">
							<form action="#" class="newsletter_form d-flex flex-md-row flex-column align-items-start justify-content-between" id="newsletter_form">
								<div class="d-flex flex-md-row flex-column align-items-start justify-content-between">
									<div><input type="text" class="newsletter_input newsletter_input_name" id="newsletter_input_name" placeholder="Name" required="required"><div class="input_border"></div></div>
									<div><input type="email" class="newsletter_input newsletter_input_email" id="newsletter_input_email" placeholder="Your e-mail" required="required"><div class="input_border"></div></div>
								</div>
								<div><button class="newsletter_button">subscribe</button></div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="row footer_contact_row">
				<div class="col-xl-10 offset-xl-1">
					<div class="row">

						<!-- Footer Contact Item -->
						<div class="col-xl-4 footer_contact_col">
							<div class="footer_contact_item d-flex flex-column align-items-center justify-content-start text-center">
								<div class="footer_contact_icon"><img src="images/sign.svg" alt=""></div>
								<div class="footer_contact_title">give us a call</div>
								<div class="footer_contact_list">
									<ul>
										<li>Office Landline: +44 5567 32 664 567</li>
										<li>Mobile: +44 5567 89 3322 332</li>
									</ul>
								</div>
							</div>
						</div>

						<!-- Footer Contact Item -->
						<div class="col-xl-4 footer_contact_col">
							<div class="footer_contact_item d-flex flex-column align-items-center justify-content-start text-center">
								<div class="footer_contact_icon"><img src="images/trekking.svg" alt=""></div>
								<div class="footer_contact_title">come & drop by</div>
								<div class="footer_contact_list">
									<ul style="max-width:190px">
										<li>4124 Barnes Street, Sanford, FL 32771</li>
									</ul>
								</div>
							</div>
						</div>

						<!-- Footer Contact Item -->
						<div class="col-xl-4 footer_contact_col">
							<div class="footer_contact_item d-flex flex-column align-items-center justify-content-start text-center">
								<div class="footer_contact_icon"><img src="images/around.svg" alt=""></div>
								<div class="footer_contact_title">send us a message</div>
								<div class="footer_contact_list">
									<ul>
										<li>youremail@gmail.com</li>
										<li>Office@yourbusinessname.com</li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		*/ ?>
		</footer>
</div>


<?php include "includehtml/footer.php"; ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyUEYzEivgVQJxxot06Z6ZsqfbIR4p_wU&libraries=places&callback=initAutocomplete" async defer></script>
</body>
</html>
