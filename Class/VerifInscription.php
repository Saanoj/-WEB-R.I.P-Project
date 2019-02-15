<?php
namespace App;
use \PDO;


require 'Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');

if  (
    htmlspecialchars(isset($_POST['email'])) &&
    htmlspecialchars(isset($_POST['password'])) &&
    htmlspecialchars(isset($_POST['firstName'])) &&
    htmlspecialchars(isset($_POST['lastName'])) &&
    htmlspecialchars(isset($_POST['birthday'])) &&
    htmlspecialchars(isset($_POST['gender'])) &&
    htmlspecialchars(isset($_POST['confirmPassword'])) &&
    htmlspecialchars(!empty($_POST['email'])) &&
    htmlspecialchars(!empty($_POST['password'])) &&
    htmlspecialchars(!empty($_POST['firstName'])) &&
    htmlspecialchars(!empty($_POST['lastName'])) &&
    htmlspecialchars(!empty($_POST['birthday'])) &&
    htmlspecialchars(!empty($_POST['gender'])) &&
    htmlspecialchars(!empty($_POST['confirmPassword'])) 
  
    )
    {


        class Membre {
            private $id;
            private $email;
            private $password;
            private $first_name;
            private $last_name;
            private $birthday;
            private $gender;
            private $password_confirm;

            public function __construct($email,$password,$first_name,$last_name,$birthday,$gender,$password_confirm) {
                $this->email  = $email;
                $this->password = $password;
                $this->first_name = $first_name;
                $this->last_name = $last_name;
                $this->birthday = $birthday;
                $this->gender = $gender;
                $this->password_confirm = $password_confirm;

            }

            /* Getters */

            public function getId() {return $this->id;}
            public function getEmail() {return $this->email;}
            public function getPassword() {return $this->password;}
            public function getFirst_name() {return $this->first_name;}
            public function getLast_name() {return $this->last_name;}
            public function getBirthday() {return $this->birthday;}
            public function getGender() {return $this->gender;}
            public function getPassword_confirm() {return $this->password_confirm;}


            /* Setters */
            public function setId($newId) {return $this->id = $newId;}
            public function setEmail($newEmail) {return $this->email = $newEmail;}
            public function setPassword($newPassword) {return $this->password = $newPassword;}
            public function setFirst_name($newFirst_name) {return $this->first_name = $newFirst_name;}
            public function setLast_name($newLast_name) {return $this->last_name = $newLast_name;}
            public function setBirthday($newBirthday) {return $this->birthday = $newBirthday;}
            public function setGender($newGender) {return $this->gender = $newGender;}
            public function setPassword_confirm($newPassword_confirm) {return $this->password_confirm = $newPassword_confirm;}
                        
            
        public function checkUserExist($bdd,$statement,$user) {
            $check = $bdd->getPDO()->prepare($statement);
			$check->execute(array( 

                 'email' => $user->getEmail()
            ));
            return $check->rowCount();
        }

            public function addUser($bdd,$statement,$user) {
             

            $req1 = $bdd->getPDO()->prepare($statement);
            $req1->bindValue(':email', $user->getEmail());
            $req1->bindValue(':password',password_hash($user->getPassword(),PASSWORD_DEFAULT));
            $req1->bindValue(':password_confirm',$user->getPassword_confirm());
            $req1->bindValue(':last_name',$user->getLast_name());
            $req1->bindValue(':birthday', $user->getBirthday());
            $req1->bindValue(':gender',$user->getGender());
            $req1->bindValue(':first_name',$user->getFirst_name());
            $req1->execute();
        }  
        public function startSession($bdd,$statement) {
            session_start();
            $req = $bdd->getPDO()->prepare($statement);
            $req->bindValue(':email', $this->getEmail());
            $req->execute();
            while	($donnees	=	$req->fetch())
            {	
             $_SESSION['id'] =	$donnees['id'];
            }	
        }
    }

    $user = new Membre($_POST['email'],$_POST['password'],$_POST['firstName'],$_POST['lastName'],$_POST['birthday'],$_POST['gender'],$_POST['confirmPassword']);

    $req = $user->checkUserExist($bdd,'SELECT email FROM users WHERE email=:email',$user);
   if ($req === 0) 
   {
    $req2 = $user->addUser($bdd,'INSERT INTO `users` (`email`, `password`, `password_confirm`, `last_name`, `birthday`, `gender`, `first_name`) VALUES (:email,:password,:password_confirm,:last_name,:birthday,:gender,:first_name);',$user);
    $user->startSession($bdd,'SELECT id FROM users WHERE email = :email');
   }
   else
   {
       header('location:../inscription.php?Mail_deja_utilisé');
   }

    }
    else
    {
            echo 'Informations inexactes';
    }   

?>