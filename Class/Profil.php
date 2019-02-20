<?php
namespace App;
use \PDO;


 class Profil {
    private $first_name;
    private $last_name;
    private $birthday;
    private $gender;

    public function __construct($first_name,$last_name,$birthday,$gender) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->birthday = $birthday;
        $this->gender = $gender;

    }



    /* GETTERS */
    public function getFirst_name() {return $this->first_name;}
    public function getLast_name() {return $this->last_name;}
    public function getBirthday() {return $this->birthday;}
    public function getGender() {return $this->gender;}

    /* SETTERS */
    public function setFirst_name($newFirst_name) {return $this->first_name = $newFirst_name;}
    public function setLast_name($newLast_name) {return $this->last_name = $newLast_name;}
    public function setBirthday($newBirthday) {return $this->birthday = $newBirthday;}
    public function setGender($newGender) {return $this->gender = $newGender;}

    /* FONCTIONS */
/*
    public function updateBdd($bdd,$) {
        $req = $bdd->getPDO()->prepare('UPDATE ')
    }
    */



 }
?>
