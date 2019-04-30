<?php
define('CONF', '../includehtml/config.php');

function backOfficeLinkService()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM linkservicetrajet");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idLink"]?>"/>
        <td><?php echo $member["idLink"]?> </td>
        <td><input name="idTrajet" type="text" value="<?php echo $member["idTrajet"]?>"/></td>
        <td><input name="idService" type="text" value="<?php echo $member["idService"]?>"/></td>
        <td><input name="idAnnexe" type="text" value="<?php echo $member["idAnnexe"]?>"/></td>
        <td><input name="quantite" type="text" value="<?php echo $member["quantite"]?>"/></td>
        <td><input name="statut" type="text" value="<?php echo $member["statut"]?>"/></td>
        <td><input name="dateStart" type="text" value="<?php echo $member["dateStart"]?>"/></td>
        <td><input name="dateEnd" type="text" value="<?php echo $member["dateEnd"]?>"/></td>
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
        <td><input name="idTrajet" type="text"/></td>
        <td><input name="idService" type="text"/></td>
        <td><input name="idAnnexe" type="text" /></td>
        <td><input name="quantite" type="text" /></td>
        <td><input name="statut" type="text" /></td>
        <td><input name="dateStart" type="text" /></td>
        <td><input name="dateEnd" type="text" /></td>
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

    function edit($id, $idTrajet, $idService, $idAnnexe, $quantite, $statut, $dateStart, $dateEnd)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE linkservicetrajet SET
        idTrajet = :idTrajet,
        idService = :idService,
        idAnnexe = :idAnnexe,
        quantite = :quantite,
        statut = :statut,
        dateStart = :dateStart,
        dateEnd = :dateEnd
        WHERE idLink = :id");
        $query->execute([
          "id"=> $id,
          "idTrajet"=>$idTrajet,
          "idService"=>$idService,
          "idAnnexe"=>$idAnnexe,
          "quantite"=>$quantite,
          "statut"=>$statut,
          "dateStart"=>$dateStart,
          "dateEnd"=>$dateEnd
        ]);
      }

      function add($idTrajet, $idService, $idAnnexe, $quantite, $statut, $dateStart, $dateEnd){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO linkservicetrajet (idTrajet, idService, idAnnexe, quantite, statut, dateStart, dateEnd)
        VALUES (:idTrajet, :idService, :idAnnexe, :quantite, :statut, :dateStart, :dateEnd)");
        $query->execute([
          "idTrajet"=>$idTrajet,
          "idService"=>$idService,
          "idAnnexe"=>$idAnnexe,
          "quantite"=>$quantite,
          "statut"=>$statut,
          "dateStart"=>$dateStart,
          "dateEnd"=>$dateEnd
        ]);
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `linkservicetrajet` WHERE idLink = :id");
        $query->execute([
          "id"=>$id

        ]);

      }
      ?>
