<?php
namespace App;
use \PDO;

require 'Autoloader.php';
Autoloader::register();
$bdd = new Database('rip');

if  (
    htmlspecialchars(isset($_POST['email'])) &&
    htmlspecialchars(isset($_POST['password'])) &&
    htmlspecialchars(!empty($_POST['email'])) &&
    htmlspecialchars(!empty($_POST['password'])) 
    )
    {


        class MembreConnet {
            private $email;
            private $password;

            public function __construct($email,$password) {
                $this->email  = $email;
                $this->password = $password;
            }

            /* Getters */

            public function getEmail() {return $this->email;}
            public function getPassword() {return $this->password;}
 
            /* Setters */

            public function setEmail($newEmail) {return $this->email = $newEmail;}
            public function setPassword($newPassword) {return $this->password = $newPassword;}  
            
            public function checkPasswordHash($bdd,$statement)
            {
                
            }
        }
        $user = new MembreConnect($_POST['email'],$_POST['password']);
        var_dump($user);



    }

      

?>