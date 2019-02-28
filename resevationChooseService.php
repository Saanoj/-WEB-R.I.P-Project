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
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/bootstrap4/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/main_styles.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/responsive.css">

  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/reservationChooseService/main.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

  <?php include 'includehtml/head.html'; ?>

  <link rel="stylesheet" type="text/css" href="css/choixService/main.css">

</head>
<body>
  <?php

  require 'Class/Autoloader.php';
  App\Autoloader::register();
  $bdd = new App\Database('rip');
  $form =new App\Form(array());
  $backOffice=0;
  $navbar = new App\Navbar($backOffice);
  $navbar->navbar();

  $form = new App\Form(array());

  //recup obj trajet de session
  $trajet = unserialize($_SESSION['trajet']);

  // Recuperation de l'heure du début

  
  $hour = $_SESSION['timeStart'];
   $res=explode(' ',$hour);
  //var_dump($res[1]);
   // var_dump(strotime($res[1]));
   var_dump(strtotime($hour));
 ;
  
  
  
    ?>

  <div class="container">
    <div class="row">
      <div class="offset-md-2 col-md-8">
        <div class="card" style="margin:50px 0">
          <!-- Default panel contents -->

          <div class="card-header">
            <h1 class="display-3">Choisissez vos services</h1>
            <?php $trajet->showInfosTrajet(); ?>
          </div>

          <form class="list-group list-group-flush container" method="POST" action="valideReservationServices.php">


            <div class="container col-md-12">


              <?php
              // Affichage d'un service
              $services = $bdd->getPDO()->prepare('SELECT * FROM services');
              $services->execute();
              $i=0;
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
                  </div><label class="switch col-md-2">
                    <input type="checkbox" class="primary" name="services[<?php echo $i ?>]" value="<?php echo $service->getIdService(); ?>">
                    <span class="slider round"></span>
                  </label>
                  <?php
                  if ($service->getIdService() != 1 && $service->getIdService() !=7 && $service->getIdService() != 8 && $service->getIdService() !=16 ) {
                    ?>

                    <!--<button type="button" name="services[<?php echo $i ?>]" class="btn btn-info">Choisir</button>-->
                  <?php } else { ?>


                    <button type="button" href="#costumModal<?php echo $i ?>" data-target="#costumModal<?php echo $i ?>" name="services[<?php echo $i ?>]" class="btn btn-info" data-toggle="modal">Choisir</button>

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
                              $datas = App\Restaurant::createRestaurant($unRestaurants['idRestaurant'],$unRestaurants['nomRestaurant'],$unRestaurants['prixMoyen'],$unRestaurants['horrairesDebut'],$unRestaurants['horrairesFin'],$unRestaurants['adresseRestaurant'],$unRestaurants['villeRestaurant']);
                             
                              
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
                                              <th scope="col">Quantité : </th>
                                             
                                          </tr>
                                          <tr>
                                              <th scope="row"> <?= $unRestaurants['nomRestaurant'];?></th>
                                              <td> <?= $unRestaurants['adresseRestaurant'];?></td>
                                              <td> <?= $unRestaurants['prixMoyen']. '€';?></td>
                                              <td><input type="number" min="1" max="10" class="primary" name="quantite[<?php echo $service->getIdService(); ?>]"></input></td>
                    
                                              <td>
                                              <div class="funkyradio-primary col-md-6 center-block">
                                                  <input type="radio"  name="idRestaurant" id="<?php echo $unRestaurants['idRestaurant'] ?>" value="<?php echo $unRestaurants['idRestaurant'] ?>" checked ></input>
                                                  <label for="radio<?php echo $unRestaurants['idRestaurant'] ?>">Choisir ce restaurant</label>
                                                </div>
                                              </td>
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
                            $datas = App\Hotel::createHotel($unHotel['idHotel'],$unHotel['nomHotel'],$unHotel['adresseHotel'],$unHotel['prixHotel']);
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
                          <th scope="row"> <?= $unHotel['nomHotel'];?></th>
                          <td> <?= $unHotel['adresseHotel'];?></td>
                          <td> <?= $unHotel['prixHotel'] . '€ la nuit';?></td>
                          <td> <?= $unHotel['typeChambre'];?></td>
                          <td> <?= $unHotel['litsDispo'];?></td>
                          <td><input type="number" class="primary" name="quantite[<?php echo $service->getIdService(); ?>]"></input></td>

                          <td>
                          <div class="funkyradio-primary col-md-6 center-block">
                              <input type="radio" name="idHotel" id="<?php echo $unHotel['idHotel'] ?>" value="<?php echo $unHotel['idHotel'] ?>" checked></input>
                              <label for="radio<?php echo $unHotel['idHotel'] ?>">Choisir cet hotel</label>
                            </div>
                          </td>
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
                            $datas = App\BilletTourisme::createBilletTourisme($unBillet['idBillet'],$unBillet['nomBillet'],$unBillet['isValide'],$unBillet['villeBillet'],$unBillet['prixBillet']);
                            ?>
                          

                          <table>
                     
                      <tr>
                          <th scope="col">Nom du billet : </th>
                          <th scope="col">Validité : </th>
                          <th scope="col">Ville : </th>
                          <th scope="col">Prix : </th>
                          <th scope="col">Quantité : </th>
                         
                      </tr>
                      <tr>
                          <th scope="row"> <?= $unBillet['nomBillet'];?></th>
                          <td>  <?php 
                          if  ($unBillet['isValide'] == 1) {
                            echo "Valide";}
                            else{ echo "Non valide";}?></td>
                          <td> <?= $unBillet['villeBillet'];?></td>
                          <td>  <?= $unBillet['prixBillet']. '€';?> </td>
                          <td><input type="number" class="primary" name="quantite[<?php echo $service->getIdService(); ?>]"></input></td>

                          <td>
                          <div class="funkyradio-primary col-md-6 center-block">
                              <input type="radio" name="idBillet" id="<?php echo $unBillet['idBillet'] ?>" value="<?php echo $unBillet['idBillet'] ?>" checked></input>
                              <label for="radio<?php echo $unBillet['idBillet'] ?>">Choisir ce billet</label>
                            </div>
                          </td>
                      </tr>
                  </table>
<?php

                          }
                    break;

                          case '16' : 
                          
                        
                        default:
                          break;
                      }
                 
                
                      ?>
                      <div class="modal-footer">
                        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                          Sauvegarder
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

              <?php } ?>
            </li>
            <?php
            $i++;
          }
          ?>
        </div>
        <br>
        <div class="center-block">
          <?php echo $form->submit(); ?>
        </div>
      </form>
    </div>
  </div>
</div>
</div>




<?php include "includehtml/footer.php" ?>
</body>
</html>
