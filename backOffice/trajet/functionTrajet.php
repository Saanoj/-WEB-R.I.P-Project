<?php
define('CONF', '../includehtml/config.php');

function backOfficeTrajet()
{
  include (CONF);



  $query=$bdd->prepare("SELECT * FROM trajet");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    ?>
    <tr>
      <form method="POST" action="change.php">

        <input  name="id" type="hidden" value="<?php echo $member["idTrajet"]?>"/>
        <td><?php echo $member["idTrajet"]?> </td>
        <td><input name="idClient" type="text" value="<?php echo $member["idClient"]?>"/></td>
        <td><input name="idChauffeur" type="text" value="<?php echo $member["idChauffeur"]?>"/></td>
        <td><input name="heureDebut" type="text" value="<?php echo $member["heureDebut"]?>"/></td>
        <td><input name="heureFin" type="text" value="<?php echo $member["heureFin"]?>"/></td>
        <td><input name="dateResevation" type="text" value="<?php echo $member["dateResevation"]?>"/></td>
        <td><input name="distanceTrajet" type="text" value="<?php echo $member["distanceTrajet"]?>"/></td>
        <td><input name="prixtrajet" type="text" value="<?php echo $member["prixtrajet"]?>"/></td>
        <td><input name="debut" type="text" value="<?php echo $member["debut"]?>"/></td>
        <td><input name="fin" type="text" value="<?php echo $member["fin"]?>"/></td>
        <td><input name="duration" type="text" value="<?php echo $member["duration"]?>"/></td>
        <td><input name="state" type="text" value="<?php echo $member["state"]?>"/></td>
        <td><input name="stateDriver" type="text" value="<?php echo $member["stateDriver"]?>"/></td>
        <td>
          <button name="edit" type="submit" class="btn btn-warning">
            edit
            <span class="glyphicon glyphicon-edit"></span>
          </button>
        </form>
      </td>
      <form method="POST" action="change.php">
        <td>
          <input  name="id" type="hidden" value=" <?php echo $member["idTrajet"]; ?> "/>
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
        <td><input name="idClient" type="text"/></td>
        <td><input name="idChauffeur" type="text"/></td>
        <td><input name="heureDebut" type="text" /></td>
        <td><input name="heureFin" type="text" /></td>
        <td><input name="dateResevation" type="text" /></td>
        <td><input name="distanceTrajet" type="text" /></td>
        <td><input name="prixtrajet" type="text" /></td>
        <td><input name="debut" type="text" /></td>
        <td><input name="fin" type="text" /></td>
        <td><input name="state" type="text" /></td>
        <td><input name="stateDriver" type="text" /></td>
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

    function edit($id, $idClient, $idChauffeur, $heureDebut, $heureFin, $dateResevation, $distanceTrajet, $prixtrajet, $debut, $fin, $duration, $state, $stateDriver)
    {
      include (CONF);
      $query = $bdd->prepare("UPDATE trajet SET
        idClient = :idClient,
        idChauffeur = :idChauffeur,
        heureDebut = :heureDebut,
        heureFin = :heureFin,
        dateResevation = :dateResevation,
        distanceTrajet = :distanceTrajet,
        prixtrajet = :prixtrajet,
        debut = :debut,
        fin = :fin,
        duration = :duration,
        state = :distanceTrajet,
        stateDriver = :stateDriver
        WHERE idTrajet = :id");
        $query->execute([
          "id"=> $id,
          "idClient"=>$idClient,
          "idChauffeur"=>$idChauffeur,
          "heureDebut"=>$heureDebut,
          "heureFin"=>$heureFin,
          "dateResevation"=>$dateResevation,
          "distanceTrajet"=>$distanceTrajet,
          "prixtrajet"=>$prixtrajet,
          "debut"=>$debut,
          "fin"=>$fin,
          "duration"=>$duration,
          "state"=>$state,
          "stateDriver"=>$stateDriver
        ]);
      }

      function add($idClient, $idChauffeur, $heureDebut, $heureFin, $dateResevation, $distanceTrajet, $prixtrajet, $debut, $fin, $duration, $state, $stateDriver){
        include (CONF);
        $query = $bdd->prepare("INSERT INTO trajet (idClient, idChauffeur, heureDebut, heureFin, dateResevation, distanceTrajet, prixtrajet, debut, fin, duration, state, stateDrive)
        VALUES (:idClient, :idChauffeur, :heureDebut, :heureFin, :dateResevation, :distanceTrajet, :prixtrajet, :debut, :fin, :duration, :state, :stateDriver)");
        $query->execute([
          "idClient"=>$idClient,
          "idChauffeur"=>$idChauffeur,
          "heureDebut"=>$heureDebut,
          "heureFin"=>$heureFin,
          "dateResevation"=>$dateResevation,
          "distanceTrajet"=>$distanceTrajet,
          "prixtrajet"=>$prixtrajet,
          "debut"=>$debut,
          "fin"=>$fin,
          "duration"=>$duration,
          "state"=>$state,
          "stateDriver"=>$stateDriver
        ]);
      }

      function drop($id)
      {
        include (CONF);
        $query = $bdd->prepare("DELETE FROM `trajet` WHERE idTrajet = :id");
        $query->execute([
          "id"=>$id

        ]);

      }
      ?>
