<?php
namespace App;
use \PDO;
<<<<<<< HEAD
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>Profil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/profil/style.css" rel="stylesheet">
    <style type="text/css">
    </style>

    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/profil/profil.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

</head>
<body>


  <?php
  include '../includehtml/head.html';
 // include '../navbar/chooseNav.php';

  require 'Autoloader.php';
 Autoloader::register();
 $bdd = new Database('rip');

 // REQUETE POUR RECUPER LES INFOS DU USER
 $req = $bdd->getPDO()->prepare('SELECT * FROM users WHERE id = ?');
 $req->execute(array($_SESSION['id']));
 $datas = $req->fetch();
=======
>>>>>>> 19a4c9c59f18d9222c6b1cbfaaf371f9592451ec


 class Profil {
    private $first_name;
    private $last_name;
    private $birthday;
    private $gender;
    private $address;
    private $zip_code;

    public function __construct($first_name,$last_name,$birthday,$gender,$address,$zip_code) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->birthday = $birthday;
        $this->gender = $gender;
        $this->address = $address;
        $this->zip_code = $zip_code;

    }



    /* GETTERS */
    public function getFirst_name() {return $this->first_name;}
    public function getLast_name() {return $this->last_name;}
    public function getBirthday() {return $this->birthday;}
    public function getGender() {return $this->gender;}
    public function getAddress() {return $this->address;}
    public function getZipCode() {return $this->zip_code;}


    /* SETTERS */
    public function setFirst_name($newFirst_name) {return $this->first_name = $newFirst_name;}
    public function setLast_name($newLast_name) {return $this->last_name = $newLast_name;}
    public function setBirthday($newBirthday) {return $this->birthday = $newBirthday;}
    public function setGender($newGender) {return $this->gender = $newGender;}
    public function setAddress($newAddress) {return $this->address = $address;}
    public function setZipCode($newZipCode) {return $this->zip_code = $newZipCode;}



    /* FONCTIONS */
/*
    public function updateBdd($bdd,$) {
        $req = $bdd->getPDO()->prepare('UPDATE ')
    }
    */



 }
<<<<<<< HEAD

 $user = new Profil($datas['first_name'],$datas['last_name'],$datas['birthday'],$datas['gender'],$datas['address'],$datas['zip_code']);

 ?>

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5 id="mailA" value="<?php echo $_SESSION['email']; ?>">
                                        <?php echo $_SESSION['email']; ?>
                                    </h5>

                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mes informations</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mes abonnements</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">

                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Id</label>
                                            </div>
                                            <div class="col-md-6">
                                            <span id="idProfil" class="datainfo" value="'<?= $_SESSION['id']?>'"><?= $_SESSION['id'] ?></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nom</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="gear">
                                            <span id="last_name" class="datainfo"><?= $user->getLast_name(); ?></span>
                                            <a href="#" class="editlink">Editer</a>
                                            <a class="savebtn">Sauvegarder</a>
                                        </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Prenom</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="gear">
                                            <span id="first_name" class="datainfo"><?= $user->getFirst_name(); ?></span>
                                            <a href="#" class="editlink">Editer</a>
                                            <a class="savebtn" >Sauvegarder</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Date de naissance</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="gear">



                                            <span id="birthday" class="datainfo"><?php
                                            setlocale(LC_TIME, "fr_FR","French");
                                            $date = strftime("%d %B %Y", strtotime($user->getBirthday()));
                                            echo  $date; ?></span>
                                            <a href="#" class="editlink">Editer</a>
                                            <a class="savebtn" >Sauvegarder</a>
</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Genre</label>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="gear">
                                            <span id="gender" class="datainfo"><?= $user->getGender(); ?></span>
                                            <a href="#" class="editlink">Editer</a>
                                            <a class="savebtn">Sauvegarder</a>
                                            </div>
                                            </div>
                                            </div>
                                           </div>

                                            <div class="row">
                                            <div class="col-md-6">
                                                <label>Adresse</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="gear">
                                            <span id="address" class="datainfo"><?= $user->getAddress(); ?></span>
                                            <a href="#" class="editlink">Editer</a>
                                            <a class="savebtn">Sauvegarder</a>
                                        </div>
                                            </div>
                                        </div>


                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            </div>
                                            <div class="col-md-6">
                                            </div>
                                        </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
<script type="text/javascript">


</script>

</body>
</html>
=======
?>
>>>>>>> 19a4c9c59f18d9222c6b1cbfaaf371f9592451ec
