<?php
namespace App;
use \PDO;
?>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<?php

require_once __DIR__ .'/require_class.php';

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
            $_SESSION['isCollaborateur']=$data["isCollaborateur"];
            $this->addUserToSession($data["id"],$bdd);

            header('location:index.php?id='.$_SESSION['id'].'');
           }
           else
           {
            ?><div class="alert alert-danger" role="alert">
            Vous avez été banni ! Veuillez contacter le support afin d'avoir plus d'informations.
              </div> <?php
              header ('Refresh: 3;URL=connexion.php');

           }
        }
           else {

            ?><div class="alert alert-danger" role="alert">
            Mauvais identifiant ! Veuillez vous reconnecter.
              </div> <?php
              header ('Refresh: 3;URL=connexion.php');

           }
            }

            public function addUserToSession($id,$bdd){
              $req = $bdd->getPDO()->prepare('SELECT * FROM users WHERE id = ?');
              $req->execute(array($_SESSION['id']));
              $datas = $req->fetch();
              $req->closeCursor();
              $user = new Profil($datas['first_name'],$datas['last_name'],$datas['birthday'],$datas['gender'],$datas['address'],$datas['zip_code']);
              $_SESSION["user"] = serialize($user);
            }

        }



        $user = new VerifConnexion($_POST['email'],$_POST['password']);

        $req = $user->checkBdd($bdd,'SELECT * FROM users WHERE email = :email');
        $user->createCookie();






    }


?>
