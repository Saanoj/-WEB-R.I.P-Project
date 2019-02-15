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
                while	($donnees	=	$req->fetch()){	
                    $val	= $donnees['password'];
           }	
           $req->closeCursor();

           return $val;


            }




                       public function checkBdd($bdd,$statement,$hash_password) {
                        
              
            $req = $bdd->getPDO()->prepare($statement);
            $req->bindValue(':email', $this->getEmail());
            $req->bindValue(':password',$hash_password);
            $req->execute();
            $userexist = $req->RowCount();
            var_dump($userexist);
            if ($userexist == 1)
             {
                $userinfos = $req->fetch();
                $_SESSION['email'] = $this->getEmail();
                header('location:../index.php?id='.$_SESSION['email'].'');
            }
            
        }
    }
        

        $user = new VerifConnexion($_POST['email'],$_POST['password']);
        var_dump(password_verify($user->getPassword(),$req = $user->getHashPassword($bdd,'SELECT password FROM users WHERE email = :email')));
        if (password_verify($user->getPassword(),$req = $user->getHashPassword($bdd,'SELECT password FROM users WHERE email = :email')) == 1);
        {
        $hash_password = $user->getHashPassword($bdd,'SELECT password FROM users WHERE email = :email');
         $req2 = $user->checkBdd($bdd,'SELECT * FROM users WHERE email = :email AND password = :password',$hash_password);
        var_dump($hash_password);
        }

     
        

              
    }
 

?>