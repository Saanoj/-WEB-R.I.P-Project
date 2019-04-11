<?php
function backOfficeTrajet()
{
  include ("config.php");



  $query=$bdd->prepare("SELECT * FROM trajet");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
        <form method="POST" action="edit.php">
          <input  name="id" type="hidden" value="'.$member["idTrajet"].'"/>
          <td><input name="idClient" type="text" value="'.$member["idClient"].'"/></td>
          <td><input name="idChauffeur" type="text" value="'.$member["idChauffeur"].'"/></td>
          <td><input name="heureDebut" type="text" value="'.$member["heureDebut"].'"/></td>
          <td><input name="heureFin" type="text" value="'.$member["heureFin"].'"/></td>
          <td><input name="dateResevation" type="text" value="'.$member["dateResevation"].'"/></td>
                    <td><input name="prixtrajet" type="text" value="'.$member["distanceTrajet"].'"/></td>
          <td><input name="prixtrajet" type="text" value="'.$member["prixtrajet"].'"/></td>
          <td><input name="debut" type="text" value="'.$member["debut"].'"/></td>
          <td><input name="fin" type="text" value="'.$member["fin"].'"/></td>
          <td>

          <button type="submit" class="btn btn-blue">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
          </form>
          </td>
          <form method="POST" action="drop.php">
          <td>
          <input  name="id" type="hidden" value="'.$member["idTrajet"].'"/>
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
      <td><input name="idChauffeur" type="text"/></td>
      <td><input name="heureDebut" type="text"/></td>
      <td><input name="heureFin" type="text"/></td>
      <td><input name="dateResevation" type="text"/></td>
                <td><input name="prixtrajet" type="text"/></td>
      <td><input name="prixtrajet" type="text"/></td>
      <td><input name="debut" type="text"/></td>
      <td><input name="fin" type="text"/></td>
        <td>

        <button type="submit" class="btn">
          Add
          <span class="glyphicon glyphicon"></span>
        </button>
        </form>
        </td>
      ';
}
function edit($id,$idClient, $idChauffeur, $heureDebut, $heureFin, $dateResevation, $prixtrajet, $debut, $fin){
  include ("config.php");
  $query = $bdd->prepare("UPDATE trajet SET
    idClient = :idClient,
    idChauffeur = :idChauffeur,
    heureDebut = :heureDebut,
    heureFin = :heureFin,
    dateResevation = :dateResevation,
    prixtrajet = :prixtrajet,
    debut = :debut,
    fin = :fin
    WHERE idTrajet = :id");
  $query->execute([
                  "id"=> $id,
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
function add($id,$idClient, $idChauffeur, $heureDebut, $heureFin, $dateResevation, $prixtrajet, $debut, $fin){
  include ("config.php");
  $query = $bdd->prepare("INSERT INTO collaborateurs (  idClient, idChauffeur, heureDebut, heureFin, dateResevation, prixtrajet, debut, fin) VALUES
    (
      :idClient,
      :idChauffeur,
      :heureDebut,
      :heureFin,
      :dateResevation,
      :prixtrajet,
      :debut,
      :fin
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
  $query = $bdd->prepare("DELETE FROM `collaborateurs` WHERE idTrajet = :id");
  $query->execute([
                  "id"=>$id,

                  ]);

}
 ?>
