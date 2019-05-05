<?php
session_start();
deleteMtx();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Reservation de chauffeur</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Ride in pride">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/main_styles.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/responsive.css">

  <link rel="stylesheet" type="text/css" href="css/choixDriver/main.css">


  <?php
  include 'includehtml/head.html'; ?>
</head>
<body class="bg-secondary">
  <?php


  require_once __DIR__ .'/require_class.php';

  $bdd = new App\Database('rip');
  $type = 3;
  $navbar = new App\Navbar($type);
  $navbar->navbar();

  $form = new App\Form(array());

  $req=$bdd->getPDO()->prepare('SELECT * FROM linkabonnemententreprise WHERE idClient= :idClient');
  $req->execute(array('idClient' => $_SESSION['id']));
  $isAbonnee = $req->fetch();



  // On recupere l'objet trajet contenant nos infos de trajet depuis la session
  $trajet = unserialize($_SESSION['trajet']);


  ?>
  <div class="container">
    <div class="row">
      <div class="offset-md-2 col-md-8">
        <div class="card" style="margin:50px 0">

          <!-- Infos Trajet -->
          <div class="card-header bg-light">
            <h1 class="display-2 text-center">Devis</h1>
            <?php $trajet->showInfosTrajet(); ?>
            <?php echo "<p>ID de votre trajet: ".$_SESSION["idTrajet"]."</p>" ?>
          </div>

          <!-- Info choix des services -->
          <div class="list-group list-group-flush">
            <h3 class="display-4 text-center m-3">Services choisi</h3>
            <p class="center-block">
              <?php
              //services, que si on a un abonnement
              if (isset($isAbonnee['idAbonnement'])) {
                //on recupere les id des services choisis sur ce trajet
                $idServices = $bdd->query('SELECT * FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');

                //$idCollaborateurMultiples = $bdd->query('SELECT idAnnexe FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].' AND (idService=11 OR idService=12 OR idService=13)');

                if (empty($idServices)) {
                  echo "<div class='offset-4 col-md-4'>Aucun services selectionnés</div>";
                }else {
                  if (empty($idCollaborateurMultiples)) {

                  }
                  //on boucle les id des services choisis
                  $i=0;$j=0;$k=0;$z=0;
                  $h=0;$l=0;$m=0;$n=0;$o=0;
                  $aa=0;$ab=0;$ac=0;$ad=0;$ae=0;

                  $arrayLink = array();

                  foreach ($idServices as $unIdService) {



                    //on recupere les infos du service en fonction de son id
                    $service = $bdd->queryOne('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');

                    $stmtIdLink = "";
                    foreach ($arrayLink as $link) {
                      $stmtIdLink.=" AND idLink != ".$link;
                    }
                    //if (!in_array($linkService2["idlink"], $arrayLink)) {
                      $linkService = $bdd->queryOne('SELECT * FROM linkServicetrajet WHERE idService='.$unIdService["idService"].' AND idTrajet='.$_SESSION["idTrajet"].' '.$stmtIdLink);
                    //}

                    array_push($arrayLink,$linkService['idLink']);

                    // var_dump($linkService);

                    //choix en fonction du type de service special
                    if($unIdService["idService"] == 1){
                      $infoLinkService = $bdd->queryOne('SELECT * FROM restaurants WHERE idRestaurant='.$unIdService["idAnnexe"].'');
                      $typeEtablissement="Restaurant";

                    }elseif ($unIdService["idService"] == 7) {
                      $infoLinkService = $bdd->queryOne('SELECT * FROM chambre INNER JOIN hotel WHERE chambre.idHotel = hotel.idHotel AND chambre.idChambre = '.$unIdService["idAnnexe"].'');
                      $typeEtablissement="Hotel";

                    }elseif ($unIdService["idService"] == 8) {
                      $infoLinkService = $bdd->queryOne('SELECT * FROM billettourisme WHERE idBillet='.$unIdService["idAnnexe"].'');
                      $typeEtablissement="Billet touristque";

                    }elseif ($unIdService["idService"] == 11) {
                      $infoLinkService = $bdd->query('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].'');
                      $typeEtablissement="Interprete";
                      $infoLinkService=$infoLinkService[$i];
                      $i++;
                      //var_dump($infoLinkService);
                    }elseif ($unIdService["idService"] == 12) {
                      $infoLinkService = $bdd->query('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].'');
                      $typeEtablissement="Coach Sportif";
                      $infoLinkService=$infoLinkService[$j];
                      $j++;

                    }elseif ($unIdService["idService"] == 13) {
                      $infoLinkService = $bdd->query('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].'');
                      $typeEtablissement="Coach Culture";
                      $infoLinkService=$infoLinkService[$k];
                      $k++;
                    }else {

                    }


                    //Affichage des infos
                    echo "<div class='offset-2 col-md-8'>";
                    if ($linkService["idAnnexe"] < 0) {

                      if ($unIdService["idService"] == 2) {
                        if ($h == 0) {
                          $q = countElement($bdd,$service["idService"]);
                          echo "ID: ".$service["idService"]." | ".$service["nomService"]." | Quantitée: ".$q;
                          $h++;
                          echo "<br><br>";
                        }
                      }else if ($unIdService["idService"] == 3) {
                        if ($l == 0) {
                          $q = countElement($bdd,$service["idService"]);
                          echo "ID: ".$service["idService"]." | ".$service["nomService"]." | Quantitée: ".$q;
                          $l++;
                          echo "<br><br>";
                        }
                      }else if ($unIdService["idService"] == 4) {
                        if ($m == 0) {
                          $q = countElement($bdd,$service["idService"]);
                          echo "ID: ".$service["idService"]." | ".$service["nomService"]." | Quantitée: ".$q;
                          $m++;
                          echo "<br><br>";
                        }
                      }else if ($unIdService["idService"] == 5) {
                        if ($n == 0) {
                          $q = countElement($bdd,$service["idService"]);
                          echo "ID: ".$service["idService"]." | ".$service["nomService"]." | Quantitée: ".$q;
                          $n++;
                          echo "<br><br>";
                        }

                      }else if ($unIdService["idService"] == 6) {
                        if ($o == 0) {
                          $q = countElement($bdd,$service["idService"]);
                          echo "ID: ".$service["idService"]." | ".$service["nomService"]." | Quantitée: ".$q;
                          $o++;
                          echo "<br><br>";
                        }
                      } else if ($unIdService["idService"] == 9) {
                        if ($aa == 0) {
                          $q = countElement($bdd,$service["idService"]);
                          echo "ID: ".$service["idService"]." | ".$service["nomService"]." | Quantitée: ".$q;
                          $aa++;
                          echo "<br><br>";
                        }
                      }else if ($unIdService["idService"] == 15) {
                        if ($ab == 0) {
                          $q = countElement($bdd,$service["idService"]);
                          echo "ID: ".$service["idService"]." | ".$service["nomService"]." | Quantitée: ".$q;
                          $ab++;
                          echo "<br><br>";
                        }
                      }else if ($unIdService["idService"] == 16) {
                        if ($ac == 0) {
                          $q = countElement($bdd,$service["idService"]);
                          echo "ID: ".$service["idService"]." | ".$service["nomService"]." | Quantitée: ".$q;
                          $ac++;
                          echo "<br><br>";
                        }
                      }else if ($unIdService["idService"] == 18) {
                        if ($ad == 0) {
                          $q = countElement($bdd,$service["idService"]);
                          echo "ID: ".$service["idService"]." | ".$service["nomService"]." | Quantitée: ".$q;
                          $ad++;
                          echo "<br><br>";
                        }
                      }else if ($unIdService["idService"] == 19) {
                        if ($ae == 0) {
                          $q = countElement($bdd,$service["idService"]);
                          echo "ID: ".$service["idService"]." | ".$service["nomService"]." | Quantitée: ".$q;
                          $ae++;
                          echo "<br><br>";
                        }
                      }
                    } else if ($linkService["idService"] == 10) {

                      $req=$bdd->getPDO()->prepare('SELECT * FROM serviceautre WHERE emailClient = :emailClient ORDER BY idMessage DESC');
                      $req->bindValue(':emailClient',$_SESSION['email']);
                      $req->execute();
                      $unMessage = $req->fetch();
                      echo "ID: ".$service["idService"]." | ". $service["nomService"]." service | "."Votre message est  : ".$unMessage['contenuMessage']." publié le : ".$unMessage['dateMessage'];
                      echo "<br><br>";

                    }
                    else if ($linkService["idService"] == 11) {
                      echo "ID: ".$service["idService"]." | ".$service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]." | Langue: ".$infoLinkService["description"];
                      echo "<br><br>";
                    }
                    else if ($linkService["idService"] == 12) {
                      echo "ID: ".$service["idService"]." | ".$service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]." | Domaine: ".$infoLinkService["description"];
                      echo "<br><br>";
                    }
                    else if ($linkService["idService"] == 13) {
                      echo "ID: ".$service["idService"]." | ".$service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]." | Guide en: ".$infoLinkService["description"];
                      echo "<br><br>";
                    }
                    else if($linkService["idService"] == 7)
                    {
                      echo "ID: ".$service["idService"]." |  ".$typeEtablissement." ".$infoLinkService["nom"]." | Quantitée: ".$linkService["quantite"]." chambres";
                      echo "<br><br>";
                    }

                    else if($linkService["idService"] == 8)
                    {
                      // var_dump($linkService);
                      echo "ID: ".$service["idService"]." | ".$typeEtablissement." ".$infoLinkService["nom"]." | Quantitée: ".$linkService["quantite"]." billets";
                      echo "<br><br>";

                    } else{
                      echo "kooo";
                      $quantity = getQuantite($bdd,$service["idService"],$_SESSION['idTrajet']);
                      echo "ID: ".$service["idService"]." | ".$service["nomService"]." : ".$typeEtablissement." ".$infoLinkService["nom"]." | Quantitée: ".$quantity." places";

                    }
                   // var_dump($service["idService"]);
                    // encapsulation de tous les trajets
                    echo "</div>";

                  }

                }
              }else{
                echo "<div class='offset-2 col-md-8'>Aucun abonnements souscrit, pas de services disponibles.</div>";
              }
              ?>
            </p>
          </div>

          <!-- Info choix des services -->
          <div class="list-group-item">
            <div class="list-group list-group-flush">
              <h3 class="display-4 text-center">Votre chauffeur</h3>
              <p>
                <?php

                //$idServices = $bdd->query('SELECT idService FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');
                $idChauffeur= $bdd->queryOne('SELECT idChauffeur FROM trajet WHERE idTrajet='.$_SESSION["idTrajet"].'');
                $unChauffeur= $bdd->queryOne('SELECT * FROM collaborateurs WHERE idCollaborateurs='.$idChauffeur["idChauffeur"].'');

                $avatar = $bdd->queryOne('SELECT avatar FROM users WHERE id = '.$idChauffeur['idChauffeur'].'');

                $car=App\Chauffeur::getCar($unChauffeur["idCollaborateurs"],$bdd);
                $chauffeur = new App\Chauffeur($unChauffeur["idCollaborateurs"],$unChauffeur["email"],$unChauffeur["last_name"],$unChauffeur["first_name"],$unChauffeur["metier"],$unChauffeur["prixCollaborateur"],
                $unChauffeur["dateEmbauche"],$unChauffeur["ville"],$unChauffeur["heuresTravailees"],$unChauffeur["rating"],$unChauffeur["ratingNumber"],$unChauffeur["description"],$car["carId"],$car["carBrand"],$car["carModel"],$car["carColor"],$car["nbPlaces"]);
                ?>
                <li class="list-group">
                  <?php //echo $i?>
                  <h4 class="h1"><?php echo $chauffeur->getFirst_name()." ".$chauffeur->getLast_name();?></h4>

                  <img src="images/avatar/<?php if(isset($avatar["avatar"])){ echo $avatar["avatar"]; } else { echo "ripdefaultavatar"; }  ?>" height="" width="100px">

                  <div class="row rating-desc col-md-4 mt-1">
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
                  <p>id du Chauffeur: <?php echo $chauffeur->getIdCollaborateur(); ?> Prix: <?php echo $chauffeur->getPrixCollaborateur()."€ / Km | Note : ". $chauffeur->getRating()." / 5 étoiles" ?></p>
                  <div class="row">
                    <div class="col-md-4">
                      <h4 class="h2">Infos: </h4>
                      <ul>
                        <li><p><?php echo "Ville d'operation: ".$chauffeur->getVille(); ?></p></li>
                        <li><p><?php echo "Heures Travailées: ".$chauffeur->getHeuresTravailees(); ?></p></li>
                        <li><p><?php echo "Date d'embauche: ".$chauffeur->getDateEmbauche(); ?></p></li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h4 class="h2">Véhicule: </h4>
                      <ul>
                        <li><p><?php echo "Marque: ".$chauffeur->getCarBrand(); ?></p></li>
                        <li><p><?php echo "Modèle: ".$chauffeur->getCarModel(); ?></p></li>
                        <li><p><?php echo "Couleur: ".$chauffeur->getCarColor(); ?></p></li>
                        <li><p><?php echo "Places: ".$chauffeur->getCarSeats(); ?></p></li>
                      </ul>
                    </div>
                    <div class="col-md-4">
                      <h4 class="h2">Description: </h4>
                      <p><?php echo $chauffeur->getDescription(); ?></p>
                    </div>
                  </div>
                </li>
              </p>
            </div>
          </div>

          <!-- Recapitulatif des prix -->
          <div class="list-group-item">
            <div class="list-group list-group-flush">
              <h3 class="display-4 text-center">Récapitulatif des prix</h3>
              <p>
                <ul>
                  <div class="border border-secondary pb-2 pr-2 pl-2 m-1">
                    <div class='h1'>Prix chauffeur/trajet:</div>
                    <p><?php echo $chauffeur->getPrixCollaborateur()." €/Km " ?>* <?php echo $trajet->getDistance()." Km " ?>= <?php echo sprintf("%.2f",$trajet->getDistance()*$chauffeur->getPrixCollaborateur())." €"; $totalChauffeurTrajet=sprintf("%.2f",$trajet->getDistance()*$chauffeur->getPrixCollaborateur()); ?></p>
                    <p class='h2'>Total Chauffeur: <?php echo $totalChauffeurTrajet; ?>€ TTC</p>
                  </div>

                  <?php
                  //prix des services
                  if (isset($isAbonnee['idAbonnement'])) { ?>
                    <div class="border border-secondary pb-2 pr-2 pl-2 m-1">
                      <div class='h1'>Prix services:</div>
                      <?php
                      if (empty($idServices)) {
                        echo "Aucun services selectionnés";
                      }else {
                        //on boucle les id des services choisis
                        $totalServices = 0;
                        $i=0;$j=0;$k=0;$h=0;$l=0;$m=0;$n=0;$o=0;
                        $aa=0;$ab=0;$ac=0;$ad=0;$ae=0;
                        $arrayLink = [];
                        foreach ($idServices as $unIdService) {
                          //on recupere les infos du service en fonction de son id
                          $service = $bdd->queryOne('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');

                          $stmtIdLink = "";
                          foreach ($arrayLink as $link) {
                            $stmtIdLink.=" AND idLink != ".$link;
                          }

                          $linkService = $bdd->queryOne('SELECT * FROM linkServicetrajet WHERE idService='.$unIdService["idService"].' AND idTrajet='.$_SESSION["idTrajet"].' '.$stmtIdLink);

                          array_push($arrayLink,$linkService['idLink']);

                          //choix en fonciton du type de service special
                          if($unIdService["idService"] == 1){
                            $infoLinkService = $bdd->queryOne('SELECT * FROM restaurants WHERE idRestaurant='.$unIdService["idAnnexe"].'');
                            $typeEtablissement="Restaurant";
                          }elseif ($unIdService["idService"] == 7) {
                            $infoLinkService = $bdd->queryOne('SELECT * FROM chambre INNER JOIN hotel WHERE chambre.idHotel = hotel.idHotel AND chambre.idChambre = '.$unIdService["idAnnexe"].'');
                            $typeEtablissement="Hotel";


                          }elseif ($unIdService["idService"] == 8) {
                            $infoLinkService = $bdd->queryOne('SELECT * FROM billettourisme WHERE idBillet='.$unIdService["idAnnexe"].'');
                            $typeEtablissement="Billet touristque";
                            //var_dump($linkService);
                            //var_dump($infoLinkService);
                          }

                          elseif ($unIdService["idService"] == 11) {
                            $infoLinkService = $bdd->query('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].'');
                            $typeEtablissement="Interprete";
                            $infoLinkService=$infoLinkService[$i];
                            $i++;
                            $numHour=calculHeure($bdd,11,$trajet);
                            //$numHour=$hourInterprete;

                          }elseif ($unIdService["idService"] == 12) {
                            $infoLinkService = $bdd->query('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].'');
                            $typeEtablissement="Coach Sportif";
                            $infoLinkService=$infoLinkService[$j];
                            $j++;
                            $numHour=calculHeure($bdd,12,$trajet);
                            // $numHour=$hourCoachSportif;

                          }elseif ($unIdService["idService"] == 13) {
                            $infoLinkService = $bdd->query('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].'');
                            $typeEtablissement="Coach Culture";
                            $infoLinkService=$infoLinkService[$k];
                            $k++;
                            $numHour=calculHeure($bdd,13,$trajet);
                            // $numHour=$hourCoachCulture;

                          }else {
                            $numHour=0;
                          }
                          ?><p><?php

                          //Affichage des infos
                          if ($linkService["idAnnexe"] < 0) {
                            if ($unIdService["idService"] == 2) {
                              if ($h == 0) {
                                $q = countElement($bdd,$service["idService"]);
                                echo $service["nomService"].":  ".$q." * ".$service["prixService"]."€  = ".$service["prixService"]*$q."€";
                                $totalServices += ($service["prixService"]*$q);
                                $h++;
                              }
                            }else if ($unIdService["idService"] == 3) {
                              if ($l == 0) {
                                $q = countElement($bdd,$service["idService"]);
                                echo $service["nomService"].":  ".$q." * ".$service["prixService"]."€  = ".$service["prixService"]*$q."€";
                                $totalServices += ($service["prixService"]*$q);
                                $l++;
                              }
                            }else if ($unIdService["idService"] == 4) {
                              if ($m == 0) {
                                $q = countElement($bdd,$service["idService"]);
                                echo $service["nomService"].":  ".$q." * ".$service["prixService"]."€  = ".$service["prixService"]*$q."€";
                                $totalServices += ($service["prixService"]*$q);
                                $m++;
                              }
                            }else if ($unIdService["idService"] == 5) {
                              if ($n == 0) {
                                $q = countElement($bdd,$service["idService"]);
                                echo $service["nomService"].":  ".$q." * ".$service["prixService"]."€  = ".$service["prixService"]*$q."€";
                                $totalServices += ($service["prixService"]*$q);
                                $n++;
                              }
                            }else if ($unIdService["idService"] == 6) {
                              if ($o == 0) {
                                $q = countElement($bdd,$service["idService"]);
                                echo $service["nomService"].":  ".$q." * ".$service["prixService"]."€  = ".$service["prixService"]*$q."€";
                                $totalServices += ($service["prixService"]*$q);
                                $o++;
                              }
                            }else if ($unIdService["idService"] == 9) {
                              if ($aa == 0) {
                                $q = countElement($bdd,$service["idService"]);
                                echo $service["nomService"].":  ".$q." * ".$service["prixService"]."€  = ".$service["prixService"]*$q."€";
                                $totalServices += ($service["prixService"]*$q);
                                $aa++;
                                echo "<br><br>";
                              }
                            }else if ($unIdService["idService"] == 15) {
                              if ($ab == 0) {
                                $q = countElement($bdd,$service["idService"]);
                                echo $service["nomService"].":  ".$q." * ".$service["prixService"]."€  = ".$service["prixService"]*$q."€";
                                $totalServices += ($service["prixService"]*$q);
                                $ab++;
                                echo "<br><br>";
                              }
                            }else if ($unIdService["idService"] == 16) {
                              if ($ac == 0) {
                                $q = countElement($bdd,$service["idService"]);
                                echo $service["nomService"].":  ".$q." * ".$service["prixService"]."€  = ".$service["prixService"]*$q."€";
                                $totalServices += ($service["prixService"]*$q);
                                $ac++;
                                echo "<br><br>";
                              }
                            }else if ($unIdService["idService"] == 18) {
                              if ($ad == 0) {
                                $q = countElement($bdd,$service["idService"]);
                                echo $service["nomService"].":  ".$q." * ".$service["prixService"]."€  = ".$service["prixService"]*$q."€";
                                $totalServices += ($service["prixService"]*$q);
                                $ad++;
                                echo "<br><br>";
                              }
                            }else if ($unIdService["idService"] == 19) {
                              if ($ae == 0) {
                                $q = countElement($bdd,$service["idService"]);
                                echo $service["nomService"].":  ".$q." * ".$service["prixService"]."€  = ".$service["prixService"]*$q."€";
                                $totalServices += ($service["prixService"]*$q);
                                $ae++;
                                echo "<br><br>";
                              }
                            }
                          }



                          else if ($linkService["idService"] == 10) {

                            echo $service["nomService"]." service | "."Votre message est  : ".$unMessage['contenuMessage']." publié le : ".$unMessage['dateMessage']." | 0€ ";


                          }
                          else if ($linkService["idService"] == 11 || $linkService["idService"] == 12 || $linkService["idService"] == 13) {
                            echo $service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]." | Prix: ".$infoLinkService["prixCollaborateur"]."€/h *".sprintf("%.2f",$numHour)."h = ".($infoLinkService["prixCollaborateur"]*sprintf("%.2f",$numHour))." €"; ?> </b> <?php
                            $totalServices += ($infoLinkService["prixCollaborateur"]*$numHour);

                          }
                          else if ($linkService["idService"] == 7 ) {
                            ?> <b> <?php echo $service["nomService"]." ".$infoLinkService["nom"]. "| Type de chambre : ".$infoLinkService["typeChambre"]."| Prix de la chambre : ".$infoLinkService["prix"]."€/personne * ".$linkService["quantite"]." + ".$service["prixService"]."€ = ".($infoLinkService["prix"]*$linkService["quantite"]+$service['prixService'])." €"; ?> </b> <?php
                            $totalServices += ($infoLinkService["prix"] * $linkService["quantite"] + $service['prixService']);
                          }
                          else if ($linkService["idService"] == 1 ) {
                            ?> <b> <?php   echo $service["nomService"]." pour le ".$infoLinkService["nom"]." | Prix du restaurant : ".$infoLinkService["prix"]."€ * ".$linkService["quantite"]." couverts + ".$service["prixService"]."€ = ".($infoLinkService["prix"]*$linkService["quantite"]+$service['prixService'])." € "; ?> </b>
                            <?php $totalServices += ($infoLinkService["prix"] * $linkService["quantite"] + $service['prixService']);
                          }
                          else if ($linkService["idService"] == 8 ) {
                            ?> <b> <?php   echo $service["nomService"]." pour le ".$infoLinkService["nom"]." | Prix du billet : ".$infoLinkService["prix"]."€ * ".$linkService["quantite"]." + ".$service["prixService"]."€ = ".($infoLinkService["prix"]*$linkService["quantite"]+$service['prixService'])." € "; ?> </b>
                            <?php $totalServices += ($infoLinkService["prix"] * $linkService["quantite"] + $service['prixService']);
                          } else {
                            ?> <b> <?php   echo $service["nomService"].": ".$typeEtablissement." ".$infoLinkService["nom"]." | ".$infoLinkService["prix"]."€ * ".$linkService["quantite"]." places + ".$service["prixService"]."€  = ".($infoLinkService["prix"]*$linkService["quantite"]+$service["prixService"])."€"; ?> </b> <?php
                            $totalServices += ($infoLinkService["prix"]*$linkService["quantite"]+$service["prixService"]);
                          }
                          ?></p><?php
                        }
                        echo "<p class='h2'>Total Services: ".sprintf("%.2f",$totalServices)."€ TTC</p>";
                      }
                      ?>
                    </div>
                  <?php }else{
                    echo "<p class='h2'>Pas de services, vous n'avez pas souscrits d'abonnements</p>";
                  } ?>
                </ul>
              </p>
              <!-- Afficher le prix total-->
              <?php
              if (empty($isAbonnee['idAbonnement'])) {
                echo "<p class='display-4'>Prix total: ".($totalChauffeurTrajet)."€ TTC</p>"; $total=$totalChauffeurTrajet;
              }else {
                if (!isset($totalServices) || empty($totalServices))
                {
                  $totalServices = 0;
                }
                echo "<p class='display-4'>Prix total: ".sprintf("%.2f",($totalServices+$totalChauffeurTrajet))."€ TTC</p>"; $total=sprintf("%.2f",$totalServices+$totalChauffeurTrajet);
              }
              ?>
            </div>
          </div>
          <?php
          $req = $bdd->getPDO()->prepare('UPDATE trajet SET prixTrajet = :prixTrajet WHERE idTrajet= :idTrajet');
          $req->bindValue(":prixTrajet",$totalChauffeurTrajet);
          $req->bindValue(":idTrajet",$_SESSION["idTrajet"]);
          $req->execute();
          $req->closeCursor();

          ?>

          <!-- Validation -->
          <form class="list-group-item center-block" method="post" action="simulationpaiement.php">
            <input type="hidden" name="price" value="<?php echo $total; ?>">
            <?php $_SESSION['prixTotal'] = $total ?>

            <div class="center-block">
              <?php echo $form->submit(); ?>
            </div>


          </form>
          <br>
          <div class="center-block">
            <button class="btn btn-dark"><a style="color:#FFFFFF" href="pdfDevis.php">Devis PDF</a></button>
</div>
        </div>
      </div>
    </div>
  </div>

  <?php include "includehtml/footer.php" ?>
</body>
</html>


<?php

function countElement($bdd,$idService)
{
  $count=0;
  $req = $bdd->getPDO()->prepare('SELECT * FROM linkservicetrajet WHERE idService = :idService AND idTrajet = :idTrajet');
  $req->execute(array(
    'idService' => $idService,
    'idTrajet' => $_SESSION['idTrajet']
  ));
  while ($c = $req->fetch())
  {
    $count++;
  }
  return $count;
}

function calculHeure($bdd,$idService,$trajet)
{
  $req = $bdd->getPDO()->prepare('SELECT heureDebut,heureFin FROM trajet WHERE idTrajet = ?');
  $req->execute(array($_SESSION['idTrajet']));
  $dateTrajet = $req->fetch();
  $dateDebutTrajet  = new DateTime($dateTrajet['heureDebut'], new DateTimeZone('Europe/Paris'));
  $dateDebutTrajet = $dateDebutTrajet->format('Y-m-d H:i:s');
  $dateDebutTrajet = explode(' ',$dateDebutTrajet);
  $dateFinTrajet  = new DateTime($dateTrajet['heureFin'], new DateTimeZone('Europe/Paris'));
  $dateFinTrajet = $dateFinTrajet->format('Y-m-d H:i:s');
  $dateFinTrajet = explode(' ',$dateFinTrajet);

  $req = $bdd->getPDO()->prepare('SELECT idAnnexe,dateStart,dateEnd FROM linkservicetrajet WHERE idTrajet = :idTrajet AND idService = :idService');
  $req->execute(array('idTrajet' => $_SESSION['idTrajet'],'idService' => $idService));
  while ($unTrajet = $req->fetch())
  {
    $unTrajet['dateStart'] = $dateDebutTrajet[0]." ".$unTrajet['dateStart'];
    $unTrajet['dateEnd'] = $dateFinTrajet[0]." ".$unTrajet['dateEnd'];

    //var_dump($unTrajet['dateStart']);
    //var_dump($unTrajet['dateEnd']);
    echo "Debut: ".$unTrajet['dateStart']." | fin: ".$unTrajet['dateEnd'];
    $heures = strtotime($unTrajet['dateEnd']) - strtotime($unTrajet['dateStart']);
    $heures /=3600;
    return $heures;
  }

}

function getQuantite($bdd,$idService,$idTrajet)
{
  $req = $bdd->getPDO()->prepare('SELECT * FROM linkservicetrajet WHERE idService = :idService AND idTrajet = :idTrajet ');
  $req->execute(array(
    'idService' => $idService,
    'idTrajet' => $idTrajet
  ));
  $count = $req->rowCount();
  return $count;
}

function deleteMtx()
{
  $mtxdemort1 = __DIR__ . "/fpdf/test/font/unifont/dejavusanscondensed-bold.mtx.php";
  $mtxdemort2 = __DIR__ . "/fpdf/test/font/unifont/dejavusanscondensed.mtx.php";
  if( file_exists ( $mtxdemort1 )){
          unlink( $mtxdemort1  ) ;
  }
  if( file_exists ( $mtxdemort2 )){
          unlink( $mtxdemort2 ) ;
  }
}

?>
