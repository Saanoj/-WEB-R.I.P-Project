<?php

namespace App;
use \PDO;

require 'Autoloader.php';
Autoloader::register();





if  (
    htmlspecialchars(isset($_POST['email'])) &&
    htmlspecialchars(isset($_POST['password'])) &&
    htmlspecialchars(!empty($_POST['email'])) &&
    htmlspecialchars(!empty($_POST['password']))
    )
    {

        class VerifInscription {
            private $email;
            private $password;

            public function __construct($email,$password) {
                $this->email  = $email;
                $this->password = $password;

            }

        }
    }

?>