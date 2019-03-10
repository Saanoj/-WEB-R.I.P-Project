<?php
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
require_once('fpdf/fpdf.php');


//Select the Products you want to show in your PDF file
// INFOS TRAJET ET SERVICES
$reqTrajet = $bdd->queryOne('SELECT * FROM `trajet` WHERE idTrajet ='.$_SESSION["idTrajet"].'');

  var_dump($reqTrajet);
  $idClient = $reqTrajet['idClient'];
  var_dump($idClient);

$trajet = unserialize($_SESSION['trajet']);

//temps des collabs
//si temps de trajet < 1H alors on passe le temps d'interprete a un 1 et si au dessus on la tronque à l'heure en dessous
$hourInterprete = (strtotime($_SESSION['endInterprete']) - strtotime($_SESSION['startInterprete']));
$hourInterprete = $hourInterprete/3600>1?floor($hourInterprete/3600):ceil($hourInterprete/3600);

// ON VERIFIE LA DIFFERENCE D'HEURE ENTRE LE DEBUT ET LA FIN DU CRENEAU DU COACH SPORTIF
$hourCoachSportif = (strtotime($_SESSION['endCoachSportif']) - strtotime($_SESSION['startCoachSportif']));
$hourCoachSportif = $hourCoachSportif/3600>1?floor($hourCoachSportif/3600):ceil($hourCoachSportif/3600);

//  ON VERIFIE LA DIFFERENCE D'HEURE ENTRE LE DEBUT ET LA FIN DU CRENEAU DU COACH CULTURE
$hourCoachCulture = (strtotime($_SESSION['endCoachCulture']) - strtotime($_SESSION['startCoachCulture']));
$hourCoachCulture =  $hourCoachCulture/3600>1?floor($hourCoachCulture/3600):ceil($hourCoachCulture/3600);

//infos client
$reqInfosClient = $bdd->queryOne('SELECT * FROM `users` WHERE id ='.$idClient.'');



//Initialize the 3 columns and the total
$column_Id = "";
$column_Services = "";
$column_Quantitee = "";
$column_Prix = "";
$total = 0;

//on boucle les id des services choisis
$idServices = $bdd->query('SELECT * FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');
$totalServices = 0;
$i=0;$j=0;$k=0;
foreach ($idServices as $unIdService) {
  //on recupere les infos du service en fonction de son id
  $service = $bdd->queryOne('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');
  $linkService = $bdd->queryOne('SELECT * FROM linkServicetrajet WHERE idService='.$unIdService["idService"].' AND idTrajet='.$_SESSION["idTrajet"].'');

  //choix en fonciton du type de service special
  if($unIdService["idService"] == 1){
    $infoLinkService = $bdd->queryOne('SELECT * FROM restaurants WHERE idRestaurant='.$linkService["idAnnexe"].'');
    $typeEtablissement="Restaurant";
  }elseif ($unIdService["idService"] == 7) {
    $infoLinkService = $bdd->queryOne('SELECT * FROM hotel WHERE idHotel='.$linkService["idAnnexe"].'');
    $typeEtablissement="Hotel";

  }elseif ($unIdService["idService"] == 8) {
    $infoLinkService = $bdd->queryOne('SELECT * FROM billettourisme WHERE idBillet='.$linkService["idAnnexe"].'');
    $typeEtablissement="Billet touristque";
  }elseif ($unIdService["idService"] == 11) {
    $infoLinkService = $bdd->query('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].'');
    $typeEtablissement="Interprete";
    $infoLinkService=$infoLinkService[$i];
    $i++;
    $numHour=$hourInterprete;

  }elseif ($unIdService["idService"] == 12) {
    $infoLinkService = $bdd->query('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].'');
    $typeEtablissement="Coach Sportif";
    $infoLinkService=$infoLinkService[$j];
    $j++;
    $numHour=$hourCoachSportif;

  }elseif ($unIdService["idService"] == 13) {
    $infoLinkService = $bdd->query('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].'');
    $typeEtablissement="Coach Culture";
    $infoLinkService=$infoLinkService[$k];
    $k++;
    $numHour=$hourCoachCulture;

  }else {
    $numHour=0;
  }




  //Affichage des infos
  if ($linkService["idAnnexe"] < 0) {
    //echo $service["nomService"].":  ".$linkService["quantite"]." * ".$service["prixService"]."€  = ".($service["prixService"]*$linkService["quantite"])."€";
    $totalServices += ($service["prixService"]*$linkService["quantite"]);
    $prixNow = $service["prixService"]*$linkService["quantite"];
    $column_Services = $column_Services.$service["nomService"]."\n";

  }else if ($linkService["idService"] == 11 || $linkService["idService"] == 12 || $linkService["idService"] == 13) {
    //echo $service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]." | Prix: ".$infoLinkService["prixCollaborateur"]."€/h *".$numHour ."h = ".($infoLinkService["prixCollaborateur"]*$numHour)." €";
    $totalServices += ($infoLinkService["prixCollaborateur"]*$numHour);
    $prixNow = $infoLinkService["prixCollaborateur"]*$numHour;
    $column_Services = $column_Services.$service["nomService"].": ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"]."\n";

  }
  else if ($linkService["idService"] == 7 ) {
    //echo $service["nomService"]." | Prix de la chambre : ".$infoLinkService["prix"]."€/nuit +".$service["prixService"]." € ( prix du service)";
    $totalServices += ($infoLinkService["prix"]+$service['prixService']);
    $prixNow = $infoLinkService["prix"]+$service['prixService'];
    $column_Services = $column_Services.$service["nomService"]."\n";

  }
  else if ($linkService["idService"] == 2 || $linkService["idService"] == 3 || $linkService["idService"] == 4|| $linkService["idService"] == 5 || $linkService["idService"] == 6 ||$linkService["idService"] == 9 || $linkService["idService"] == 18 || $linkService["idService"] == 19) {
    //echo $service["nomService"]." | Prix: ".$infoLinkService["prixCollaborateur"]."€/h *";
    $totalServices += ($infoLinkService["prix"]*$linkService["quantite"]+$service["prixService"]);
    $prixNow = $infoLinkService["prix"]*$linkService["quantite"]+$service["prixService"];
    $column_Services = $column_Services.$service["nomService"]."\n";

  }else{
    //echo $service["nomService"].": ".$typeEtablissement." ".$infoLinkService["nom"]." | ".$infoLinkService["prix"]."€ * ".$linkService["quantite"]." places + ".$service["prixService"]."€  = ".($infoLinkService["prix"]*$linkService["quantite"]+$service["prixService"])."€";
    $totalServices += ($infoLinkService["prix"]*$linkService["quantite"]+$service["prixService"]);
    $prixNow = $infoLinkService["prix"]*$linkService["quantite"]+$service["prixService"];
      $column_Services = $column_Services.$service["nomService"]."\n";
  }

  //ajout des données à ca colonne
  $column_Id = $column_Id.$service["idService"]."\n";

  //chr(128) egal €
  $column_Prix = $column_Prix.$prixNow.chr(128)."\n";
  $column_Quantitee = $column_Quantitee.$linkService["quantite"]."\n";
}

$code = $_SESSION["idTrajet"];
$name = substr($reqInfosClient["last_name"],0,20);
$real_price = $_SESSION['prixTotal'];

$price_to_show = $real_price;//number_format($real_price,',','.','.');



//Create a new PDF file
ob_start();
$pdf=new FPDF();
$titre = 'Trajet grace a Ride in Pride';
$pdf->SetTitle($titre);
$pdf->AddPage();

$pdf->Rect(5, 5, 200, 287, 'D');


$pdf->Cell(10);
$pdf->SetFont("Arial","B","22");
$pdf->SetXY (10,15);
$pdf->MultiCell(50,5,"Facture");
$pdf->SetFont("Arial","","16");
$pdf->SetXY (10,25);
$pdf->MultiCell(100,5,"Numero Trajet: ".$code);
$pdf->Ln();

//infos client
$pdf->SetFont("Arial",'',"12");
$pdf->SetXY (10,30);
$pdf->MultiCell(50,5,$reqInfosClient["last_name"]." ".$reqInfosClient["first_name"]);
$pdf->Ln();
//Fields Name position
$Y_Fields_Name_position = 44;
//Table position, under Fields Name
$Y_Table_Position = $Y_Fields_Name_position + 6;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(20);
$pdf->Cell(30,6,'ID Service',1,0,'L',1);
$pdf->SetX(50);
$pdf->Cell(85,6,'Service',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(30,6,'Quantitee',1,0,'L',1);
$pdf->SetX(165);
$pdf->Cell(30,6,'Prix',1,0,'R',1);
$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(20);
$pdf->MultiCell(30,6,$column_Id,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(50);
$pdf->MultiCell(85,6,$column_Services,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(30,6,$column_Quantitee,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(165);
$pdf->MultiCell(30,6,$column_Prix,1);

echo "<p class='h2'>Total Services: ".$totalServices."€ TTC</p>";

$pdf->Output('F',"facture.pdf");
ob_end_flush();



/*
$pdf = new FPDF();
    //global $DB;
    //$orderID=123;
    //$sql = "SELECT * FROM `" . $DB->pre . "garorder` WHERE garID= '" . $orderID . "'";
    //$d = $DB->dbRow($sql);

    //echo 'name:'.$d['orderdate'].' Party Code :'.$d['partyCode'];

    $pdf->AddPage();



          $pdf->SetFont('helvetica','B',10);
          $pdf->Cell(190,7,'Order Details',1,2,'C');
          $pdf->SetFont('helvetica','',10);
          $y= $pdf->GetY();
          $pdf->MultiCell(95,8, "Garment ID: "."\nParty Code: "."\nOrder Date: " , 'LRB',1 );
          //$x= $pdf->GetX();
          //$pdf->setXY($x+95,$y);
          $pdf->Cell(90);
          $pdf->SetFont('helvetica','',10);
         $pdf->SetXY (105,62);
          $pdf->MultiCell(95,12, "Name: "."\nDelivery Status: " , 'LRB',1 );
      $pdf-> Ln();
         $pdf->Cell(32,10,'Material Description',1,0,'L',0);
         $period = 50;
         for($x=36;$x <=$period; $x=$x+2){

           $pdf->Cell(20,10,$x,1,0,'L',0);



         }


    //$pdf->Output('F',"facture.pdf");
*/
header("location: facture.pdf");
?>
