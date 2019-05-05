<?php
    session_start();

 ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
  <title>Reservation de chauffeur</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Ride in pride">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/bootstrap4/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/main_styles.css">
  <link rel="stylesheet" type="text/css" href="css/ReservationTrajet/responsive.css">

  <link rel="stylesheet" type="text/css" href="css/choixDriver/main.css">

  <?php include 'includehtml/head.html'; ?>

  </head>
  <body class="bg-secondary">
    <?php

    require_once __DIR__ .'/require_class.php';

    $bdd = new App\Database('rip');
    $type = 3;
    $navbar = new App\Navbar($type);
    $navbar->navbar();

    $form = new App\Form(array());

    //recup obj trajet de session
    $trajet = unserialize($_SESSION['trajet']);
    ?>
   <div class="container">
      <div class="row">
        <div class="offset-md-2 col-md-8">
          <div class="card" style="margin:50px 0">
             <!-- Default panel contents -->
             <div class="card-header">
               <h1 class="display-3 text-center">Choisissez votre chauffeur</h1>
               <?php $trajet->showInfosTrajet(); ?>
             </div>

            <form class="funkyradio list-group list-group-flush" method="post" action="valideReservationDriver.php">
              <?php
              // Affichage d'un service
              $idChauffeurs = checkDriver($bdd,$trajet);
              $i =0;
              $result=" ";
              foreach($idChauffeurs as $id){
                if ($i==0)
                {
                  $result = " AND idCollaborateurs !=".$id;
                }
                else{
                  $result = $result." AND idCollaborateurs !=".$id;
                }
                $i++;
              }
               //echo $result;

              $chauffeurs = $bdd->queryPrepareForWhile('SELECT * FROM collaborateurs WHERE metier="chauffeur" and isOnline=1'.$result.' ORDER BY rating DESC ',$bdd);
              $i=0;

              while($unChauffeur = $chauffeurs->fetch())
              {
              $car=App\Chauffeur::getCar($unChauffeur["idCollaborateurs"],$bdd);

              $chauffeur = new App\Chauffeur($unChauffeur["idCollaborateurs"],$unChauffeur["email"],$unChauffeur["last_name"],$unChauffeur["first_name"],$unChauffeur["metier"],$unChauffeur["prixCollaborateur"],
                                            $unChauffeur["dateEmbauche"],$unChauffeur["ville"],$unChauffeur["heuresTravailees"],$unChauffeur["rating"],$unChauffeur["ratingNumber"],$unChauffeur["description"],$car["carId"],$car["carBrand"],$car["carModel"],$car["carColor"],$car["nbPlaces"]);



            ?>
              <li class="list-group-item ">
                <div class="container">
                  <div class="row">
                    <div class="col-md-3">
                      <h3><?php echo $chauffeur->getFirst_name()." ".$chauffeur->getLast_name();?></h3>
                      <h6>ID: <?php echo $chauffeur->getIdCollaborateur(); ?> | Prix: <?php echo $chauffeur->getPrixCollaborateur()."€ / Km | Note: ".$chauffeur->getRating()."/5 sur ".$chauffeur->getRatingNumber()." votes" ?></h6>
                      <div class="col-md-12">
                          <div class="progress progress-striped">
                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="<?=$chauffeur->getRating();?>"
                                  aria-valuemin="0" aria-valuemax="5" style="width:<?=$chauffeur->getRating()*20?>%"><?=$chauffeur->getRating()."/5"?>

                              </div>
                          </div>
                      </div>
                    </div>
                    <!-- Button trigger modal -->
                    <div class="col-md-5">
                      <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#exampleModal<?php echo $i ?>">
                        Infos<br>chauffeur
                      </button>
                    </div>
                    <div class="funkyradio-primary col-md-4 center-block">
                        <input type="radio" name="idChauffeur" id="radio<?php echo $i ?>" value="<?php echo $chauffeur->getIdCollaborateur() ?>" checked/>
                        <label for="radio<?php echo $i ?>">Choisir<?php echo " ".$chauffeur->getFirst_name(); ?></label>
                    </div>

                  </div>

                </div>



                <!-- Modal -->
                <div class="modal animated fadeIn" id="exampleModal<?php echo $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $i ?>" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
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


              </li>
              <?php
              $i++;
              }
              ?>
              <li class="list-group-item">
                <div class="center-block">
                  <?php echo $form->submit(); ?>
                </div>
              </li>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php include "includehtml/footer.php" ?>
  </body>
</html>


<?php

function checkDriver($bdd,$trajet) {
  $idChauffeur= [];
  $req = App\Trajet::getTrajet($bdd,"Pas commencé","En cours");
  $dateDebut = new DateTime($trajet->getDateDebut(), new DateTimeZone('Europe/Paris'));
  $dateFin = new DateTime($trajet->getHeureFin(), new DateTimeZone('Europe/Paris'));

  while ($unTrajet = $req->fetch())
  {

    $dateDebutTrajetBdd = new DateTime($unTrajet['heureDebut'], new DateTimeZone('Europe/Paris'));
    $dateFinTrajetBdd = new DateTime($unTrajet['heureFin'], new DateTimeZone('Europe/Paris'));

   $interval = $dateDebut->diff($dateDebutTrajetBdd);
   $intervalFin = $dateDebut->diff($dateFinTrajetBdd);

   $interval2 = $dateFin->diff($dateDebutTrajetBdd);
   $interval2Fin = $dateFin->diff($dateFinTrajetBdd);

   if (!($interval->format('%R') ==='+' && $intervalFin->format('%R') ==='+' || $interval2->format('%R') ==='-' && $interval2Fin->format('%R') ==='-' &&  $intervalFin->format('%R') ==='-' ))
   {
    array_push($idChauffeur,$unTrajet['idChauffeur']);

   }

  }

return $idChauffeur;
}






?>
