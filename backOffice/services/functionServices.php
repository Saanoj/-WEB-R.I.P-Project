<?php
define('CONF', '../includehtml/config.php');

function backOfficeServices()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM services");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idService"]?>"/>
        <td><?php echo $member["idService"]?> </td>
        <td><input name="nomService" type="text" value="<?php echo $member["nomService"]?>"/></td>
        <td><input name="prixService" type="text" value="<?php echo $member["prixService"]?>"/></td>
        <td><input name="categorie" type="text" value="<?php echo $member["categorie"]?>"/></td>
        <td><input name="description" type="text" value="<?php echo $member["description"]?>"/></td>
        <td>

          <button name="edit" type="submit" class="btn btn-warning">
            Edit
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
      </td>
      <form method="POST" action="change.php">
        <td>
          <input  name="id" type="hidden" value=" <?php echo $member["idService"]; ?> "/>
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
        <input  name="id" type="hidden"/>
        <td></td>
        <td><input name="nomService" type="text"/></td>
        <td><input name="prixService" type="text"/></td>
        <td><input name="categorie" type="text" /></td>
        <td><input name="description" type="text"/></td>

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

    function edit($id, $nomService, $prixService, $categorie, $description)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE services SET
        nomService = :nomService,
        prixService = :prixService,
        categorie = :categorie,
        description = :description
        WHERE idService = :id");
        $query->execute([
          "id"=> $id,
          "nomService"=>$nomService,
          "prixService"=>$prixService,
          "categorie"=>$categorie,
          "description"=>$description
        ]);
      }

      function add($nomService, $prixService, $categorie, $description){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO services (nomService, prixService, categorie, description)
        VALUES
        (
          :nomService,
          :prixService,
          :categorie,
          :description
        )
        ");
        $query->execute([
          "nomService"=>$nom,
          "prixService"=>$isValide,
          "categorie"=>$villeBillet,
          "description"=>$prix
        ]);
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `services` WHERE idService = :id");
        $query->execute([
          "id"=>$id,

        ]);

      }
      ?>
