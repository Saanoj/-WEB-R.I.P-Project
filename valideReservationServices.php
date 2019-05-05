<?php
session_start();
require_once __DIR__ .'/require_class.php';

$bdd = new App\Database('rip');


//On recuperer la valeur de l'heure du trajet. Il faut que la date du début de l'interprete soit supérieur a la date du trajet . Il faut aussi
// que la date de fin soit supérieur a la date du début
// Enfin, j'ai mis qu'on peux reserver un interprete au maximum pendant 8h ( a modifier si vous voulez)
$hour = $_SESSION['timeStart'];
$res=explode(' ',$hour);


$trajet = unserialize($_SESSION['trajet']);

$heureFin = $trajet->getHeureFin();
$heureFin = explode(' ',$heureFin);

updateTrajet($bdd);


if (isset($_POST['services']) && (!empty($_POST['services'])) && isset($_POST['quantite']) && (!empty($_POST['quantite'])) ) {

  $servicesChoisi=$_POST['services'];
  $quantiteCertainService=$_POST['quantite'];

  $thisQuantite=0;

  //on boucle nos services choisis
  foreach ($servicesChoisi as $service) {

    // On recupere la quantite si c'est un service qui a une quantité en fonction de son id
    foreach ($quantiteCertainService as $key => $quantite) {

      if ($key == $service) {
        $thisQuantite=$quantite;
      }
  }
  $serviceActual = $service;


    //affectation de l'id annexe du service si besoin

    switch ($service) {


      case 7:
       if (isset($_POST["idHotel"]) && !empty($_POST["idHotel"]))
      {
      $idAnnexe=$_POST["idHotel"];
      }
      else
      {
        $idAnnexe=null;
      }
      break;
      case 8:
      if (isset($_POST["idBillet"]) && !empty($_POST["idBillet"]))
      {
    //  $idAnnexe=$_POST["idBillet"];
      }
      else
      {
        $idAnnexe=null;
      }
      break;
      case 10:
      $idAnnexe=10;
      $thisQuantite=0;
      break;
      default:
      $idAnnexe=-1;
      break;
    }


    if ($service === "7")
    {
      if ($idAnnexe != null) {
      $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (idTrajet,idService,idAnnexe,quantite,statut,dateStart,dateEnd) VALUES (:idTrajet,:idService,:idAnnexe,:quantite,:statut,:dateStart,:dateEnd)');
      $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
      $req->bindValue(':idService', $service);
      $req->bindValue(':idAnnexe',$idAnnexe);
      $req->bindValue(':quantite', 1);
      $req->bindValue(':statut', 0);
      $req->bindValue(':dateStart', $res[1]);
      $req->bindValue(':dateEnd', $heureFin[1]);
      $req->execute();
      $req->closeCursor();
      }
    }

      if ($service === "8")
      {
        if ($idAnnexe != null) {
        $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (idTrajet,idService,idAnnexe,quantite,statut,dateStart,dateEnd) VALUES (:idTrajet,:idService,:idAnnexe,:quantite,:statut,:dateStart,:dateEnd)');
        $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
        $req->bindValue(':idService', $service);
        $req->bindValue(':idAnnexe',$idAnnexe);
        $req->bindValue(':quantite', $thisQuantite);
        $req->bindValue(':statut', 0);
        $req->bindValue(':dateStart', $res[1]);
        $req->bindValue(':dateEnd', $heureFin[1]);
        $req->execute();
        $req->closeCursor();
        }
      }

    if ($service === "10")
    {
      if (isset($_POST['messageContact']) && !empty($_POST['messageContact'])) {
      $req=$bdd->getPDO()->prepare('INSERT INTO serviceautre (`contenuMessage`,`dateMessage`,`emailClient`) VALUES (:contenuMessage,NOW(),:emailClient)');
      $req->bindValue(':contenuMessage',$_POST['messageContact']);
      $req->bindValue(':emailClient',$_POST['emailContact']);
      $req->execute();
      $req->closeCursor();


      $req=$bdd->getPDO()->prepare('SELECT idMessage FROM serviceautre WHERE emailClient = :emailClient AND contenuMessage =:contenuMessage ');
      $req->bindValue(':contenuMessage',$_POST['messageContact']);
      $req->bindValue(':emailClient',$_POST['emailContact']);
      $req->execute();

      $monIdMessage = $req->fetch();
      $monIdMessage['idMessage'];
      $req->closeCursor();

      $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (idTrajet,idService,idAnnexe,quantite,statut,dateStart,dateEnd) VALUES (:idTrajet,:idService,:idAnnexe,:quantite,:statut,:dateStart,:dateEnd)');
      $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
      $req->bindValue(':idService', $service);
      $req->bindValue(':idAnnexe', $monIdMessage['idMessage']);
      $req->bindValue(':quantite', 1);
      $req->bindValue(':statut', 0);
      $req->bindValue(':dateStart', null);
      $req->bindValue(':dateEnd', null);
      $req->execute();
      $req->closeCursor();
      }

    }

        if ($service === "2") {

        $array2DateDebut = array ();
        $array2DateFin = array();
        for ($i=0;$i<$thisQuantite;$i++)
        {
        $array2DateDebut = array_push_assoc($array2DateDebut,$i,$_POST['ordinateurStart'.$service.'_'.$i.'']);
        $array2DateFin = array_push_assoc($array2DateFin,$i,$_POST['ordinateurEnd'.$service.'_'.$i.'']);
        }
        // var_dump($array2DateDebut);
        // var_dump($array2DateFin);
      }
      if ($service === "3") {
        $array3DateDebut = array ();
        $array3DateFin = array();
        for ($i=0;$i<$thisQuantite;$i++)
        {
        $array3DateDebut = array_push_assoc($array3DateDebut,$i,$_POST['ordinateurStart'.$service.'_'.$i.'']);
        $array3DateFin = array_push_assoc($array3DateFin,$i,$_POST['ordinateurEnd'.$service.'_'.$i.'']);

        }
      }


        if ($service === "4") {
        $array4DateDebut = array ();
        $array4DateFin = array();
        for ($i=0;$i<$thisQuantite;$i++)
        {
        $array4DateDebut = array_push_assoc($array4DateDebut,$i,$_POST['ordinateurStart'.$service.'_'.$i.'']);
        $array4DateFin = array_push_assoc($array4DateFin,$i,$_POST['ordinateurEnd'.$service.'_'.$i.'']);
        }
        // var_dump($array3DateDebut);
        // var_dump($array3DateFin);
      }
      if ($service === "5") {
        $array5DateDebut = array ();
        $array5DateFin = array();
        for ($i=0;$i<$thisQuantite;$i++)
        {
        $array5DateDebut = array_push_assoc($array5DateDebut,$i,$_POST['tabletteStart'.$service.'_'.$i.'']);
        $array5DateFin = array_push_assoc($array5DateFin,$i,$_POST['tabletteEnd'.$service.'_'.$i.'']);
        }
        // var_dump($array3DateDebut);
        // var_dump($array3DateFin);
      }

      if ($service === "6") {
        $array6DateDebut = array ();
        $array6DateFin = array();
        for ($i=0;$i<$thisQuantite;$i++)
        {
        $array6DateDebut = array_push_assoc($array6DateDebut,$i,$_POST['audioGuidesStart'.$service.'_'.$i.'']);
        $array6DateFin = array_push_assoc($array6DateFin,$i,$_POST['audioGuidesEnd'.$service.'_'.$i.'']);
        }
        // var_dump($array3DateDebut);
        // var_dump($array3DateFin);
      }

      if ($service === "1") {

        $array1DateDebut = array ();
        $array1Quantite = array();
        $array1 = array ();

        for ($i=0;$i<300;$i++)
        {
            if (isset($_POST['idRestaurant'.$i])) {
              $thisQuantite = $_POST['quantite_'.$i];
              $array1DateDebut = array_push_assoc($array1DateDebut,$i,$_POST['startRestaurant'.$i]);
              $array1Quantite = array_push_assoc($array1Quantite,$i,$thisQuantite);
              $array1[$i] = array($i,$thisQuantite,$_POST['startRestaurant'.$i]);

            }
      }

      }

      if ($service === "7") {

        $array7DateDebut = array ();
        $array7DateFin = array();
        for ($i=0;$i<30;$i++)
        {
          for ($j=0;$j<30;$j++)
          {
            if (isset($_POST['idHotel'.$i.'_'.$j.''])) {
              $array7DateDebut = array_push_assoc($array7DateDebut,$j,$_POST['startHotel'.$i.'_'.$j.'']);
              $thisQuantite++;
            }


        }

      }


      }
      if ($service === "8") {

        $array8DateDebut = array ();
        $array8Quantite = array();
        $array8 = array ();

        for ($i=0;$i<30;$i++)
        {
            if (isset($_POST['idBillet'.$i])) {
              $thisQuantite = $_POST['quantite_'.$i];
              $array8DateDebut = array_push_assoc($array8DateDebut,$i,$_POST['startBillet'.$i]);
              $array8Quantite = array_push_assoc($array8Quantite,$i,$thisQuantite);
              $array8[$i] = array($i,$thisQuantite,$_POST['startBillet'.$i]);

            }
      }

      }


      if ($service === "9") {
        $array9DateDebut = array ();
        $array9DateFin = array();
        for ($i=0;$i<$thisQuantite;$i++)
        {
        $array9DateDebut = array_push_assoc($array9DateDebut,$i,$_POST['reservationRestaurantStart'.$service.'_'.$i.'']);
        $array9DateFin = array_push_assoc($array9DateFin,$i,$_POST['reservationRestaurantEnd'.$service.'_'.$i.'']);
        }
        // var_dump($array3DateDebut);
        // var_dump($array3DateFin);
      }

      if ($service === "15") {
        $array15DateDebut = array ();
        $array15DateFin = array();
        for ($i=0;$i<$thisQuantite;$i++)
        {
        $array15DateDebut = array_push_assoc($array15DateDebut,$i,$_POST['transportAnimalStart'.$service.'_'.$i.'']);
        $array15DateFin = array_push_assoc($array15DateFin,$i,$_POST['transportAnimalEnd'.$service.'_'.$i.'']);
        }
        // var_dump($array3DateDebut);
        // var_dump($array3DateFin);
      }

      if ($service === "16") {
        $array16DateDebut = array ();
        $array16DateFin = array();
        for ($i=0;$i<$thisQuantite;$i++)
        {
        $array16DateDebut = array_push_assoc($array16DateDebut,$i,$_POST['transportVeteniraireStart'.$service.'_'.$i.'']);
        $array16DateFin = array_push_assoc($array16DateFin,$i,$_POST['transportVeteniraireEnd'.$service.'_'.$i.'']);
        }
        //  var_dump($array16DateDebut);
        //  var_dump($array16DateFin);
      }

      if ($service === "18") {
        $array18DateDebut = array();
        $array18DateFin = array();
        for ($i=0;$i<$thisQuantite;$i++)
        {

        $array18DateDebut = array_push_assoc($array18DateDebut,$i,$_POST['menuJourStart'.$service.'_'.$i.'']);
        $array18DateFin = array_push_assoc($array18DateFin,$i,$_POST['menuJourEnd'.$service.'_'.$i.'']);
        }
        // var_dump($array3DateDebut);
        // var_dump($array3DateFin);
      }

      if ($service === "19") {
        $array19DateDebut = array ();
        $array19DateFin = array();
        for ($i=0;$i<$thisQuantite;$i++)
        {
        $array19DateDebut = array_push_assoc($array19DateDebut,$i,$_POST['menuGastronomiqueStart'.$service.'_'.$i.'']);
        $array19DateFin = array_push_assoc($array19DateFin,$i,$_POST['menuGastronomiqueEnd'.$service.'_'.$i.'']);
        }
      }


      if ($service === "11") {
        $req = getId("interprete",$bdd);

        $arrayInterprete  = array();
        $arrayInterpreteDateDebut = array();
        $arrayInterpreteDateFin = array();
          while ($id = $req->fetch()) {
            if (isset($_POST['idInterprete'.$id['idCollaborateurs'].'']) && !empty($_POST['idInterprete'.$id['idCollaborateurs'].'']))
            {
              if (!in_array($id['idCollaborateurs'],$arrayInterprete))
              {
                array_push($arrayInterprete,$id['idCollaborateurs']);
              }
            }
          }

          foreach ($arrayInterprete as $idInterprete) {
            $arrayInterpreteDateDebut = array_push_assoc($arrayInterpreteDateDebut,$idInterprete,$_POST['startInterprete'.$idInterprete.'']);
        }
        foreach ($arrayInterprete as $idInterprete) {
          $arrayInterpreteDateFin = array_push_assoc($arrayInterpreteDateFin,$idInterprete,$_POST['endInterprete'.$idInterprete.'']);
      }
          //  var_dump($arrayInterprete);
          //  var_dump($arrayInterpreteDateDebut);
          //  var_dump($arrayInterpreteDateFin);
    }

    if ($service === "12") {
        $req = getId("coachSportif",$bdd);
        $arrayCoachSportif  = array();
        $arrayCoachSportifDateDebut = array();
        $arrayCoachSportifDateFin = array();
        while ($id = $req->fetch()) {
            if (isset($_POST['idCoachSportif'.$id['idCollaborateurs'].'']) && !empty($_POST['idCoachSportif'.$id['idCollaborateurs'].'']))
            {
              if (!in_array($id['idCollaborateurs'],$arrayCoachSportif))
              {
                array_push($arrayCoachSportif,$id['idCollaborateurs']);
              }
            }
          }

          foreach ($arrayCoachSportif as $idCoachSportif) {
            $arrayCoachSportifDateDebut = array_push_assoc($arrayCoachSportifDateDebut,$idCoachSportif,$_POST['startCoachSportif'.$idCoachSportif.'']);
        }
        foreach ($arrayCoachSportif as $idCoachSportif) {
          $arrayCoachSportifDateFin = array_push_assoc($arrayCoachSportifDateFin,$idCoachSportif,$_POST['endCoachSportif'.$idCoachSportif.'']);
      }
          //  var_dump($arrayCoachSportif);
          // var_dump($arrayCoachSportifDateDebut);
          //  var_dump($arrayCoachSportifDateFin);

    }
    if ($service === "13") {
        $req = getId("coachCulture",$bdd);
          $arrayCoachCulture  = array();
          $arrayCoachCultureDateDebut = array();
          $arrayCoachCulturefDateFin = array();
          while ($id = $req->fetch()) {
              if (isset($_POST['idCoachCulture'.$id['idCollaborateurs'].'']) && !empty($_POST['idCoachCulture'.$id['idCollaborateurs'].'']))
              {
                if (!in_array($id['idCollaborateurs'],$arrayCoachCulture))
                {
                  array_push($arrayCoachCulture,$id['idCollaborateurs']);
                }
              }
            }
            foreach ($arrayCoachCulture as $idCoachCulture) {
              $arrayCoachCultureDateDebut = array_push_assoc($arrayCoachCultureDateDebut,$idCoachCulture,$_POST['startCoachCulture'.$idCoachCulture.'']);
          }
          foreach ($arrayCoachCulture as $idCoachCulture) {
            $arrayCoachCulturefDateFin = array_push_assoc($arrayCoachCulturefDateFin,$idCoachCulture,$_POST['endCoachCulture'.$idCoachCulture.'']);
        }
        // var_dump($arrayCoachCulture);
        //     var_dump($arrayCoachCultureDateDebut);
        //      var_dump($arrayCoachCulturefDateFin);
      }
      if (

       $service === "2" ||
       $service === "3" ||
       $service === "4" ||
       $service === "5" ||
       $service === "6" ||
       $service === "9" ||
      $service === "15" ||
      $service === "16" ||
      $service === "18" ||
      $service === "19")
      {

        for($i=0;$i<$thisQuantite;$i++)
        {

        $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (idTrajet,idService,idAnnexe,quantite,statut,dateStart,dateEnd) VALUES (:idTrajet,:idService,:idAnnexe,:quantite,:statut,:dateStart,:dateEnd)');
        $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
        $req->bindValue(':idService', $service);
        $req->bindValue(':idAnnexe',-1);
        $req->bindValue(':quantite', 1);
        $req->bindValue(':statut', 0);
        $req->bindValue(':dateStart', null);
        $req->bindValue(':dateEnd', null);
        $req->execute();
        $req->closeCursor();

        $req = getLastId($bdd);
        $idLink = $req->fetch();



          if ($service === "2")
          {
        if ($array2DateDebut[$i] !== '' && $array2DateFin[$i] !== '') {
        $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart,dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idLink = :idLink');
        $req->execute(array(
          'dateStart' => $array2DateDebut[$i],
          'dateEnd' => $array2DateFin[$i],
          'idTrajet' => $_SESSION["idTrajet"],
          'idLink' => $idLink['idLink']
        ));
        $req->closeCursor();
      }
      else
      {
        $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd,dateStart = :dateStart WHERE idTrajet = :idTrajet AND idLink = :idLink');
        $req->execute(array(
          'dateEnd' => $heureFin[1],
          'dateStart' => $res[1],
          'idTrajet' => $_SESSION["idTrajet"],
          'idLink' => $idLink['idLink']
        ));
        $req->closeCursor();
      }
      }
       if ($service === "3")
      {
        if ($array3DateDebut[$i] !== '' && $array3DateFin[$i] !== '') {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart,dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateStart' => $array3DateDebut[$i],
            'dateEnd' => $array3DateFin[$i],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
        else
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd,dateStart = :dateStart WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateEnd' => $heureFin[1],
            'dateStart' => $res[1],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
      }
       if ($service === "4")
      {
        if ($array4DateDebut[$i] !== '' && $array4DateFin[$i] !== '') {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart,dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateStart' => $array4DateDebut[$i],
            'dateEnd' => $array4DateFin[$i],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
        else
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd,dateStart = :dateStart WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateEnd' => $heureFin[1],
            'dateStart' => $res[1],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
      }
       if ($service === "5")
      {
        if ($array5DateDebut[$i] !== '' && $array5DateFin[$i] !== '') {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart,dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateStart' => $array5DateDebut[$i],
            'dateEnd' => $array5DateFin[$i],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
        else
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd,dateStart = :dateStart WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateEnd' => $heureFin[1],
            'dateStart' => $res[1],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
      }
       if ($service === "6")
      {
        if ($array6DateDebut[$i] !== '' && $array6DateFin[$i] !== '') {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart,dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateStart' => $array6DateDebut[$i],
            'dateEnd' => $array6DateFin[$i],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
        else
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd,dateStart = :dateStart WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateEnd' => $heureFin[1],
            'dateStart' => $res[1],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
      }




       if ($service === "9")
      {
        if ($array9DateDebut[$i] !== '' && $array9DateFin[$i] !== '') {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart,dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateStart' => $array9DateDebut[$i],
            'dateEnd' => $array9DateFin[$i],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
        else
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd,dateStart = :dateStart WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateEnd' => $heureFin[1],
            'dateStart' => $res[1],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
      }
       if ($service === "15")
      {
        if ($array15DateDebut[$i] !== '' && $array15DateFin[$i] !== '') {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart,dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateStart' => $array15DateDebut[$i],
            'dateEnd' => $array15DateFin[$i],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
        else
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd,dateStart = :dateStart WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateEnd' => $heureFin[1],
            'dateStart' => $res[1],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
      }
       if ($service === "16")
      {
        if ($array16DateDebut[$i] !== '' && $array16DateFin[$i] !== '') {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart,dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateStart' => $array16DateDebut[$i],
            'dateEnd' => $array16DateFin[$i],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
        else
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd,dateStart = :dateStart WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateEnd' => $heureFin[1],
            'dateStart' => $res[1],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
      }
       if ($service === "18")
      {

        if ($array18DateDebut[$i] !== '' && $array18DateFin[$i] !== '') {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart,dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateStart' => $array18DateDebut[$i],
            'dateEnd' => $array18DateFin[$i],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
        else
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd,dateStart = :dateStart WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateEnd' => $heureFin[1],
            'dateStart' => $res[1],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
      }
       if ($service === "19")
      {

        if ($array19DateDebut[$i] !== '' && $array19DateFin[$i] !== '') {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart,dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateStart' => $array19DateDebut[$i],
            'dateEnd' => $array19DateFin[$i],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
        else
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd,dateStart = :dateStart WHERE idTrajet = :idTrajet AND idLink = :idLink');
          $req->execute(array(
            'dateEnd' => $heureFin[1],
            'dateStart' => $res[1],
            'idTrajet' => $_SESSION["idTrajet"],
            'idLink' => $idLink['idLink']
          ));
          $req->closeCursor();
        }
      }
    }
  }


       if ($service === "11") {
      foreach ($arrayInterprete as $value) {

        $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (idTrajet,idService,idAnnexe,quantite,statut,dateStart,dateEnd) VALUES (:idTrajet,:idService,:idAnnexe,:quantite,:statut,:dateStart,:dateEnd)');
        $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
        $req->bindValue(':idService', $service);
        $req->bindValue(':idAnnexe', $value);
        $req->bindValue(':quantite', 1);
        $req->bindValue(':statut', 0);
        $req->bindValue(':dateStart',$res[1]);
        $req->bindValue(':dateEnd', $heureFin[1]);
        $req->execute();
        $req->closeCursor();

        foreach($arrayInterpreteDateDebut as $value =>$dateStart)
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart WHERE idTrajet = :idTrajet AND idAnnexe = :idAnnexe');
          $req->execute(array(
            'dateStart' => $dateStart,
            'idTrajet' => $_SESSION["idTrajet"],
            'idAnnexe' => $value
          ));
          $req->closeCursor();

        }
        foreach($arrayInterpreteDateFin as $value =>$dateEnd)
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idAnnexe = :idAnnexe');
          $req->execute(array(
            'dateEnd' => $dateEnd,
            'idTrajet' => $_SESSION["idTrajet"],
            'idAnnexe' => $value
          ));
          $req->closeCursor();

        }
    }
  }
     if ($service === "12")
    {
      foreach ($arrayCoachSportif as $value) {

        $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (idTrajet,idService,idAnnexe,quantite,statut,dateStart,dateEnd) VALUES (:idTrajet,:idService,:idAnnexe,:quantite,:statut,:dateStart,:dateEnd)');
        $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
        $req->bindValue(':idService', $service);
        $req->bindValue(':idAnnexe', $value);
        $req->bindValue(':quantite', 1);
        $req->bindValue(':statut', 0);
        $req->bindValue(':dateStart', $res[1]);
        $req->bindValue(':dateEnd', $heureFin[1]);
        $req->execute();
        $req->closeCursor();

        foreach($arrayCoachSportifDateDebut as $value =>$dateStart)
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart WHERE idTrajet = :idTrajet AND idAnnexe = :idAnnexe');
          $req->execute(array(
            'dateStart' => $dateStart,
            'idTrajet' => $_SESSION["idTrajet"],
            'idAnnexe' => $value
          ));
          $req->closeCursor();

        }
        foreach($arrayCoachSportifDateFin as $value =>$dateEnd)
        {
          $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idAnnexe = :idAnnexe');
          $req->execute(array(
            'dateEnd' => $dateEnd,
            'idTrajet' => $_SESSION["idTrajet"],
            'idAnnexe' => $value
          ));
          $req->closeCursor();

        }
    }
    }
     if($service === "13")
    {
      foreach ($arrayCoachCulture as $value) {

        $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (idTrajet,idService,idAnnexe,quantite,statut,dateStart,dateEnd) VALUES (:idTrajet,:idService,:idAnnexe,:quantite,:statut,:dateStart,:dateEnd)');
        $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
        $req->bindValue(':idService', $service);
        $req->bindValue(':idAnnexe', $value);
        $req->bindValue(':quantite', 1);
        $req->bindValue(':statut', 0);
        $req->bindValue(':dateStart', $res[1]);
        $req->bindValue(':dateEnd', $heureFin[1]);
        $req->execute();
        $req->closeCursor();



      foreach($arrayCoachCultureDateDebut as $value =>$dateStart)
      {
        $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateStart = :dateStart WHERE idTrajet = :idTrajet AND idAnnexe = :idAnnexe');
        $req->execute(array(
          'dateStart' => $dateStart,
          'idTrajet' => $_SESSION["idTrajet"],
          'idAnnexe' => $value
        ));
        $req->closeCursor();

      }
      foreach($arrayCoachCulturefDateFin as $value =>$dateEnd)
      {
        $req=$bdd->getPDO()->prepare('UPDATE linkservicetrajet SET dateEnd = :dateEnd WHERE idTrajet = :idTrajet AND idAnnexe = :idAnnexe');
        $req->execute(array(
          'dateEnd' => $dateEnd,
          'idTrajet' => $_SESSION["idTrajet"],
          'idAnnexe' => $value
        ));
        $req->closeCursor();

      }
    }
    }


    if ($service === "7")
    {

      foreach($array7DateDebut as $cle =>$valeur){

        $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (idTrajet,idService,idAnnexe,quantite,statut,dateStart,dateEnd) VALUES (:idTrajet,:idService,:idAnnexe,:quantite,:statut,:dateStart,:dateEnd)');
        $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
        $req->bindValue(':idService', $service);
        $req->bindValue(':idAnnexe',$cle);
        $req->bindValue(':quantite', 1);
        $req->bindValue(':statut', 0);
        $req->bindValue(':dateStart', $valeur);
        $req->bindValue(':dateEnd', $heureFin[1]);
        $req->execute();
        $req->closeCursor();
    }

    }
    if ($service === "8")
    {
      foreach($array8 as $cle =>$valeur){
        $idAnnexe = $valeur[0];
        $quantite = $valeur[1];
        $dateDebut = $valeur[2];
          $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (idTrajet,idService,idAnnexe,quantite,statut,dateStart,dateEnd) VALUES (:idTrajet,:idService,:idAnnexe,:quantite,:statut,:dateStart,:dateEnd)');
          $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
          $req->bindValue(':idService', $service);
          $req->bindValue(':idAnnexe',$idAnnexe);
          $req->bindValue(':quantite', $quantite);
          $req->bindValue(':statut', 0);
          $req->bindValue(':dateStart', $dateDebut);
          $req->bindValue(':dateEnd', $heureFin[1]);
          $req->execute();
          $req->closeCursor();

      }
    }

    if ($service === "1")
    {
      foreach($array1 as $cle =>$valeur){
        $idAnnexe = $valeur[0];
        $quantite = $valeur[1];
        $dateDebut = $valeur[2];
          $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (idTrajet,idService,idAnnexe,quantite,statut,dateStart,dateEnd) VALUES (:idTrajet,:idService,:idAnnexe,:quantite,:statut,:dateStart,:dateEnd)');
          $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
          $req->bindValue(':idService', $service);
          $req->bindValue(':idAnnexe',$idAnnexe);
          $req->bindValue(':quantite', $quantite);
          $req->bindValue(':statut', 0);
          $req->bindValue(':dateStart', $dateDebut);
          $req->bindValue(':dateEnd', $heureFin[1]);
          $req->execute();
          $req->closeCursor();

      }
    }

/*
    else
    {
      $req=$bdd->getPDO()->prepare('INSERT INTO linkServicetrajet (`idTrajet`,`idService`,`idAnnexe`,`quantite`) VALUES (:idTrajet,:idService,:idAnnexe,:quantite)');
      $req->bindValue(':idTrajet', $_SESSION["idTrajet"]);
      $req->bindValue(':idService', $service);
      $req->bindValue(':idAnnexe', $idAnnexe);
      $req->bindValue(':quantite', $thisQuantite);
      $req->execute();
      $req->closeCursor();
    }
    */
    //var_dump($serviceActual);

  }


  //redirection
header("location:resevationChooseDriver.php");
}
else {

header("location:resevationChooseDriver.php");
}

function array_push_assoc($array, $key, $value){
  $array[$key] = $value;
  return $array;
  }

  function getId($metier,$bdd)
  {
    $req = $bdd->getPDO()->prepare('SELECT idCollaborateurs FROM collaborateurs WHERE metier= :metier');
    $req->execute(array(
      'metier' => $metier
    ));
    return $req;
  }

  function getLastId($bdd)
  {
    $req = $bdd->getPDO()->prepare('SELECT idLink from linkservicetrajet ORDER BY idLink DESC');
    $req->execute();
    return $req;
  }
  function updateTrajet($bdd)
  {
    $req = $bdd->getPDO()->prepare('UPDATE trajet SET dateResevation = NOW() WHERE idTrajet = :idTrajet');
    $req->execute(array('idTrajet' => $_SESSION['idTrajet']));
    $req->closeCursor();
  }

?>
