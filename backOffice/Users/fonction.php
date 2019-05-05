<?php

define('CONF', '../includehtml/config.php');

//BACK OFFICE USER
//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function backOfficeUser(){
  require_once (CONF);



  $query=$bdd->prepare("SELECT * FROM USERS WHERE isBanned = 0");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
        <form method="POST" action="edit.php">
          <td>'.$member["id"].'</td>
          <input name="id" type="hidden" value="'.$member["id"].'"/>
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
          echo '<td><input name="avatar" type="text" value="'.$member["avatar"].'"/></td>
          <td><input name="avatar" type="text" value="'.$member["idEntreprise"].'"/></td>';

        echo'
          <td>

          <button type="submit" class="btn btn-warning">
          edit
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



        if ($member["isCollaborateur"] == 1){
        echo '
        <td>
          <form method="POST" action="collab.php">
            <input  name="id" type="hidden" value="'.$member["id"].'"/>
            <input  name="collab" type="hidden" value="1"/>
            <button name="collab" value="1" class="btn btn-success"></button>
          </form>
        </td>';
        }
        else {
          echo '
          <td>
            <form method="POST" action="collab.php">
              <input  name="id" type="hidden" value="'.$member["id"].'"/>
              <input  name="collab" type="hidden" value="0"/>
              <button name="collab" value="0" class="btn btn-danger"></button>
            </form>
          </td>';
        }



        if ($member["isDirecteur"] == 1){
        echo '
        <td>
          <form method="POST" action="dir.php">
            <input  name="id" type="hidden" value="'.$member["id"].'"/>
            <input  name="dir" type="hidden" value="1"/>
            <button name="dir" value="1" class="btn btn-success"></button>
          </form>
        </td>';
        }
        else {
          echo '
          <td>
            <form method="POST" action="dir.php">
              <input  name="id" type="hidden" value="'.$member["id"].'"/>
              <input  name="dir" type="hidden" value="0"/>
              <button name="dir" value="0" class="btn btn-danger"></button>
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
}
//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function showBannedUser(){
  require_once (CONF);
  $query=$bdd->prepare("SELECT id, email, last_name, first_name, birthday, gender, isAdmin, isBanned FROM USERS WHERE isBanned = 1");
  $query->execute();

  $result = $query->fetchAll();

  foreach($result as $member){
    echo'
    <tr>
    <td>'.$member["email"].'</td>
    <td>'.$member["last_name"].'</td>
    <td>'.$member["last_name"].'</td>
    <td>'.$member["birthday"].'</td>
    <td>'.$member["gender"].'</td>
    ';
    if ($member["isAdmin"] == 1){
    echo '
    <td>
      <form method="POST" action="admin.php">
        <input  name="id" type="hidden" value="'.$member["id"].'"/>
        <button name="admin" value="1" class="btn btn-success"></button>
      </form>
    </td>';
    }
    else {
      echo '
      <td>
        <form method="POST" action="admin.php">
          <input  name="id" type="hidden" value="'.$member["id"].'"/>
          <button name="admin" value="0" class="btn btn-danger"></button>
        </form>
      </td>';
    }

    echo'
    <td>
      <form method="GET" action="unban.php">
        <input  name="id" type="hidden" value="'.$member["id"].'"/>
        <button type="submit" class="btn btn-danger">
          <span class=""></span>
        </button>
      </form>
    </td>
  </tr>
  ';
  }
}
//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function ban($id){
  require_once (CONF);
  $query = $bdd->prepare("UPDATE USERS SET isBanned = 1 WHERE id =:id");
  $query->execute(["id"=>$id]);
}
//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function unban($id){
  require_once (CONF);
  $query = $bdd->prepare("UPDATE USERS SET isBanned = 0 WHERE id = :id");
  $query->execute(["id"=>$id]);
}
//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function edit($id, $email, $first_name, $last_name, $birthday, $gender){
  require_once (CONF);
  $query = $bdd->prepare("UPDATE USERS SET email = :email, first_name = :first_name, last_name = :last_name, birthday = :birthday, gender = :gender WHERE id = :id");
  $query->execute([
                  "id"=>$id,
                  "email"=>$email,
                  "first_name"=>$first_name,
                  "last_name"=>$last_name,
                  "birthday"=>$birthday,
                  "gender"=>$gender
                  ]);
}
//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function admin($id, $admin){
  require_once (CONF);
  if($admin == 0){
    $query = $bdd->prepare("UPDATE USERS SET isAdmin = 1 WHERE id =:id");
    $query->execute(["id"=>$id]);

  }elseif($admin == 1){
    $query = $bdd->prepare("UPDATE USERS SET isAdmin = 0 WHERE id =:id");
    $query->execute(["id"=>$id]);
  }
}
//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function collab($id, $collab){
  require_once (CONF);
  if($collab == 0){
    $query = $bdd->prepare("UPDATE USERS SET isCollaborateur = 1 WHERE id =:id");
    $query->execute(["id"=>$id]);

  }elseif($collab == 1){
    $query = $bdd->prepare("UPDATE USERS SET isCollaborateur = 0 WHERE id =:id");
    $query->execute(["id"=>$id]);
  }
}
//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------
function dirrec($id, $dir){
  require_once (CONF);
  if($dir == 0){
    $query = $bdd->prepare("UPDATE USERS SET isDirecteur = 1 WHERE id =:id");
    $query->execute(["id"=>$id]);

  }elseif($dir == 1){
    $query = $bdd->prepare("UPDATE USERS SET isDirecteur = 0 WHERE id =:id");
    $query->execute(["id"=>$id]);
  }
}
//---------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------

 ?>
