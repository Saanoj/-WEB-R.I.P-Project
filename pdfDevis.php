<?php

session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
require_once('fpdf/test/tfpdf.php');



//Select the Products you want to show in your PDF file
// INFOS TRAJET ET SERVICES
$reqTrajet = $bdd->queryOne('SELECT * FROM trajet WHERE idTrajet ='.$_SESSION["idTrajet"].'');
$req3=$bdd->getPDO()->prepare('SELECT * FROM linkabonnemententreprise WHERE idClient= :idClient');
$req3->execute(array('idClient' => $_SESSION['id']));
$isAbonnee = $req3->fetch();

//infos client
$idClient = $reqTrajet['idClient'];
$reqInfosClient = $bdd->getPDO()->prepare('SELECT * FROM users WHERE id =:id');
$reqInfosClient->execute(array(
   'id' => $idClient
));
$reqInfosClient = $reqInfosClient->fetch();
$trajet = unserialize($_SESSION['trajet']);


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
$code = $_SESSION["idTrajet"];
$name = substr($reqInfosClient["last_name"],0,20);
$real_price = $_SESSION['prixTotal'];
$price_to_show = $real_price;//number_format($real_price,',','.','.');
$dateDebut = dateFrDebut($trajet->getDateDebut());
$dateFin = dateFrDebut($trajet->getHeureFin());

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
$pdf->MultiCell(100,5,"Temps estimé : ".str_replace("hours","heures",$trajet->getDuration()));
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,154);
$pdf->MultiCell(100,5,"Date du départ : ".dateFrench($trajet->getDateDebut())." à ".heureDebutFr($trajet->getDateDebut()));
$pdf->Ln();

$pdf->SetFont("DejaVu",'',"10");
$pdf->SetXY (10,161);
$pdf->MultiCell(100,5,"Date d'arrivé : ".dateFrench($trajet->getDateDebut())." à ".$trajet->getEndofTrajet());
$pdf->Ln();

$column_Id = "";
$column_Services = "";
$column_Quantitee = "";
$column_Prix = "";
$total = 0;
$counterService=0;
$totalServices = 0;

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
$pdf->SetX(5);
$pdf->Cell(30,6,'ID Service',1,0,'C',1);
$pdf->SetX(35);
$pdf->Cell(30,6,'ID Annexe',1,0,'C',1);
$pdf->SetX(65);
$pdf->Cell(75,6,'Service',1,0,'C',1);
$pdf->SetX(140);
$pdf->Cell(30,6,'Quantitée',1,0,'C',1);
$pdf->SetX(170);
$pdf->Cell(30,6,'Prix',1,0,'C',1);

$pdf->Ln();

// A partir d'ici, on écrit dans le tableau la liste des services

// Si on a bien un abonnement, sa veut dire qu'on a des services

if(!empty($isAbonnee['idAbonnement'])){
  $reqChauffeur = $bdd->queryOne("SELECT * FROM collaborateurs WHERE idCollaborateurs=".$reqTrajet["idChauffeur"]."");
    //on recupere les id des services choisis sur ce trajet
    $idServices = $bdd->query('SELECT * FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');
    $i=0;$j=0;$k=0;$z=0;$h=0;$l=0;$m=0;$n=0;$o=0;
    $arrayLink = array();
    $total_prix = 0;
    foreach ($idServices as $unIdService) {

     
         //on recupere les infos du service en fonction de son id
      //   $service = $bdd->queryOne('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');
         $stmtIdLink = "";
         foreach ($arrayLink as $link) {
           $stmtIdLink.=" AND idLink != ".$link;
         }
         $linkService = $bdd->queryOne('SELECT * FROM linkServicetrajet WHERE idService='.$unIdService["idService"].' AND idTrajet='.$_SESSION["idTrajet"].' '.$stmtIdLink);
         array_push($arrayLink,$linkService['idLink']);
         $service = $bdd->queryOne('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');
         switch ($unIdService["idService"])
         {
           case 1:
           $infoLinkService = $bdd->queryOne('SELECT * FROM restaurants WHERE idRestaurant='.$unIdService["idAnnexe"].' '.$stmtIdLink);
           $column_Services= "Restaurant"." ".$infoLinkService["nom"];
           $column_Prix =$infoLinkService["prix"]*$linkService["quantite"]+$service["prixService"];

           break;
           case 2:
           case 3:
           case 4:
           case 5:
           case 6:
           case 9:
           case 15:
           case 16:
           case 18:
           case 19:
          // $infoLinkService = $bdd->queryOne('SELECT * FROM services WHERE idService='.$unIdService["idService"].' '.$stmtIdLink);
          $infoLinkService = $bdd->getPDO()->prepare('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');
          $infoLinkService->execute(array(
          ));
          $infoLinkService = $infoLinkService->fetch();
          //var_dump($infoLinkService["prixService"]);
          $column_Prix =$infoLinkService["prixService"];
          $column_Services=$infoLinkService["nomService"];
           break;
           case 7:
           $infoLinkService = $bdd->queryOne('SELECT * FROM chambre INNER JOIN hotel WHERE chambre.idHotel = hotel.idHotel AND chambre.idChambre = '.$unIdService["idAnnexe"]);
           $column_Services= $infoLinkService["nom"];
           $column_Prix = ($infoLinkService["prix"] * $linkService["quantite"] + $service['prixService']);

           break;
           case 8:
           $infoLinkService = $bdd->queryOne('SELECT * FROM billettourisme WHERE idBillet='.$unIdService["idAnnexe"]);
           $column_Services = "Billet touristique"." ".$infoLinkService["nom"];
           $column_Prix = ($infoLinkService["prix"] * $linkService["quantite"] + $service['prixService']);
           break;
         
           case 10:
           $req=$bdd->getPDO()->prepare('SELECT * FROM serviceautre WHERE emailClient = :emailClient ORDER BY idMessage DESC');
           $req->bindValue(':emailClient',$_SESSION['email']);
           $req->execute();
           $column_Services = "Demande de services";
           $unMessage = $req->fetch();
           $column_Prix = 0;
         
           break;
           case 11:
           $infoLinkService = $bdd->queryOne('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].' '.$stmtIdLink);
           $typeEtablissement="Interprete";
           $column_Services = $service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"];
           $numHour=calculHeure($bdd,11);
           $column_Prix = ($infoLinkService["prixCollaborateur"]*$numHour);

           break;
           case 12:
           $infoLinkService = $bdd->queryOne('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].' '.$stmtIdLink);
           $typeEtablissement="Coach Sportif";
           $column_Services = $service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"];
           $numHour=calculHeure($bdd,12);
           $column_Prix = ($infoLinkService["prixCollaborateur"]*$numHour);

           break;
           case 13:
           $infoLinkService = $bdd->queryOne('SELECT *  FROM collaborateurs INNER JOIN linkservicetrajet WHERE collaborateurs.idCollaborateurs = linkservicetrajet.idAnnexe AND idTrajet='.$_SESSION["idTrajet"].' AND idService ='.$unIdService["idService"].' '.$stmtIdLink);
           $typeEtablissement="Coach Culture";
           $column_Services = $service["nomService"]." : ".$infoLinkService["last_name"]." ".$infoLinkService["first_name"];
           $numHour=calculHeure($bdd,13);
           $column_Prix = ($infoLinkService["prixCollaborateur"]*$numHour);
           break;
        
           default:
           $column_Id = "";
           $column_Services="";
           $column_Quantitee="";
           $column_Prix = "";
           break;


         }


      
      // Pour chaque service, on affiche ses informations


$total_prix += $column_Prix;
$column_Id = $unIdService['idService'];
$column_Quantitee = $unIdService['quantite'];
$column_IdAnnexe = $unIdService['idAnnexe'];
$column_Prix = sprintf("%.2f",$column_Prix);
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('DejaVu','',10);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->Cell(30,6,$column_Id,1,1,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(35);
$pdf->Cell(30,6,$column_IdAnnexe,1,0,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(65);
$pdf->Cell(75,6,$column_Services,1,0,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(140);
$pdf->Cell(30,6,$column_Quantitee,1,0,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(170);
$pdf->Cell(30,6,$column_Prix."€",1,0,'C',1);

$pdf->Ln();
// On augmente le Y pour chaque services afin d'avoir un ligne spécifique par service.
$Y_Table_Position +=6;
if ( $pdf->getY() > 270)
{
  $pdf->AddPage();
  $Y_Table_Position = 0;
}
    }

    // On affiche les informations du chauffeur
$pdf->SetFillColor(232,232,232);

$pdf->SetFont('DejaVu','B',10);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->Cell(30,6,'ID Trajet',1,0,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(35);
$pdf->Cell(30,6,'ID Chauffeur',1,0,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(65);
$pdf->Cell(75,6,'Chauffeur',1,0,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(140);
$pdf->Cell(30,6,'Distance',1,0,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(170);
$pdf->Cell(30,6,'Prix',1,0,'C',1);
$Y_Table_Position +=6;

if ( $pdf->getY() > 270)
{
  $pdf->AddPage();
  $Y_Table_Position = 0;
}
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('DejaVu','',10);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->Cell(30,6,$_SESSION['idTrajet'],1,0,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(35);
$pdf->Cell(30,6,$reqChauffeur['idCollaborateurs'],1,0,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(65);
$pdf->Cell(75,6,$reqChauffeur["first_name"]." ".$reqChauffeur["last_name"]." Prix: ".$reqChauffeur["prixCollaborateur"]."€/Km",1,0,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(140);
$pdf->Cell(30,6,($reqTrajet["distanceTrajet"]." Km"),1,0,'C',1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(170);
$pdf->Cell(30,6,(sprintf("%.2f",$reqChauffeur["prixCollaborateur"]*$reqTrajet["distanceTrajet"]))."€",1,0,'C',1);
$Y_Table_Position +=6;
if ( $pdf->getY() > 270)
{
  $pdf->AddPage();
  $Y_Table_Position = 0;
}
// On affiche le prix total
$total_prix +=  ($reqChauffeur["prixCollaborateur"]*$reqTrajet["distanceTrajet"]); 
$total_prix = sprintf("%.2f",$total_prix)."€";
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('DejaVu','B',10);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(170);
$pdf->Cell(30,6,"Prix total",1,0,'C',1);
$Y_Table_Position +=6;
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('DejaVu','',10);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(170);
$pdf->Cell(30,6,$total_prix,1,0,'C',1);



}











// On créer une facture du trajet pour pouvoir récuperer les informations plus tard

$req2 = $bdd->getPDO()->prepare('INSERT INTO devis(prixTrajet,idTrajet,prixService,prixTotal,dateDevis) VALUES (:prixTrajet,:idTrajet,:prixService,:prixTotal,NOW())');
$req2->execute(array(
  'prixTrajet' => $reqTrajet["prixtrajet"],
  'idTrajet' =>$code,
  'prixService' => $totalServices,
  'prixTotal' => $real_price
));




ob_end_flush();
$destination = 'devis/devis'.$_SESSION['idTrajet'].'.pdf';
$pdf->Output($destination, 'F');
$pdf->Output('devis'.$_SESSION['idTrajet'].'.pdf', 'D');






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

  function calculHeure($bdd,$idService)
  {
      $req = $bdd->getPDO()->prepare('SELECT heureDebut,heureFin FROM trajet WHERE idTrajet = :idTrajet');
      $req->execute(array(
          'idTrajet' => $_SESSION['idTrajet']
      ));
      $unTrajet = $req->fetch();
      $req->closeCursor();
      $dateTrajetDebut = explode(" ", $unTrajet['heureDebut']);
      $dateTrajetDebut = $dateTrajetDebut[0];
      
      $dateTrajetFin = explode(" ", $unTrajet['heureFin']);
      $dateTrajetFin = $dateTrajetFin[0];
      

      $req = $bdd->getPDO()->prepare('SELECT dateStart,dateEnd FROM linkservicetrajet WHERE idTrajet = :idTrajet');
      $req->execute(array(
          'idTrajet' => $_SESSION['idTrajet']
      ));
      $unService = $req->fetch();
      $dateDebut = $dateTrajetDebut." ".$unService['dateStart'];
      $dateFin = $dateTrajetFin." ".$unService['dateEnd'];
      //$dateDebut  = new DateTime($dateDebut, new DateTimeZone('Europe/Paris'));
     // $dateFin  = new DateTime($dateFin, new DateTimeZone('Europe/Paris'));
      $heures = strtotime($dateFin ) - strtotime($dateDebut);
      $heures /=3600;
    //  var_dump($heures);
      return $heures;
 
  }

?>
