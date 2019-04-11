
<?php

function navbarBO($where)
{
  ?>
  <ul class="nav nav-tabs">

    <?php if ($where == "users") {?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Utilisateurs</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="backOfficeBannedUsers.php">Utilisateurs bannis</a>
          <a class="dropdown-item" href="backOfficeUsers.php">Utilisateur</a>
        </div>
      </li>
    <?php }else {?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Utilisateurs</a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="../Users/backOfficeBannedUsers.php">Utilisateurs bannis</a>
          <a class="dropdown-item" href="../Users/backOfficeUsers.php">Utilisateur</a>
        </div>
      </li>
    <?php }
    if ($where == "abo") {?>
      <li class="nav-item">
        <a class="nav-link" href="backOfficeAbo.php">Abonnement</a>
      </li>
    <?php }else {?>
      <li class="nav-item">
        <a class="nav-link" href="../Abo/backOfficeAbo.php">Abonnement</a>
      </li>
    <?php } ?>

    <?php if ($where == "billet") {?>
      <li class="nav-item">
        <a class="nav-link" href="backOfficeBillet.php">Billets</a>
      </li>
    <?php }else {?>
      <li class="nav-item">
        <a class="nav-link" href="../billet/backOfficeBillet.php">Billets</a>
      </li>

    <?php }

    if ($where == "chambre") {?>

      <li class="nav-item">
        <a class="nav-link" href="backOfficeChambre.php">Chambres</a>
      </li>
    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../chambre/backOfficeChambre.php">Chambres</a>
      </li>
    <?php }

    if ($where == "collab") { ?>

      <li class="nav-item">
        <a class="nav-link" href="backOfficeCollab.php">Collaborateur</a>
      </li>
    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../Collab/backOfficeCollab.php">Collaborateur</a>
      </li>

    <?php }

    if ($where == "contact") {?>

      <li class="nav-item">
        <a class="nav-link" href="backOfficeContact.php">Contact</a>
      </li>

    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../Contact/backOfficeContact.php">Contact</a>
      </li>

    <?php }

    if ($where == "devis") {?>
      <li class="nav-item">
        <a class="nav-link" href="backOfficeDevis.php">Devis</a>
      </li>
    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../devis/backOfficeDevis.php">Devis</a>
      </li>

    <?php }

    if ($where == "entreprise") {?>
      <li class="nav-item">
        <a class="nav-link" href="backOfficeEntreprise.php">Entreprise</a>
      </li>
    <?php }else{?>
      <li class="nav-item">
        <a class="nav-link" href="../entreprise/backOfficeEntreprise.php">Entreprise</a>
      </li>
    <?php }

    if ($where == "factures") {?>

      <li class="nav-item">
        <a class="nav-link" href="backOfficeFactures.php">Factures</a>
      </li>
    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../factures/backOfficeFactures.php">Factures</a>
      </li>

    <?php }

    if ($where=="hotel") {?>

      <li class="nav-item">
        <a class="nav-link" href="backOfficeHotel.php">Hôtel</a>
      </li>

    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../hotel/backOfficeHotel.php">Hôtel</a>
      </li>

    <?php }

    if ($where == "linkAbo") {?>
      <li class="nav-item">
        <a class="nav-link" href="backOfficeLinkAbo.php">Liens Abonnement/Entreprise</a>
      </li>
    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../linkAbo/backOfficeLinkAbo.php">Liens Abonnement/Entreprise</a>
      </li>
    <?php }

    if ($where == "linkService") { ?>
      <li class="nav-item">
        <a class="nav-link" href="backOfficeLinkService.php">Liens Trajet/Services</a>
      </li>
    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../linkService/backOfficeLinkService.php">Liens Trajet/Services</a>
      </li>

    <?php }

    if ($where == "restaurant") {?>

      <li class="nav-item">
        <a class="nav-link" href="backOfficeRestaurants.php">Restaurants</a>
      </li>
    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../restaurants/backOfficeRestaurants.php">Restaurants</a>
      </li>
    <?php }

    if ($where == "services") {?>

      <li class="nav-item">
        <a class="nav-link" href="backOfficeServices.php">Services</a>
      </li>
    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../services/backOfficeServices.php">Services</a>
      </li>
    <?php }

    if ($where == "trajet") {?>
      <li class="nav-item">
        <a class="nav-link" href="backOfficeTrajet.php">Trajet</a>
      </li>
    <?php }else{ ?>
      <li class="nav-item">
        <a class="nav-link" href="../trajet/backOfficeTrajet.php">Trajet</a>
      </li>
    <?php } ?>


  </ul>

  <?php
}

?>
