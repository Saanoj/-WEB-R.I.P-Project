<?php

namespace App;

use \PDO;

class VerifInscription {
    private $login;
    private $password;
    public function __construct($login,$password) {
        $this->login  = $login;
        $this->password = $password;

    }

}

?>