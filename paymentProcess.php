<?php 
session_start();
require 'Class/Autoloader.php';
App\Autoloader::register();
$bdd = new App\Database('rip');
require_once('fpdf/fpdf.php');


//Select the Products you want to show in your PDF file
// INFOS TRAJET ET SERVICES
$reqTrajet = $bdd->getPDO()->prepare('SELECT * FROM `trajet` INNER JOIN linkservicetrajet WHERE trajet.idTrajet = linkservicetrajet.idTrajet AND trajet.idTrajet ='.$_SESSION["idTrajet"].'');
$reqTrajet->execute();
while ($unIdClient = $reqTrajet->fetch()) {
$idClient = $unIdClient['idClient'];
}
$trajet = unserialize($_SESSION['trajet']);
// POUR RECUPERER LES INFOS PERSONNELS DU CLIENT
$reqInfosClient = $bdd->getPDO()->prepare('SELECT * FROM `users` WHERE id ='.$idClient.'');
$reqInfosClient->execute();

// POUR RECUPERER LES INFOS DES SERVICES UTILISES PENDANT LE TRAJET 
     //on recupere les id des services choisis sur ce trajet
     $idServices = $bdd->query('SELECT * FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].'');

     //  $idCollaborateurMultiples = $bdd->query('SELECT idAnnexe FROM linkServicetrajet WHERE idTrajet='.$_SESSION["idTrajet"].' AND (idService=11 OR idService=12 OR idService=13)');

       if (empty($idServices)) {
         echo "Aucun services selectionnés";
       }else {
           if (empty($idCollaborateurMultiples)) {

           }
         //on boucle les id des services choisis
         foreach ($idServices as $unIdService) {
$reqService = $bdd->queryOne('SELECT * FROM services WHERE idService='.$unIdService["idService"].'');




//Initialize the 3 columns and the total
$column_Trajet = "";
$column_Services = "";
$column_Prix = "";
$total = 0;

//For each row, add the field to the corresponding column
while($row = $reqTrajet->fetch())
{
    var_dump($row);
    $code = $row["idTrajet"];
    $name = substr($reqInfosClient["last_name"],0,20);
    $real_price = $_SESSION['prixTotal'];
    $price_to_show = number_format($real_price,',','.','.');

    $column_Trajet = $column_Trajet.$code."\n";
  //  $column_name = $column_name.$name."\n";
    // $column_price = $column_price.$price_to_show."\n";

    //Sum all the Prices (TOTAL)
   // $total = $total+$real_price;
}
$reqTrajet->closeCursor();
$reqInfosClient->closeCursor();
// $reqService->closeCursor();

//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.
//$total = number_format($total,',','.','.');

//Create a new PDF file
$pdf=new FPDF();
$titre = 'Trajet grace a Ride in Pride';
$pdf->SetTitle($titre);
$pdf->AddPage();

//Fields Name position
$Y_Fields_Name_position = 20;
//Table position, under Fields Name
$Y_Table_Position = 26;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(45);
$pdf->Cell(20,6,'CODE',1,0,'L',1);
$pdf->SetX(65);
$pdf->Cell(100,6,'NAME',1,0,'L',1);
$pdf->SetX(135);
$pdf->Cell(30,6,'PRICE',1,0,'R',1);
$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(45);
$pdf->MultiCell(20,6,$column_Trajet,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(65);
$pdf->MultiCell(100,6,$column_Services,1);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
//$pdf->MultiCell(30,6,$columna_price,1,'R');
//$pdf->SetX(135);
//$pdf->MultiCell(30,6,'$ '.$total,1,'R');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
/*$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $number_of_products)
{
    $pdf->SetX(45);
    $pdf->MultiCell(120,6,'',1);
    $i = $i +1;
}
*/
// construit le PDF
//$pdf->buildPDF();
// télécharge le fichier
//$pdf->Output('I','Facture.pdf');
       }
    }

    $pdf->Output('F',"facture.pdf");

    header("location:facture.pdf");
?>