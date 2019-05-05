<?php

require '../../Class/Autoloader.php';

$bdd = new App\Database('rip');
session_start();

$user = $bdd->query('SELECT id, email, last_name, first_name, birthday, gender, isAdmin, isBanned FROM USERS WHERE isBanned = '.$_GET["isBanned"].' AND CONCAT(id, email, last_name, first_name, birthday, gender, isAdmin, isBanned) LIKE "%'.$_GET["inputText"].'%" ');

echo '
<table class="table" id=users>
  <thead>
    <tr>
      <th scope="col">Mail</th>
      <th scope="col">Nom</th>
      <th scope="col">Prenom</th>
      <th scope="col">Date de naissance</th>
      <th scope="col">Sexe</th>
      <th scope="col">Edit</th>
      <th scope="col">Admin</th>
      <th scope="col">Ban</th>
    </tr>
  </thead>
';

foreach ($user as $member) {
  echo '
  <tr>
      <form method="POST" action="edit.php">
        <input  name="id" type="hidden" value="'.$member["id"].'"/>
        <td><input name="email" type="text" value="'.$member["email"].'"/></td>
        <td><input name="last_name" type="text" value="'.$member["last_name"].'"/></td>
        <td><input name="first_name" type="text" value="'.$member["first_name"].'"/></td>
        <td><input name="birthday" type="text" value="'.$member["birthday"].'"/></td>
        ';
        if($member["gender"]=="Homme"){
          echo '
          <td>
            <select  name="gender" class="hlite">
              <option value="Homme">Homme </option>
              <option value="Femme">Femme </option>
            </select>
          </td>';
        }else{
          echo '
          <td>
            <select  name="gender" class="hlite">
              <option value="Femme">Femme </option>
              <option value="Homme">Homme </option>
            </select>
          </td>';
        }
      echo'
        <td>

        <button type="submit" class="btn btn-blue">
          <span class="glyphicon glyphicon-edit"></span>
        </button>
        </form>
        </td>
      ';

      //bouton student
      if ($member["isAdmin"] == 1){
      echo '
      <td>
        <form method="POST" action="admin.php">
          <input  name="id" type="hidden" value="'.$member["id"].'"/>
          <input  name="admin" type="hidden" value="1"/>
          <button name="admin" value="1" class="btn btn-success" onclick="updateAdmin(this.parentElement);"></button>
        </form>
      </td>';
      }
      else {
        echo '
        <td>
          <form method="POST" action="admin.php">
            <input  name="id" type="hidden" value="'.$member["id"].'"/>
            <input  name="admin" type="hidden" value="0"/>
            <button name="admin" value="0" class="btn btn-danger" onclick="updateAdmin(this.parentElement);"></button>
          </form>
        </td>';
      }
      //bouton de ban

        echo'
        <td>
          <form method="GET" action="ban.php">
            <input  name="id" type="hidden" value="'.$member["id"].'"/>
            <button type="submit" class="btn btn-danger">
            </button>
          </form>
        </td>
      </tr>
        ';
}
echo "</table>";

//echo "string";
 ?>
