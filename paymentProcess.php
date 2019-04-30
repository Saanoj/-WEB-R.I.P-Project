<?php

session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
require_once('fpdf/test/tfpdf.php');



//Select the Products you want to show in your PDF file
// INFOS TRAJET ET SERVICES
$reqTrajet = $bdd->queryOne('SELECT * FROM `trajet` WHERE idTrajet ='.$_SESSION["idTrajet"].'');

$req3=$bdd->getPDO()->prepare('SELECT * FROM linkabonnemententreprise WHERE idClient= :idClient');
$req3->execute(array('idClient' => $_SESSION['id']));
$isAbonnee = $req3->fetch();

//infos client
$idClient = $reqTrajet['idClient'];
$reqInfosClient = $bdd->queryOne('SELECT * FROM `users` WHERE id ='.$idClient.'');

$trajet = unserialize($_SESSION['trajet']);






if(!empty($isAbonnee['idAbonnement'])){



//on boucle les id des services choisis
$idServices = $bdd->query('SELECT * FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');

// UPDATE DE LA BDD EN FONCTION DES SERVICES CHOISIS


foreach ($idServices as $unIdService) {
  //on recupere les infos du service en fonction de son id
  $service = $bdd->queryOne('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');
  $linkService = $bdd->queryOne('SELECT * FROM linkServicetrajet WHERE idService='.$unIdService["idService"].' AND idTrajet='.$_SESSION["idTrajet"].'');
  //var_dump($service);
  //var_dump($linkService);
}



// GENERATION DU PDF



//Initialize the 3 columns and the total
$column_Id = "";
$column_Services = "";
$column_Quantitee = "";
$column_Prix = "";
$total = 0;


$counterService=0;
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
  $column_Prix = $column_Prix.$prixNow."€"."\n";
  
  $column_Quantitee = $column_Quantitee.$linkService["quantite"]."\n";

  $counterService++;
}

}
$code = $_SESSION["idTrajet"];
$name = substr($reqInfosClient["last_name"],0,20);
$real_price = $_SESSION['prixTotal'];

$price_to_show = $real_price;//number_format($real_price,',','.','.');


$dateDebut = dateFrDebut($trajet->getDateDebut());
$dateFin = dateFrDebut($trajet->getHeureFin());







//Create a new PDF file
ob_start();
$pdf = new tFPDF();
$titre = 'Trajet grace a Ride in Pride';
$pdf->SetTitle($titre);
$pdf->AddPage();

// Add Unicode fonts (.ttf files)
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->AddFont('DejaVu', 'B', 'DejaVuSansCondensed-Bold.ttf', true);



$pdf->Rect(5, 5, 200, 287, 'D');

// Informations entreprise
$pdf->Cell(10);
$pdf->SetFont('DejaVu',"B","22");
$pdf->SetXY (10,15);
$pdf->MultiCell(100,5,"Ride in Pride");

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,25);
$pdf->MultiCell(100,5,"Adresse : 242 Rue du Faubourg-Saint-Antoine");
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,35);
$pdf->MultiCell(100,5,"Code postal : 75012");
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,45);
$pdf->MultiCell(100,5,"Telephone :  01 56 06 90 41");
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,55);
$pdf->MultiCell(200,5,"Site internet : https://www.esgi.fr/ecole-informatique.html");
$pdf->Ln();





//infos client (nom et prenom)

$pdf->SetFont("DejaVu",'B',"16");
$pdf->SetXY (120,65);
$pdf->MultiCell(100,5,"Informations personnelles : ");
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (120,73);
$pdf->MultiCell(100,5,"Nom et prenom : ".$reqInfosClient["last_name"]." ".$reqInfosClient["first_name"]);
$pdf->Ln();


$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (120,81);
$pdf->MultiCell(100,5,"Email : ".$reqInfosClient["email"]);
$pdf->Ln();

if (!empty($reqInfosClient))
{
  $pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (120,89);
$pdf->MultiCell(100,5,"Adresse : ".$reqInfosClient["address"]);
$pdf->Ln();
}


// Informations du trajet

$pdf->SetFont("DejaVu",'B',"16");
$pdf->SetXY (10,107);
$pdf->MultiCell(100,5,"Informations du trajet : ");
$pdf->Ln();


$pdf->SetFont("DejaVu","","10");
$pdf->SetXY (10,119);
$pdf->MultiCell(100,5,"Numero Trajet: ".$code);
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,126);
$pdf->MultiCell(100,5,"Lieu de départ : ".$trajet->getStart());
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,133);
$pdf->MultiCell(100,5,"Lieu d'arrivé : ".$trajet->getEnd());
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,140);
$pdf->MultiCell(100,5,"Distance : ".$trajet->getDistance()." km");
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,147);
$pdf->MultiCell(100,5,"Temps estimé : ".$trajet->getDuration());
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,154);
$pdf->MultiCell(100,5,"Date du départ : ".dateFrench($trajet->getDateDebut())." à ".heureDebutFr($trajet->getDateDebut()));
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,161);
$pdf->MultiCell(100,5,"Date d'arrivé : ".dateFrench($trajet->getDateDebut())." à ".$trajet->getEndofTrajet());
$pdf->Ln();


// var_dump(!empty($isAbonnee['idAbonnement']));
if(!empty($isAbonnee['idAbonnement'])){
//Prix services
//Fields Name position
$Y_Fields_Name_position = 170;
//Table position, under Fields Name
$Y_Table_Position = $Y_Fields_Name_position + 6;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('DejaVu','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(20);
$pdf->Cell(30,6,'ID Service',1,0,'L',1);
$pdf->SetX(50);
$pdf->Cell(85,6,'Service',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(30,6,'Quantitée',1,0,'L',1);
$pdf->SetX(165);
$pdf->Cell(30,6,'Prix',1,0,'R',1);
$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('DejaVu','',10);
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

}


$reqChauffeur = $bdd->queryOne("SELECT * FROM collaborateurs WHERE idCollaborateurs=".$reqTrajet["idChauffeur"]."");
//prix trajet

if(empty($isAbonnee['idAbonnement'])){
  
  $counterService=0;
  $Y_Fields_Name_position=170;
  $totalServices = 0;
}

$pdf->SetFillColor(232,232,232);


$Y_Fields_Name_position += ($counterService+1)*6;
$Y_Table_Position = $Y_Fields_Name_position +6;



$pdf->SetFont('DejaVu','',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(20);
$pdf->Cell(30,6,'ID Trajet',1,0,'L',1);
$pdf->SetX(50);
$pdf->Cell(85,6,'Chauffeur',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(30,6,'Distance',1,0,'R',1);
$pdf->SetX(165);
$pdf->Cell(30,6,'Prix',1,0,'R',1);


//Now show the 3 columns
$pdf->SetFont('DejaVu','',10);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(20);
$pdf->MultiCell(30,8,$_SESSION["idTrajet"],1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(50);
$pdf->MultiCell(85,8,$reqChauffeur["first_name"]." ".$reqChauffeur["last_name"]." Prix: ".$reqChauffeur["prixCollaborateur"]."€/Km",1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(30,8,($reqTrajet["distanceTrajet"]." Km"),1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(165);
$pdf->MultiCell(30,8,(sprintf("%.2f",$reqChauffeur["prixCollaborateur"]*$reqTrajet["distanceTrajet"]))."€",1);


if(empty($isAbonnee['idAbonnement'])){
//prix trajet
$Y_Fields_Name_position += ($counterService+1)*6;
$Y_Table_Position = $Y_Fields_Name_position + 6;

$pdf->SetFont('DejaVu','B',10);
$pdf->SetY($Y_Fields_Name_position+8);
$pdf->SetX(20);
$pdf->Cell(40,6,'',1,0,'L',1);
$pdf->SetX(50);
$pdf->Cell(85,6,'',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(30,6,'',1,0,'R',1);
$pdf->SetX(165);
$pdf->Cell(30,6,'Prix total',1,0,'R',1);

$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('DejaVu','',10);

$pdf->SetY($Y_Table_Position+8);
$pdf->SetX(165);
$pdf->MultiCell(30,8,($real_price)."€",1);
}
else 
{
  //prix trajet
$Y_Fields_Name_position += ($counterService+1)*6;
$Y_Table_Position = $Y_Fields_Name_position + 6;

$pdf->SetFont('DejaVu','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(20);
$pdf->Cell(40,6,'',1,0,'L',1);
$pdf->SetX(50);
$pdf->Cell(85,6,'',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(30,6,'',1,0,'R',1);
$pdf->SetX(165);
$pdf->Cell(30,6,'Prix total',1,0,'R',1);

$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('DejaVu','',10);

$pdf->SetY($Y_Fields_Name_position+6);
$pdf->SetX(165);
$pdf->MultiCell(30,8,($real_price)."€",1);

}


//var_dump($reqTrajet);
// echo "<p class='h2'>Total Services: ".$totalServices."€ TTC</p>";






// On créer une facture du trajet pour pouvoir récuperer les informations plus tard

$req2 = $bdd->getPDO()->prepare('INSERT INTO factures(prixTrajet,idTrajet,prixService,prixTotal,dateFacture) VALUES (:prixTrajet,:idTrajet,:prixService,:prixTotal,NOW())');
$req2->execute(array(
  'prixTrajet' => $reqTrajet["prixtrajet"],
  'idTrajet' =>$code,
  'prixService' => $totalServices,
  'prixTotal' => $real_price
));


ob_end_flush();
$destination = 'factures/facture'.$_SESSION['idTrajet'].'.pdf';
$pdf->Output($destination, 'F');
$pdf->Output('facture'.$_SESSION['idTrajet'].'.pdf', 'D');






// Config de la date en francais en PHP
function dateFrDebut($dateFr) {
  $dateFr = explode(" ", $dateFr);
  $dateFrDebut = $dateFr[0];
  $dateFrDebut =  explode("-", $dateFrDebut);
  return  $dateFrDebut[2]."/".$dateFrDebut[1]."/".$dateFrDebut[0];
  }

  function dateFrench($dateFr)
  {
    $dateFr = explode(" ", $dateFr);
    $dateFrDebut = $dateFr[0];
    $heure = explode(":",$dateFr[1]);
    $dateFrDebut =  explode("-", $dateFrDebut);
    return  $dateFrDebut[2]."/".$dateFrDebut[1]."/".$dateFrDebut[0];
  }

  function heureDebutFr($dateFr) {
    $dateFr = explode(" ", $dateFr);
    return  $dateFr[1];

  }

?>
