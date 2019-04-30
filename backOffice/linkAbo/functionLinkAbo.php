<?php
define('CONF', '../includehtml/config.php');

function backOfficeLinkAbo()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM linkabonnemententreprise");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idLink"]?>"/>
        <td><?php echo $member["idLink"]?> </td>
        <td><input name="idAbonnement" type="text" value="<?php echo $member["idAbonnement"]?>"/></td>
        <td><input name="idClient" type="text" value="<?php echo $member["idClient"]?>"/></td>
        <td><input name="idEntreprise" type="text" value="<?php echo $member["idEntreprise"]?>"/></td>
        <td><input name="dateDebut" type="text" value="<?php echo $member["dateDebut"]?>"/></td>
        <td><input name="dateFin" type="text" value="<?php echo $member["dateFin"]?>"/></td>
        <td>
          <button name="edit" type="submit" class="btn btn-warning">
            edit
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
      </td>
      <form method="POST" action="change.php">
        <td>
          <input  name="id" type="hidden" value=" <?php echo $member["idLink"]; ?> "/>
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
        <td><input name="idAbonnement" type="text"/></td>
        <td><input name="idClient" type="text"/></td>
        <td><input name="idEntreprise" type="text" /></td>
        <td><input name="dateDebut" type="text" /></td>
        <td><input name="dateFin" type="text" /></td>
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

    function edit($id, $idAbonnement, $idClient, $idEntreprise, $dateDebut, $dateFin)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE linkabonnemententreprise SET
        idAbonnement = :idAbonnement,
        idClient = :idClient,
        idEntreprise = :idEntreprise,
        dateDebut = :dateDebut,
        dateFin = :dateFin
        WHERE idLink = :id");
        $query->execute([
          "id"=> $id,
          "idAbonnement"=>$idAbonnement,
          "idClient"=>$idClient,
          "idEntreprise"=>$idEntreprise,
          "dateDebut"=>$dateDebut,
          "dateFin"=>$dateFin
        ]);
      }

      function add($idAbonnement, $idClient, $idEntreprise, $dateDebut, $dateFin){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO linkabonnemententreprise (idAbonnement, idClient, idEntreprise, dateDebut, dateFin)
        VALUES (:idAbonnement, :idClient, :idEntreprise, :dateDebut, :dateFin)");
        $query->execute([
          "idAbonnement"=>$idAbonnement,
          "idClient"=>$idClient,
          "idEntreprise"=>$idEntreprise,
          "dateDebut"=>$dateDebut,
          "dateFin"=>$dateFin
        ]);
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `linkabonnemententreprise` WHERE idLink = :id");
        $query->execute([
          "id"=>$id

        ]);

      }
      ?>
