<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <title><?php echo _TITRE_SERVICE; ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Ride in pride">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/main_styles.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/responsive.css">
  <link rel="stylesheet" type="text/css" href="css/choixService/main.css">


  <?php include 'includehtml/head.html'; ?>
</head>
<body class="bg-secondary">



  <?php

  require_once __DIR__ .'/require_class.php';

  $bdd = new App\Database('rip');
  $form =new App\Form(array());

  $type = 3;
  $navbar = new App\Navbar($type);
  $navbar->navbar();

  $form = new App\Form(array());

  //recup obj trajet de session
  $trajet = unserialize($_SESSION['trajet']);

  // Recuperation de l'heure de Fin
  $resFin = $trajet->getEndofTrajet();

  $hour = $trajet->getDateDebut();
  //Recuperation date/heure/min de debut
  $res=explode(' ',$trajet->getDateDebut());

  ?>
  <main>
    <div class="container">
      <div class="row">
        <div class="offset-md-2 col-md-8">
          <div class="card" style="margin:50px 0">
            <!-- Default panel contents -->

            <div class="card-header">
              <h1 class="display-3 center-text"><?php echo _TITRE_CHOOSE_SERVICE; ?></h1>
              <?php $trajet->showInfosTrajet(); ?>
            </div>

            <form class="list-group list-group-flush container" method="POST" action="valideReservationServices.php" onsubmit="return checkGlobal(this)">


              <div class="container">


                <?php
                $categorieSet = array();
                // Affichage d'un service
                $services = $bdd->getPDO()->prepare('SELECT * FROM services ORDER BY categorie');
                $services->execute();

                $i=1;
                while($unService = $services->fetch())
                {
                  $service = new App\Service($unService["idService"],$unService["nomService"],$unService["description"],$unService["prixService"],$unService["categorie"]);


                  if(!in_array($unService["categorie"],$categorieSet)){
                    if (isset($infoCategorie)) {
                      if ($infoCategorie==1) {
                        echo "</div>";
                        $infoCategorie=0;
                      }
                    }
                    $infoCategorie=1;
                    array_push($categorieSet,$unService["categorie"]);
                    ?>
                    <?php
                    $newCategorie = preg_replace("/[^a-zA-Z]/", "", str_replace(" ","",$unService["categorie"]));
                    ?>


                    <li class="list-group-item row bg-white">
                      <a class="h3 col-md-9" style="color:black"><?php echo $unService["categorie"] ?></a>
                      <!--<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample  " aria-expanded="false" aria-controls="collapseExample">-->
                      <button class="btn btn-primary pull-right fa fa-plus col-md-3" style="background-color:black" type="button" data-toggle="collapse" data-target="<?php echo "#".$newCategorie;?>" aria-expanded="true" aria-controls="<?php echo $newCategorie;?>"><?= _SERVICE_OUVRIR ?></button>
                    </li>
                    <div class="list-group-item collapse" style="color:black" id="<?php echo $newCategorie;?>">


                      <?php
                      //var_dump($res);
                      //var_dump($servicesInSameCategorie);
                    }
                    ?>
                    <li class="row border-bottom mt-1 pt-1 pb-1">

                      <h3 class="col-md-6" style="color:black"><?php echo $service->getNomService(); ?></h3>
                      <h6 class="col-md-2" style="color:black">idService: <?php echo $service->getIdService()."<br>"; ?> Prix: <?php echo $service->getPrixService()." €"; ?></h6>
                      <div class="col-md-2" style="color:black">
                        <label class=""><?= _DRIVER_INFO_DESCRIPTION ?></label>
                        <?php echo $service->getDescription(); ?>
                      </div>
                      <div class="col-md-2">
                        <label class="switch">
                          <input type="checkbox" class="primary" id="<?php echo $service->getIdService(); ?>" name="services[<?php echo $i ?>]" value="<?php echo $service->getIdService(); ?>" onchange="checkInput(this)">
                          <span class="slider round" id="slider<?=$service->getIdService();?>"></span>
                        </label>
      <button style="visibility:hidden" id="services[<?php echo $i ?>]" type="button" href="#costumModal<?php echo $i ?>" data-target="#costumModal<?php echo $i ?>" name="services[<?php echo $service->getIdService(); ?>]" class="btn btn-info" data-toggle="modal"><?php echo _SERVICES_CHOISIR; ?></button>
                      </div>


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
?>
                              <table>

                              <tr>
                                <th scope="col"><?=_SERVICE1_NOM_RESTAURANT?></th>
                                <th scope="col"><?=_SERVICE1_ADRESSE?> </th>
                                <th scope="col"><?=_SERVICE1_PRIX?></th>
                                <th scope="col"><?=_SERVICE1_QUANTITE?></th>

                              </tr>
                              <?php
                              $restaurants = $bdd->getPDO()->prepare('SELECT * FROM restaurants ORDER BY idRestaurant DESC LIMIT 10 ');
                              $restaurants->execute();
                              ?>

                              <?php
                              while($unRestaurants = $restaurants->fetch())
                              {
                                $datas = App\Restaurant::createRestaurant($unRestaurants['idRestaurant'],$unRestaurants['nom'],$unRestaurants['prix'],$unRestaurants['horrairesDebut'],$unRestaurants['horrairesFin'],$unRestaurants['adresseRestaurant'],$unRestaurants['villeRestaurant']);


                                $unRestaurants['horrairesDebut'] = $res[0] . ' ' . $unRestaurants['horrairesDebut'];
                                $unRestaurants['horrairesFin'] = $res[0] . ' ' . $unRestaurants['horrairesFin'];

                                if (strtotime($hour) - strtotime($unRestaurants['horrairesDebut'])> 0 && strtotime($hour) - strtotime($unRestaurants['horrairesFin']) < 0 && $unRestaurants['isDispo'] == 1 )
                                {

                                  ?>
                                      <tr>
                                    <th scope="row"> <?= $unRestaurants['nom'];?></th>
                                    <td> <?= $unRestaurants['adresseRestaurant'];?></td>
                                    <td> <?= $unRestaurants['prix'] . '€/repas';?></td>
                                    <td><input type="number"  id="quantites<?=$service->getIdService()."[".$unRestaurants['idRestaurant']."]";?>" class="primary" name="quantite_<?=$unRestaurants['idRestaurant'];?>"  onkeyup="checkQuantiteRestaurant(this)"/></td>


                              <td>
                                        <div class="funkyradio-primary col-md-6 center-block">
                                          <input type="checkbox" name="idRestaurant<?php echo $unRestaurants['idRestaurant'] ?>" id="idRestaurant<?php echo $unRestaurants['idRestaurant'] ?>"  onchange="checkRadioRestaurant(this)" >
                                          <label for="radio<?php echo $unRestaurants['idRestaurant'] ?>">Choisir ce restaurant</label>
                                          <button style="visibility:hidden" id="buttonHoursRestaurant<?php echo $unRestaurants['idRestaurant']?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#heuresRestaurant<?php echo $unRestaurants['idRestaurant']?>">Heures</button>

                                          <input type="hidden" id="heureTrajetFin"value="<?= $resFin;?>">
                                         <input type="hidden" id="heureTrajetDebut"value="<?= $res[1];?>">
                                          <div id="heuresRestaurant<?php echo $unRestaurants['idRestaurant'] ?>" class="modal fade" role="dialog" style="z-index: 1400;">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                              <div class="modal-header">

                                          <h4 class="modal-title">Heure de réservation pour le restaurant  <?php echo $unRestaurants['nom'] ?></h4>
                                          </div>
                                         <div id="Restaurant" class="modal-body">
                                         Debut <input type="time" id="startRestaurant<?php echo $unRestaurants['idRestaurant'] ?>" value="<?= $res[1]; ?>" name="startRestaurant<?php echo $unRestaurants['idRestaurant'] ?>" onchange="checkHeureFinBillet(this)">
                                           <input type="time" style="visibility:hidden" id="endRestaurant<?php echo $unRestaurants['idRestaurant'] ?>" value="<?= $resFin; ?>" name="endRestaurant<?php echo $unRestaurants['idRestaurant'] ?>">

                                                </div>
                                                <div class="modal-footer"> <div>

                                          </div>
                                              </div>
                                            </div>

                                        </div>
                                      </td>
                                    </tr>
                                    <?php $j++; ?>
                                 <?php
                                }
                               ?> </table> <?php

                              }
                              break;
                              case '2':
                              case '3' :
                              case '4' :
                              case '5':
                              case '6':
                              case '9':
                              case '15':
                              case '16' :
                              case '18' :
                              case '19' :

                              ?>

                                              <!-- Modal content-->

                                              <div class="modal-content">
                                         <div id="ordinateurs_<?=$service->getIdService();?> " class="modal-body">
                                       <?php /*  <form action="valideReservationServices.php" id="form<?=$service->getIdService();?>" method="POST" onsubmit="return checkheure(this)"> */ ?>

                                         <?= _SERVICE1_QUANTITE ?> <input type="number" value="" id="quantites<?=$service->getIdService();?>" class="primary" name="quantite[<?php echo $service->getIdService(); ?>]"  onkeyup="checkQuantiteOrdinateur(this)"/>

                                        <br>

                                                </div>
                                                <div class="modal-footer"> <div>

                                          </div>


                              <?php
                              break;

                              case '7':

                              $hotel = $bdd->getPDO()->prepare('SELECT * FROM chambre INNER JOIN hotel ON chambre.idHotel = hotel.idHotel WHERE isDispo = 1 AND litsDispo > 0 ORDER BY idChambre DESC LIMIT 10 ');
                              $hotel->execute();
                              ?>   <table>

                              <tr>
                                <th scope="col"><?=  _SERVICE7_NOM_HOTEL?></th>
                                <th scope="col"><?=  _SERVICE7_ADRESSE?></th>
                                <th scope="col"><?= _SERVICE7_PRIX ?></th>
                                <th scope="col"><?= _SERVICE7_TYPE_CHAMBRE ?> </th>
                                <th scope="col"><?= _SERVICE7_NOM_LIT ?> </th>
                                <th scope="col"><?= _SERVICE7_CHOIX_HORRAIRES ?> </th>

                              </tr>
                              <?php
                              while($unHotel = $hotel->fetch())
                              {
                                $datas = App\Hotel::createHotel($unHotel['idHotel'],$unHotel['nom'],$unHotel['adresseHotel'],$unHotel['prix']);
                                $chambre = App\Chambre::createChambre($unHotel['idChambre'],$unHotel['typeChambre'],$unHotel['idHotel'],$unHotel['litsDispo'],$unHotel['isDispo']);




                                ?>

                                  <tr>
                                    <th scope="row"> <?= $unHotel['nom'];?></th>
                                    <td> <?= $unHotel['adresseHotel'];?></td>
                                    <td> <?= $unHotel['prix'] . '€ la nuit';?></td>
                                    <td> <?= $unHotel['typeChambre'];?></td>
                                    <td> <?= $unHotel['litsDispo'];?></td>

                                    <td>
                                    <div class="funkyradio-primary col-md-6 center-block">
                                          <input type="checkbox" name="idHotel<?php echo $unHotel['idHotel'] ?>_<?= $unHotel['idChambre'] ?>" id="idHotel<?php echo $unHotel['idHotel'] ?>[<?= $unHotel['idChambre'] ?>]" onchange="checkRadioHotel(this)">
                                          <label for="radio<?php echo $unHotel['idHotel'] ?>"><?= _SERVICE7_CHOOSE?></label>
                                          <button  style="visibility:hidden" id="buttonHoursHotel<?php echo $unHotel['idHotel']?>[<?= $unHotel['idChambre'] ?>]" type="button" class="btn btn-dark" data-toggle="modal" data-target="#heuresHotel<?php echo $unHotel['idHotel'] ?>_<?= $unHotel['idChambre'] ?>"><?=_SERVICE7_HEURES ?> </button>

                                          <input type="hidden" id="heureTrajetFin"value="<?= $resFin;?>">
                                         <input type="hidden" id="heureTrajetDebut"value="<?= $res[1];?>">
                                          <div id="heuresHotel<?php echo $unHotel['idHotel'] ?>_<?= $unHotel['idChambre'] ?>" class="modal fade" role="dialog" style="z-index: 1400;">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                              <div class="modal-header">

                                          <h4 class="modal-title"><?= _SERVICE7_HORRAIRES." ".$unHotel['nom'] ?></h4>
                                          </div>
                                         <div id="Hotel" class="modal-body">
                                         <?= _SERVICE7_DEBUT ?> <input type="time" id="startHotel<?php echo $unHotel['idHotel'] ?>[<?= $unHotel['idChambre'] ?>]" value="<?= $res[1]; ?>" name="startHotel<?php echo $unHotel['idHotel'] ?>_<?= $unHotel['idChambre'] ?>" onchange="checkHeureFinHotel(this)">
                                           <input type="time" style="visibility:hidden" id="endHotel<?php echo $unHotel['idHotel'] ?>[<?= $unHotel['idChambre'] ?>]" value="<?= $resFin; ?>" name="endHotel<?php echo $unHotel['idHotel'] ?>_<?= $unHotel['idChambre'] ?>">

                                                </div>
                                                <div class="modal-footer"> <div>

                                          </div>
                                              </div>
                                            </div>

                                        </div>
                                    </td>
                                    <?php $j++; ?>
                                  </tr>

                                <?php

                              }
                               ?></table> <?php
                              break;

                              case '8' :
                              $billet = $bdd->getPDO()->prepare('SELECT * FROM billettourisme ORDER BY idBillet DESC LIMIT 10');
                              $billet->execute();
                              $j=0;
                              ?>
                                   <table>
                                  <tr>
                                    <th scope="col"><?= _SERVICE8_NOM_BILLET?></th>
                                    <th scope="col"><?= _SERVICE8_VALIDITE?></th>
                                    <th scope="col"><?= _SERVICE8_VILLE?></th>
                                    <th scope="col"><?= _SERVICE1_PRIX?> </th>
                                    <th scope="col"><?= _SERVICE1_QUANTITE?> </th>
                                  </tr>
                                  <?php
                              while($unBillet = $billet->fetch())
                              {

                                $datas = App\BilletTourisme::createBilletTourisme($unBillet['idBillet'],$unBillet['nom'],$unBillet['isValide'],$unBillet['villeBillet'],$unBillet['prix']);
                                ?>

                                  <tr>
                                    <th scope="row"> <?= $unBillet['nom'];?></th>
                                    <td>  <?php
                                    if  ($unBillet['isValide'] == 1) {
                                      echo "Valide";}
                                      else{ echo "Non valide";}?></td>
                                      <td> <?= $unBillet['villeBillet'];?></td>
                                      <td>  <?= $unBillet['prix']. '€';?> </td>
                                      <td><input type="number"  id="quantites<?=$service->getIdService()."[".$unBillet['idBillet']."]";?>" class="primary" name="quantite_<?=$unBillet['idBillet'];?>"  onkeyup="checkQuantiteBillet(this)"/></td>

                                      <td>
                                        <div class="funkyradio-primary col-md-6 center-block">
                                          <input type="checkbox" name="idBillet<?php echo $unBillet['idBillet'] ?>" id="idBillet<?php echo $unBillet['idBillet'] ?>"  onchange="checkRadioBillet(this)" >
                                          <label for="radio<?php echo $unBillet['idBillet'] ?>"><?= _SERVICE7_CHOOSE?></label>
                                          <button style="visibility:hidden" id="buttonHoursBillet<?php echo $unBillet['idBillet']?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#heuresBillet<?php echo $unBillet['idBillet']?>"><?=_SERVICE7_HEURES?></button>

                                          <input type="hidden" id="heureTrajetFin"value="<?= $resFin;?>">
                                         <input type="hidden" id="heureTrajetDebut"value="<?= $res[1];?>">
                                          <div id="heuresBillet<?php echo $unBillet['idBillet'] ?>" class="modal fade" role="dialog" style="z-index: 1400;">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                              <div class="modal-header">

                                          <h4 class="modal-title"><?= _SERVICE8_NOM_BILLET ." ".$unBillet['nom'] ?></h4>
                                          </div>
                                         <div id="billet" class="modal-body">
                                         <?= _SERVICE8_HORRAIRES ?> <input type="time" id="startBillet<?php echo $unBillet['idBillet'] ?>" value="<?= $res[1]; ?>" name="startBillet<?php echo $unBillet['idBillet'] ?>" onchange="checkHeureFinBillet(this)">
                                           <input type="time" style="visibility:hidden" id="endBillet<?php echo $unBillet['idBillet'] ?>" value="<?= $resFin; ?>" name="endBillet<?php echo $unBillet['idBillet'] ?>">

                                                </div>
                                                <div class="modal-footer"> <div>

                                          </div>
                                              </div>
                                            </div>

                                        </div>
                                      </td>
                                    </tr>
                                    <?php $j++; ?>

                                  <?php
                                }
                                 ?></table> <?php
                                break;
                                case '10' :
                                ?>
                                <div class="container">
                                  <h5><?= _SERVICE10_TEXT?></h5>
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
                                <h4> <?php echo _INTERPRETE_TITLE ?></h4>
                                <h6><?php echo _COACH_VERIFY_H ?> (<?= $res[1]; ?>h) </h6>
                                <br> <br> <br>
                                <?php
                                $j=0;
                                while ($unInterprete = $interprete->fetch())
                                {
                                  ?>
                                  <table>

                                    <tr>
                                      <th scope="col"><?php echo _COACH_NOM ?></th>
                                      <th scope="col"><?php echo _COACH_PRENOM ?> </th>
                                      <th scope="col"><?php echo _COACH_PRIX ?></th>
                                      <th scope="col"><?php echo _COACH_NOTE ?></th>
                                      <th scope="col"><?php echo _COACH_LANGUE ?></th>
                                      <th scope="col"><?php echo _COACH_HEURES ?></th>
                                    </tr>
                                    <tr>
                                      <th scope="row"> <?= $unInterprete['last_name'];?></th>
                                      <td> <?= $unInterprete['first_name'];?></td>
                                      <td>  <?= $unInterprete['prixCollaborateur'].'€';?> </td>
                                      <td>  <?= $unInterprete['rating'];?> </td>
                                      <td>  <?= $unInterprete['description'];?> </td>
                                      <td>
                                        <div class="funkyradio-primary col-md-6 center-block">
                                          <input type="checkbox" name="idInterprete<?php echo $unInterprete['idCollaborateurs']?>" id="<?php echo $unInterprete['idCollaborateurs'] ?>" value="<?php echo $unInterprete['idCollaborateurs'] ?>" onchange="checkRadioInterprete(this)">
                                          <label for="radio<?php echo $unInterprete['idCollaborateurs'] ?>"><?php echo _COACH_CHOIX_INTERPRETE ?></label>
                                        </div>
                                        <div>
                                        <button style="visibility:hidden" id="buttonHours<?php echo $unInterprete['idCollaborateurs']?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#heuresInterprete<?php echo $unInterprete['idCollaborateurs']?>"><?php echo _COACH_DOMAINE_HEURES ?></button>


                                        <input type="hidden" id="heureTrajetFin"value="<?= $resFin;?>">
                                         <input type="hidden" id="heureTrajetDebut"value="<?= $res[1];?>">
                                          <div id="heuresInterprete<?php echo $unInterprete['idCollaborateurs']?>" class="modal fade" role="dialog" style="z-index: 1400;">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                              <div class="modal-header">
                                          <h4 class="modal-title"> <?php echo _INTERPRETE_H ?> <?= $unInterprete['first_name']." ".$unInterprete['last_name']; ?></h4>
                                          </div>
                                         <div id="interprete" class="modal-body">
                                         <?php echo _COACH_START ?> <input type="time" id="startInterprete<?= $unInterprete['idCollaborateurs'] ?>" value="<?= $res[1]; ?>" name="startInterprete<?= $unInterprete['idCollaborateurs'] ?>" onchange="checkHeureDebutInterprete(this)">
                                         <?php echo _COACH_END ?>  <input type="time" id="endInterprete<?= $unInterprete['idCollaborateurs'] ?>" value="<?= $resFin; ?>" name="endInterprete<?= $unInterprete['idCollaborateurs'] ?>"  onchange="checkHeureFinInterprete(this)">

                                                </div>
                                                <div class="modal-footer"> <div>

                                          </div>
                                              </div>
                                            </div>
                                            </div>
                                        </div>
                                      </td>
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
                                <h4><?php echo _COACH_SPORTIF_TITLE ?></h4>
                                <h6><?php echo _COACH_VERIFY_H ?> (<?= $res[1]; ?>h) </h6>
                                <br> <br> <br>
                                <?php
                                $j=0;
                                while ($unCoachSportif = $coachSportif->fetch())
                                {
                                  ?>
                                  <table>
                                    <tr>
                                      <th scope="col"><?php echo _COACH_NOM ?></th>
                                      <th scope="col"><?php echo _COACH_PRENOM ?> </th>
                                      <th scope="col"><?php echo _COACH_PRIX ?></th>
                                      <th scope="col"><?php echo _COACH_NOTE ?></th>
                                      <th scope="col"><?php echo _COACH_DOMAINE ?></th>
                                    </tr>
                                    <tr>
                                      <th scope="row"> <?= $unCoachSportif['last_name'];?></th>
                                      <td> <?= $unCoachSportif['first_name'];?></td>
                                      <td>  <?= $unCoachSportif['prixCollaborateur']. '€';?> </td>
                                      <td>  <?= $unCoachSportif['rating'];?> </td>
                                      <td>  <?= $unCoachSportif['description'];?> </td>
                                      <td>
                                        <div class="funkyradio-primary col-md-6 center-block">
                                          <input type="checkbox" name="idCoachSportif<?=$unCoachSportif['idCollaborateurs']?>" id="<?php echo $unCoachSportif['idCollaborateurs'] ?>" value="<?php echo $unCoachSportif['idCollaborateurs'] ?>" onchange="checkRadioCoachSportifs(this)">
                                          <label for="radio<?php echo $unCoachSportif['idCollaborateurs'] ?>"><?php echo _COACH_CHOIX_CULTURE ?></label>
                                          <button style="visibility:hidden" id="buttonHours<?php echo $unCoachSportif['idCollaborateurs']?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#heuresCoachSportif<?php echo $unCoachSportif['idCollaborateurs']?>"><?php echo _COACH_DOMAINE_HEURES ?></button>
                                        </div>
                                        <div id="heuresCoachSportif<?php echo $unCoachSportif['idCollaborateurs']?>" class="modal fade" role="dialog" style="z-index: 1400;">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                              <div class="modal-header">
                                          <h4 class="modal-title"><?php echo _COACH_SPORTIF_H ?> <?= $unCoachSportif['first_name']." ".$unCoachSportif['last_name']; ?></h4>
                                          </div>
                                         <div id="interprete" class="modal-body">
                                         <?php echo _COACH_START ?> <input type="time" id="startCoachSportif<?= $unCoachSportif['idCollaborateurs'] ?>" value="<?= $res[1]; ?>" name="startCoachSportif<?= $unCoachSportif['idCollaborateurs'] ?>" onchange="checkHeureDebutSportif(this)">
                                         <?php echo _COACH_END ?>  <input type="time" id="endCoachSportif<?= $unCoachSportif['idCollaborateurs'] ?>" value="<?= $resFin; ?>" name="endCoachSportif<?= $unCoachSportif['idCollaborateurs'] ?>"  onchange="checkHeureFinSportif(this)">

                                                </div>
                                                <div class="modal-footer"> <div>

                                          </div>
                                              </div>
                                            </div>

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
                                <h4> <?php echo _COACH_CULTURE_TITLE ?></h4>
                                <h6><?php echo _COACH_VERIFY_H ?>(<?= $res[1]; ?>h) </h6>
                                 <br> <br> <br>
                                <?php
                                $j=0;
                                while ($unCoachCulture = $coachCulture->fetch())
                                {
                                  ?>
                                  <table>
                                    <tr>
                                      <th scope="col"><?php echo _COACH_NOM ?></th>
                                      <th scope="col"><?php echo _COACH_PRENOM ?> </th>
                                      <th scope="col"><?php echo _COACH_PRIX ?></th>
                                      <th scope="col"><?php echo _COACH_NOTE ?></th>
                                      <th scope="col"><?php echo _COACH_DOMAINE ?></th>
                                    </tr>
                                    <tr>
                                      <th scope="row"> <?= $unCoachCulture['last_name'];?></th>
                                      <td> <?= $unCoachCulture['first_name'];?></td>
                                      <td>  <?= $unCoachCulture['prixCollaborateur']. '€';?> </td>
                                      <td>  <?= $unCoachCulture['rating'];?> </td>
                                      <td>  <?= $unCoachCulture['description'];?> </td>
                                      <td>
                                        <div class="funkyradio-primary col-md-6 center-block">
                                        <input type="checkbox" name="idCoachCulture<?=$unCoachCulture['idCollaborateurs']?>" id="<?php echo $unCoachCulture['idCollaborateurs'] ?>" value="<?php echo $unCoachCulture['idCollaborateurs'] ?>" onchange="checkRadioCoachCulture(this)">
                                          <label for="radio<?php echo $unCoachCulture['idCollaborateurs'] ?>"><?php echo _COACH_CHOIX_CULTURE ?></label>
                                          <button style="visibility:hidden" id="buttonHours<?php echo $unCoachCulture['idCollaborateurs']?>" type="button" class="btn btn-primary" data-toggle="modal" data-target="#heuresCoachCulture<?php echo $unCoachCulture['idCollaborateurs']?>"><?php echo _COACH_DOMAINE_HEURES ?></button>
                                          <div id="heuresCoachCulture<?php echo $unCoachCulture['idCollaborateurs']?>" class="modal fade" role="dialog" style="z-index: 1400;">
                                            <div class="modal-dialog modal-dialog-centered">
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                              <div class="modal-header">
                                          <h4 class="modal-title"><?php echo _COACH_CULTURE_H ?> <?= $unCoachCulture['first_name']." ".$unCoachCulture['last_name']; ?></h4>
                                          </div>
                                         <div id="interprete" class="modal-body">
                                         <?php echo _COACH_START ?> <input type="time" id="startCoachCulture<?= $unCoachCulture['idCollaborateurs'] ?>" value="<?= $res[1]; ?>" name="startCoachCulture<?= $unCoachCulture['idCollaborateurs'] ?>" onchange="checkHeureDebutCulture(this)">
                                         <?php echo _COACH_END ?>  <input type="time" id="endCoachCulture<?= $unCoachCulture['idCollaborateurs'] ?>" value="<?= $resFin; ?>" name="endCoachCulture<?= $unCoachCulture['idCollaborateurs'] ?>"  onchange="checkHeureFinCulture(this)">

                                                </div>
                                                <div class="modal-footer"> <div>

                                          </div>
                                              </div>
                                            </div>
                                        </div>
                                      </td>
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

                               <?php /* <input type="button" value="Sauvegarder" class="btn btn-success" id="<?= $service->getIdService();?>" onclick="return checkheure(this)"/> */ ?>
                               <input type="button" value="Sauvegarder" class="btn btn-success" data-dismiss="modal" id="<?= $service->getIdService();?>"/>
                </form>

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
                  <br>
                  <div class="list-group-item center-block">
                    <div class="center-block">
                      <?php echo $form->submit(); ?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
      <?php include "includehtml/footer.php" ?>

      <script src="js/reservationChooseService/main.js"></script>
    </body>
    </html>
