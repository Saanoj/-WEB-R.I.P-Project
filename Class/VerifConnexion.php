<?php
namespace App;
use \PDO;


require 'Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');


if  (
    htmlspecialchars(isset($_POST['email'])) &&
    htmlspecialchars(isset($_POST['password']))
    )
    {


        class VerifConnexion {
            private $email;
            private $password;


            public function __construct($email,$password){
                $this->email  = $email;
                $this->password = $password;


            }

            /* Getters */

            public function getEmail() {return $this->email;}
            public function getPassword() {return $this->password;}


            /* Setters */
            public function setEmail($newEmail) {return $this->email = $newEmail;}
            public function setPassword($newPassword) {return $this->password = $newPassword;}



            public function getHashPassword($bdd,$statement) {
                $val = null;

                $req = $bdd->getPDO()->prepare($statement);
                $req->bindValue(':email', $this->getEmail());
                $req->execute();

           $req->closeCursor();

           return $val;


            }

            public function createCookie()
            {
                if (isset($_POST['remember']))
                {
                  setcookie('email',$this->getEmail(),time()+365*24*3600,null,null,false,true);
                  setcookie('password',$this->getPassword(),time()+365*24*3600,null,null,false,true);
                  setcookie('id',$_SESSION['id'],time()+365*24*3600,null,null,false,true);
                }
            }
            public function chiffrerPassword() {
                $salage='SuP4rS4aL4g3';
                return hash('md5',$salage.$this->password);

            }



        public function checkBdd($bdd,$statement) {
            $req = $bdd->getPDO()->prepare($statement);
            $req->bindValue(':email', $this->getEmail());
            $req->execute();
            $data=$req->fetch();
            $req->closeCursor();
            if ($this->chiffrerPassword($this->getPassword()) == $data['password'])
            {
            if ( $data['isBanned'] == 0 )
	       {
            session_start();
            $_SESSION['id'] = $data['id'];
            $_SESSION['email'] = $this->getEmail();
            header('location:../index.php?id='.$_SESSION['id'].'');
           }
           else
           {
            echo '<h4 class = "text-center">Vous avez été banni</h4> <br>
            <li class="nav-item text-center">
              <a class="nav-link" href="../connexion.php">
                <i class="fa d-inline fa-lg fa-arrow-circle-left "></i> retour</a>
            </li> ';
           }
        }
           else {

            echo '<h4 class = "text-center">mauvais mot de passe ou pseudo</h4> <br>
            <li class="nav-item text-center">
              <a class="nav-link" href="../connexion.php">
                <i class="fa d-inline fa-lg fa-arrow-circle-left "></i> retour</a>
            </li> ';

           }
            }

        }



        $user = new VerifConnexion($_POST['email'],$_POST['password']);

         $req = $user->checkBdd($bdd,'SELECT id,password, isBanned FROM users WHERE email = :email');
        $user->createCookie();






    }


?>
