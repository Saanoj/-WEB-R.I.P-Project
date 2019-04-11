<?php
function backOfficeAbo()
{
  include ("config.php");



  $query=$bdd->prepare("SELECT * FROM abonnement");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
        <form method="POST" action="edit.php">
          <input  name="id" type="hidden" value="'.$member["idAbonnement"].'"/>
          <td><input name="idClient" type="text" value="'.$member["idClient"].'"/></td>
          <td><input name="dateDebut" type="text" value="'.$member["dateDebut"].'"/></td>
          <td><input name="dateFin" type="text" value="'.$member["dateFin"].'"/></td>
          <td><input name="typeAbonnement" type="text" value="'.$member["typeAbonnement"].'"/></td>
          <td><input name="isEngagement" type="text" value="'.$member["isEngagement"].'"/></td>
          <td>

          <button type="submit" class="btn btn-blue">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
          </form>
          </td>
          <form method="POST" action="drop.php">
          <td>
          <input  name="id" type="hidden" value="'.$member["idAbonnement"].'"/>
          <button type="submit" class="btn btn-danger">
            Delete
            <span class="glyphicon glyphicon"></span>
          </button>
          </td>
          </form>
        ';


  }
  echo'
  <tr>
      <form method="POST" action="add.php">
      <input  name="id" type="hidden"/>
      <td><input name="idClient" type="text"/></td>
      <td><input name="dateDebut" type="text"/></td>
      <td><input name="dateFin" type="text"/></td>
      <td><input name="typeAbonnement" type="text"/></td>
      <td><input name="isEngagement" type="text"/></td>

        <td>

        <button type="submit" class="btn">
          Add
          <span class="glyphicon glyphicon"></span>
        </button>
        </form>
        </td>
      ';
}
function edit($id,$idClient, $dateDebut, $dateFin, $typeAbonnement, $isEngagement){
  include ("config.php");
  $query = $bdd->prepare("UPDATE abonnement SET
    idClient = :idClient,
    dateDebut = :dateDebut,
    dateFin = :dateFin,
    typeAbonnement = :typeAbonnement,
    isEngagement = :isEngagement
    WHERE idAbonnement = :id");
  $query->execute([
                  "id"=> $id,
                  "idClient"=>$idClient,
                  "dateDebut"=>$dateDebut,
                  "dateFin"=>$dateFin,
                  "typeAbonnement"=>$typeAbonnement,
                  "isEngagement" => $isEngagement
                  ]);
}
function add($id,$idClient, $dateDebut, $dateFin, $typeAbonnement, $isEngagement){
  include ("config.php");
  $query = $bdd->prepare("INSERT INTO abonnement (  idClient, idChauffeur, dateDebut, dateFin, typeAbonnement, isEngagement) VALUES
    (
      idClient = :idClient,
      dateDebut = :dateDebut,
      dateFin = :dateFin,
      typeAbonnement = :typeAbonnement,
      isEngagement = :isEngagement
  )
    ");
  $query->execute([
    "idClient"=>$idClient,
    "idChauffeur"=>$idChauffeur,
    "heureDebut"=>$heureDebut,
    "heureFin"=>$heureFin,
    "dateResevation" => $dateResevation,
    "prixtrajet"=> $prixtrajet,
    "debut"=>$debut,
    "fin"=>$fin
                  ]);
}

function drop($id)
{
  include ("config.php");
  $query = $bdd->prepare("DELETE FROM `collaborateurs` WHERE idAbonnement = :id");
  $query->execute([
                  "id"=>$id,

                  ]);

}
 ?>
