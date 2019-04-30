<?php
define('CONF', '../includehtml/config.php');

function backOfficeRestaurants()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM restaurants");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idRestaurant"]?>"/>
        <td><?php echo $member["idRestaurant"]?> </td>
        <td><input name="isDispo" type="text" value="<?php echo $member["isDispo"]?>"/></td>
        <td><input name="nom" type="text" value="<?php echo $member["nom"]?>"/></td>
        <td><input name="prix" type="text" value="<?php echo $member["prix"]?>"/></td>
        <td><input name="horrairesDebut" type="text" value="<?php echo $member["horrairesDebut"]?>"/></td>
        <td><input name="horrairesFin" type="text" value="<?php echo $member["horrairesFin"]?>"/></td>
        <td><input name="adresseRestaurant" type="text" value="<?php echo $member["adresseRestaurant"]?>"/></td>
        <td><input name="villeRestaurant" type="text" value="<?php echo $member["villeRestaurant"]?>"/></td>
        <td>
          <button name="edit" type="submit" class="btn btn-warning">
            edit
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
      </td>
      <form method="POST" action="change.php">
        <td>
          <input  name="id" type="hidden" value=" <?php echo $member["idRestaurant"]; ?> "/>
          <button  name = "drop" type="submit" class="btn btn-danger">
            Delete
            <span class="glyphicon glyphicon"></span>
          </button>
        </td>
      </form>
    </tr>
      <?php


    }

    ?>

    <tr>
      <form method="POST" action="change.php">
        <td></td>
        <td><input name="isDispo" type="text"/></td>
        <td><input name="nom" type="text"/></td>
        <td><input name="prix" type="text" /></td>
        <td><input name="horrairesDebut" type="text" /></td>
        <td><input name="horrairesFin" type="text" /></td>
        <td><input name="adresseRestaurant" type="text" /></td>
        <td><input name="villeRestaurant" type="text" /></td>
        <td>

          <button name="add" type="submit" class="btn btn-success">
            Add
            <span class="glyphicon glyphicon"></span>
          </button>
        </form>
      </td>
    </tr>

      <?php

    }

    function edit($id, $isDispo, $nom, $prix, $horrairesDebut, $horrairesFin, $adresseRestaurant, $villeRestaurant)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE restaurants SET
        isDispo = :isDispo,
        nom = :nom,
        prix = :prix,
        horrairesDebut = :horrairesDebut,
        horrairesFin = :horrairesFin,
        adresseRestaurant = :adresseRestaurant,
        villeRestaurant = :villeRestaurant
        WHERE idRestaurant = :id");
        $query->execute([
          "id"=> $id,
          "isDispo"=>$isDispo,
          "nom"=>$nom,
          "prix"=>$prix,
          "horrairesDebut"=>$horrairesDebut,
          "horrairesFin"=>$horrairesFin,
          "adresseRestaurant"=>$adresseRestaurant,
          "villeRestaurant"=>$villeRestaurant
        ]);
      }

      function add($isDispo, $nom, $prix, $horrairesDebut, $horrairesFin, $adresseRestaurant, $villeRestaurant){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO restaurants (isDispo, nom, prix, horrairesDebut, horrairesFin, adresseRestaurant, villeRestaurant)
        VALUES (:isDispo, :nom, :prix, :horrairesDebut, :horrairesFin, :adresseRestaurant, :villeRestaurant)");
        $query->execute([
          "isDispo"=>$isDispo,
          "nom"=>$nom,
          "prix"=>$prix,
          "horrairesDebut"=>$horrairesDebut,
          "horrairesFin"=>$horrairesFin,
          "adresseRestaurant"=>$adresseRestaurant,
          "villeRestaurant"=>$villeRestaurant
        ]);
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `restaurants` WHERE idRestaurant = :id");
        $query->execute([
          "id"=>$id

        ]);

      }
      ?>
