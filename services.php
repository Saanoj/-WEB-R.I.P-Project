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
  <title>Reservation de services</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Ride in pride">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/main_styles.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/responsive.css">
  <link rel="stylesheet" type="text/css" href="css/choixService/main.css">
  <link rel="stylesheet" type="text/css" href="css/choixService/calendrier.css">

  <?php include 'includehtml/head.html'; ?>

</head>
<body>

  <?php

  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');
  $form =new App\Form(array());
  $backOffice=0;
  $type = 0;
  $navbar = new App\Navbar($backOffice,$type);
  $navbar->navbar();

  $form = new App\Form(array());
  ?>

  <div class="container">
    <div class="row">
      <div class="offset-md-2 col-md-8">
        <div class="card" style="margin:50px 0">
          <!-- Default panel contents -->

          <div class="card-header">
            <h1 class="display-3 col-md-4 col-md-offset-4">Nos services</h1>
          </div>

          <form class="list-group list-group-flush container" method="POST" action="valideReservationServices.php" >


            <div class="container">


              <?php
              // Affichage d'un service
              $services = $bdd->getPDO()->prepare('SELECT * FROM services');
              $services->execute();
              $i=1;
              while($unService = $services->fetch())
              {
                $service = new App\Service($unService["idService"],$unService["nomService"],$unService["description"],$unService["prixService"],$unService["categorie"]);

                ?>
                <li class="list-group-item col-md-8 row">
                  <h3 class="col-md-6"><?php echo $service->getNomService(); ?></h3>
                  <h6 class="col-md-2">idService: <?php echo $service->getIdService()."<br>"; ?> Prix: <?php echo $service->getPrixService()." €"; ?></h6>
                  <div class="col-md-2">
                    <label class="">Description:</label>
                    <?php echo $service->getDescription(); ?>
                  </div>

                  <button type="button" href="#costumModal<?php echo $i ?>" data-target="#costumModal<?php echo $i ?>" name="services[<?php echo $i ?>]" class="btn btn-secondary" data-toggle="modal">Infos</button>

                  <!--
                  <label class="switch col-md-2">
                  <input type="checkbox" href="#costumModal1" role="button" data-target="#costumModal<?php echo $i ?>" class="primary"  name="services[<?php echo $i ?>]" data-toggle="modal"  value="<?php echo $service->getIdService(); ?>"></input>
                  <span class="slider round"></span>
                </label>
              -->
              <div id="costumModal<?php echo $i ?>" class="modal fade bd-example-modal-lg"  data-target=".bd-example-modal-lg" data-easein="pulse" tabindex="-1" role="dialog" aria-labelledby="costumModalLabel" aria-hidden="false">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">

                      </button>
                      <h4 class="modal-title" id="costumModalLabel">
                        <?php
                        echo $service->getNomService(); ?>
                      </h4>
                    </div>
                    <?php




                    switch ($service->getIdService()) {

                      case '1':


                      $restaurants = $bdd->getPDO()->prepare('SELECT * FROM restaurants ORDER BY idRestaurant DESC LIMIT 10 ');
                      $restaurants->execute();
                      while($unRestaurants = $restaurants->fetch())
                      {
                        $datas = App\Restaurant::createRestaurant($unRestaurants['idRestaurant'],$unRestaurants['nom'],$unRestaurants['prix'],$unRestaurants['horrairesDebut'],$unRestaurants['horrairesFin'],$unRestaurants['adresseRestaurant'],$unRestaurants['villeRestaurant']);


                        $unRestaurants['horrairesDebut'] = $res[0] . ' ' . $unRestaurants['horrairesDebut'];
                        $unRestaurants['horrairesFin'] = $res[0] . ' ' . $unRestaurants['horrairesFin'];

                        if (strtotime($hour) - strtotime($unRestaurants['horrairesDebut'])> 0 && strtotime($hour) - strtotime($unRestaurants['horrairesFin']) < 0 && $unRestaurants['isDispo'] == 1 )
                        {

                          ?>
                          <table>

                            <tr>
                              <th scope="col">Nom du restaurant : </th>
                              <th scope="col">Adresse : </th>
                              <th scope="col">Prix moyen : </th>
                            </tr>
                            <tr>
                              <th scope="row"> <?= $unRestaurants['nom'];?></th>
                              <td> <?= $unRestaurants['adresseRestaurant'];?></td>
                              <td> <?= $unRestaurants['prix']. '€';?></td>
                            </tr>
                          </table> <?php
                        }

                      }
                      break;
                      case '7':

                      $hotel = $bdd->getPDO()->prepare('SELECT * FROM chambre INNER JOIN hotel ON chambre.idHotel = hotel.idHotel WHERE isDispo = 1 AND litsDispo > 0 ORDER BY idChambre DESC LIMIT 10 ');
                      $hotel->execute();
                      while($unHotel = $hotel->fetch())
                      {
                        $datas = App\Hotel::createHotel($unHotel['idHotel'],$unHotel['nom'],$unHotel['adresseHotel'],$unHotel['prix']);
                        $chambre = App\Chambre::createChambre($unHotel['idChambre'],$unHotel['typeChambre'],$unHotel['idHotel'],$unHotel['litsDispo'],$unHotel['isDispo']);




                        ?>
                        <table>

                          <tr>
                            <th scope="col">Nom de l'hotel : </th>
                            <th scope="col">Adresse : </th>
                            <th scope="col">Prix : </th>
                            <th scope="col">Type de chambre : </th>
                            <th scope="col">Lits disponibles : </th>

                          </tr>
                          <tr>
                            <th scope="row"> <?= $unHotel['nom'];?></th>
                            <td> <?= $unHotel['adresseHotel'];?></td>
                            <td> <?= $unHotel['prix'] . '€ la nuit';?></td>
                            <td> <?= $unHotel['typeChambre'];?></td>
                            <td> <?= $unHotel['litsDispo'];?></td>
                          </tr>
                        </table>
                        <?php

                      }
                      break;

                      case '8' :
                      $billet = $bdd->getPDO()->prepare('SELECT * FROM billettourisme ORDER BY idBillet DESC LIMIT 10');
                      $billet->execute();
                      while($unBillet = $billet->fetch())
                      {
                        $j=0;
                        $datas = App\BilletTourisme::createBilletTourisme($unBillet['idBillet'],$unBillet['nom'],$unBillet['isValide'],$unBillet['villeBillet'],$unBillet['prix']);
                        ?>


                        <table>

                          <tr>
                            <th scope="col">Nom du billet : </th>
                            <th scope="col">Validité : </th>
                            <th scope="col">Ville : </th>
                            <th scope="col">Prix : </th>

                          </tr>
                          <tr>
                            <th scope="row"> <?= $unBillet['nom'];?></th>
                            <td>  <?php
                            if  ($unBillet['isValide'] == 1) {
                              echo "Valide";}
                              else{ echo "Non valide";}?></td>
                              <td> <?= $unBillet['villeBillet'];?></td>
                              <td>  <?= $unBillet['prix']. '€';?> </td>
                            </tr>
                          </table>
                          <?php

                        }
                        break;
                        case '10' :
                        ?>

                        <div class="container">
                          <h5>Vous voulez un service qui n'est pas présent ? Envoyez nous votre demande et nous l'examinerons sous 24h ouvrés.</h5>
                          <div class="row">


                            <div class="row">
                              <div class="offset-md-6 col-md-12">
                                <div class="form-group">
                                  <input type="email" class="form-control" name="emailContact" autocomplete="off" id="email" placeholder="E-mail" value="<?= $_SESSION['email'];?>">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="offset-md-9 col-md-12">
                                <div class="form-group">
                                  <textarea class="form-control textarea" rows="3" name="messageContact" id="Message" placeholder="Message"></textarea>
                                </div>
                              </div>
                            </div>



                          </div>
                        </div>
                        <?php

                        break;
                        case '11' :

                        $interprete = $bdd->getPDO()->prepare('SELECT * FROM collaborateurs WHERE metier="interprete" ORDER BY idCollaborateurs DESC LIMIT 4 ');
                        $interprete->execute();
                        ?>
                        <h4> Réservation d'un interprête pendant la journée du trajet, veuillez choisir une plage horraire : </h4>
                        <h6>Pour que votre réservation soit valide, l'heure de début doit etre égal ou supérieur a l'heure du trajet. (<?= $res[1]; ?>h) </h6>
                        <h6>Vous ne pouvez réserver un interprète au maximum pendant 8h</h6>

                        <!-- Nombre d'interprètes : <input type="number" min="1" max="5" class="primary" name="quantite[<?php //echo $service->getIdService(); ?>]" value="1"></input> -->

                        <br> <br> <br>
                        <?php
                        $j=0;
                        while ($unInterprete = $interprete->fetch())
                        {
                          ?>
                          <table>

                            <tr>
                              <th scope="col">Nom : </th>
                              <th scope="col">Prenom : </th>
                              <th scope="col">Prix :</th>
                              <th scope="col">Note</th>
                              <th scope="col">Langue:</th>
                            </tr>
                            <tr>
                              <th scope="row"> <?= $unInterprete['last_name'];?></th>
                              <td> <?= $unInterprete['first_name'];?></td>
                              <td>  <?= $unInterprete['prixCollaborateur'].'€';?> </td>
                              <td>  <?= $unInterprete['rating'];?> </td>
                              <td>  <?= $unInterprete['description'];?> </td>
                            </tr>
                          </table>
                          <?php
                          $j++;
                        }
                        break;

                        case '12':

                        $coachSportif = $bdd->getPDO()->prepare('SELECT * FROM collaborateurs WHERE metier="coachSportif" ORDER BY idCollaborateurs DESC LIMIT 4 ');
                        $coachSportif->execute();
                        ?>
                        <h4> Réservation d'un coach sportif pendant la journée du trajet, veuillez choisir une plage horraire : </h4>
                        <h6>Pour que votre réservation soit valide, l'heure de début doit etre égal ou supérieur a l'heure du trajet. (<?= $res[1]; ?>h) </h6>
                        <h6>Vous  pouvez réserver un coach sportif  pendant 8h maximum</h6>


                        <br> <br> <br>
                        <?php
                        $j=0;
                        while ($unCoachSportif = $coachSportif->fetch())
                        {
                          ?>
                          <table>

                            <tr>
                              <th scope="col">Nom : </th>
                              <th scope="col">Prenom : </th>
                              <th scope="col">Prix :</th>
                              <th scope="col">Note</th>
                              <th scope="col">Domaine:</th>
                            </tr>
                            <tr>
                              <th scope="row"> <?= $unCoachSportif['last_name'];?></th>
                              <td> <?= $unCoachSportif['first_name'];?></td>
                              <td>  <?= $unCoachSportif['prixCollaborateur']. '€';?> </td>
                              <td>  <?= $unCoachSportif['rating'];?> </td>
                              <td>  <?= $unCoachSportif['description'];?> </td>
                              <td>
                              </td>
                            </tr>
                          </table>
                          <?php
                          $j++;
                        }
                        break;
                        case '13':

                        $coachCulture = $bdd->getPDO()->prepare('SELECT * FROM collaborateurs WHERE metier="coachCulture" ORDER BY idCollaborateurs DESC LIMIT 4 ');
                        $coachCulture->execute();
                        ?>

                        <h4> Réservation d'un coach cultures pendant la journée du trajet, veuillez choisir une plage horraire : </h4>
                        <h6>Pour que votre réservation soit valide, l'heure de début doit etre égal ou supérieur a l'heure du trajet. (<?= $res[1]; ?>h) </h6>
                        <h6>Vous  pouvez réserver un coach cultures  pendant 8h maximum</h6>

                        <br> <br> <br>
                        <?php
                        $j=0;
                        while ($unCoachCulture = $coachCulture->fetch())
                        {
                          ?>
                          <table>

                            <tr>
                              <th scope="col">Nom : </th>
                              <th scope="col">Prenom : </th>
                              <th scope="col">Prix :</th>
                              <th scope="col">Note</th>
                              <th scope="col">Domaine:</th>
                            </tr>
                            <tr>
                              <th scope="row"> <?= $unCoachCulture['last_name'];?></th>
                              <td> <?= $unCoachCulture['first_name'];?></td>
                              <td>  <?= $unCoachCulture['prixCollaborateur']. '€';?> </td>
                              <td>  <?= $unCoachCulture['rating'];?> </td>
                              <td>  <?= $unCoachCulture['description'];?> </td>
                            </tr>
                          </table>
                          <?php
                          $j++;
                        }
                        break;


                        case '16' :



                        break;
                        default:

                        break;
                      }


                      ?>
                      <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                          Fermer
                        </button>
                      </div>
                    </div>
                  </div>
                </div>


              </li>
              <?php
              $i++;
            }
            ?>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




<?php include "includehtml/footer.php" ?>
<script src="js/reservationChooseService/main.js"></script>
<script src="js/reservationChooseService/calendrier.js"></script>
</body>
</html>
