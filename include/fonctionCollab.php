<?php
function backOfficeCollab()
{
  include ("config.php");



  $query=$bdd->prepare("SELECT * FROM collaborateurs");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
        <form method="POST" action="edit.php">
          <input  name="id" type="hidden" value="'.$member["idCollaborateurs"].'"/>
          <td><input name="email" type="text" value="'.$member["email"].'"/></td>
          <td><input name="last_name" type="text" value="'.$member["last_name"].'"/></td>
          <td><input name="first_name" type="text" value="'.$member["first_name"].'"/></td>
          <td><input name="metier" type="text" value="'.$member["metier"].'"/></td>
          <td><input name="prixCollaborateur" type="text" value="'.$member["prixCollaborateur"].'"/></td>
          <td><input name="dateEmbauche" type="text" value="'.$member["dateEmbauche"].'"/></td>
          <td><input name="ville" type="text" value="'.$member["ville"].'"/></td>
          <td><input name="heuresTravailees" type="text" value="'.$member["heuresTravailees"].'"/></td>
          ';

        echo'
          <td>

          <button type="submit" class="btn btn-blue">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
          </form>
          </td>
        ';


  }
  echo'
  <tr>
      <form method="POST" action="add.php">
        <input  name="id" type="hidden" />
        <td><input name="email" type="text" /></td>
        <td><input name="last_name" type="text" ></td>
        <td><input name="first_name" type="text" /></td>
        <td><input name="metier" type="text"/></td>
        <td><input name="prixCollaborateur" type="text" /></td>
        <td><input name="dateEmbauche" type="text" /></td>
        <td><input name="ville" type="text" /></td>
        <td><input name="heuresTravailees" type="text" /></td>
        <td>

        <button type="submit" class="btn btn-blue">
          <span class="glyphicon glyphicon-edit"></span>
        </button>
        </form>
        </td>
      ';
}
function edit($id, $email, $first_name, $last_name, $metier, $prixCollaborateur, $dateEmbauche, $ville, $heuresTravailees){
  include ("config.php");
  $query = $bdd->prepare("UPDATE collaborateurs SET
    email = :email,
    first_name = :first_name,
    last_name = :last_name,
    metier = :metier,
    prixCollaborateur = :prixCollaborateur,
    dateEmbauche = :dateEmbauche,
    ville = :ville,
    heuresTravailees = :heuresTravailees
    WHERE idCollaborateurs = :id");
  $query->execute([
                  "id"=>$id,
                  "email"=>$email,
                  "first_name"=>$first_name,
                  "last_name"=>$last_name,
                  "metier" => $metier,
                  "prixCollaborateur"=>$prixCollaborateur,
                  "dateEmbauche"=>$dateEmbauche,
                  "ville"=>$ville,
                  "heuresTravailees"=>$heuresTravailees
                  ]);
}
function add($id, $email, $first_name, $last_name, $metier, $prixCollaborateur, $dateEmbauche, $ville, $heuresTravailees){
  include ("config.php");
  $query = $bdd->prepare("INSERT INTO collaborateurs (email, last_name, first_name, metier, description, prixCollaborateur, dateEmbauche, ville, heuresTravailees) VALUES
    :email,
    :first_name,
    :last_name,
    :metier,
    :prixCollaborateur,
    :dateEmbauche,
    :ville,
    :heuresTravailees
    ");
  $query->execute([
                  "email"=>$email,
                  "first_name"=>$first_name,
                  "last_name"=>$last_name,
                  "metier" => $metier,
                  "prixCollaborateur"=>$prixCollaborateur,
                  "dateEmbauche"=>$dateEmbauche,
                  "ville"=>$ville,
                  "heuresTravailees"=>$heuresTravailees
                  ]);
}
 ?>
