<?php
function backOfficeCollab()
{
  include ("config.php");



  $query=$bdd->prepare("SELECT * FROM collaborateurs");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){

    echo '
      <tr>
        <form method="POST" action="edit.php">
          <input  name="id" type="hidden" value="'.$member["idCollaborateurs"].'"/>
          <td><input name="email" type="text" value="'.$member["email"].'"/></td>
          <td><input name="last_name" type="text" value="'.$member["last_name"].'"/></td>
          <td><input name="first_name" type="text" value="'.$member["first_name"].'"/></td>
          <td><input name="metier" type="text" value="'.$member["metier"].'"/></td>
          <td><input name="description" type="text" value="'.$member["description"].'"/></td>
          <td><input name="prixCollaborateur" type="text" value="'.$member["prixCollaborateur"].'"/></td>
          <td><input name="dateEmbauche" type="text" value="'.$member["dateEmbauche"].'"/></td>
          <td><input name="ville" type="text" value="'.$member["ville"].'"/></td>
          <td><input name="heuresTravailees" type="text" value="'.$member["heuresTravailees"].'"/></td>
          <td><input name="rating" type="text" value="'.$member["rating"].'"/></td>
          <td><input name="ratingNumber" type="text" value="'.$member["ratingNumber"].'"/></td>
          <td>

          <button type="submit" class="btn btn-blue">
            <span class="glyphicon glyphicon-edit"></span>
          </button>
          </form>
          </td>
          <form method="POST" action="drop.php">
          <td>
          <input  name="id" type="hidden" value="'.$member["idCollaborateurs"].'"/>
          <button type="submit" class="btn btn-danger">
            Delete
            <span class="glyphicon glyphicon"></span>
          </button>
          </td>
          </form>

        </tr>

        ';

  }

  echo'
  <tr>
      <form method="POST" action="add.php">
        <td><input name="email" type="text" /></td>
        <td><input name="last_name" type="text" ></td>
        <td><input name="first_name" type="text" /></td>
        <td><input name="metier" type="text"/></td>
        <td><input name="description" type="text" /></td>
        <td><input name="prixCollaborateur" type="text" /></td>
        <td><input name="dateEmbauche" type="text" /></td>
        <td><input name="ville" type="text" /></td>
        <td><input name="heuresTravailees" type="text" /></td>
        <td><input name="rating" type="text" /></td>
        <td><input name="ratingNumber" type="text" /></td>
        <td>

        <button type="submit" class="btn">
          Add
          <span class="glyphicon glyphicon"></span>
        </button>
        </form>
        </td>
      ';
}
function edit($id, $email, $last_name, $first_name, $metier, $description, $prixCollaborateur, $dateEmbauche, $ville, $heuresTravailees,$rating ,$ratingNumber){
  include ("config.php");
  $query = $bdd->prepare("UPDATE collaborateurs SET
    email = :email,
    first_name = :first_name,
    last_name = :last_name,
    metier = :metier,
    description = :description,
    prixCollaborateur = :prixCollaborateur,
    dateEmbauche = :dateEmbauche,
    ville = :ville,
    heuresTravailees = :heuresTravailees,
    rating = :rating,
    ratingNumber = :ratingNumber
    WHERE idCollaborateurs = :id");
  $query->execute([
                  "id"=>$id,
                  "email"=>$email,
                  "first_name"=>$first_name,
                  "last_name"=>$last_name,
                  "metier" => $metier,
                  "description"=>$description,
                  "prixCollaborateur"=>$prixCollaborateur,
                  "dateEmbauche"=>$dateEmbauche,
                  "ville"=>$ville,
                  "heuresTravailees"=>$heuresTravailees,
                  "rating"=>$rating,
                  "ratingNumber"=>$ratingNumber,

                  ]);
}
function add($email, $last_name, $first_name, $metier, $description, $prixCollaborateur, $dateEmbauche, $ville, $heuresTravailees,$rating ,$ratingNumber){
  include ("config.php");
  $query = $bdd->prepare("INSERT INTO collaborateurs (email, last_name, first_name, metier, description, prixCollaborateur, dateEmbauche, ville, heuresTravailees, rating, ratingNumber) VALUES
    (:email,
    :first_name,
    :last_name,
    :metier,
    :description,
    :prixCollaborateur,
    :dateEmbauche,
    :ville,
    :heuresTravailees,
    :rating,
    :ratingNumber)
    ");
  $query->execute([
                  "email"=>$email,
                  "first_name"=>$first_name,
                  "last_name"=>$last_name,
                  "metier" => $metier,
                  "description"=>$description,
                  "prixCollaborateur"=>$prixCollaborateur,
                  "dateEmbauche"=>$dateEmbauche,
                  "ville"=>$ville,
                  "heuresTravailees"=>$heuresTravailees,
                  "rating"=>$rating,
                  "ratingNumber"=>$ratingNumber,
                  ]);
}

function drop($id)
{
  include ("config.php");
  $query = $bdd->prepare("DELETE FROM `collaborateurs` WHERE idCollaborateurs = :id");
  $query->execute([
                  "id"=>$id,

                  ]);

}
 ?>
