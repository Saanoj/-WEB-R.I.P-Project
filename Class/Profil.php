<?php
namespace App;
use \PDO;


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
    public function getAddress(){return $this->address;}
      public function getZipCode(){return $this->zip_code;}

    /* SETTERS */
    public function setFirst_name($newFirst_name) {return $this->first_name = $newFirst_name;}
    public function setLast_name($newLast_name) {return $this->last_name = $newLast_name;}
    public function setBirthday($newBirthday) {return $this->birthday = $newBirthday;}
    public function setGender($newGender) {return $this->gender = $newGender;}
    public function setAddress($newAddress) {return $this->address = $newAddress;}
    public function setZipCode($newZipCode) {return $this->zip_code = $newZipCode;}




    /* FONCTIONS */
/*
    public function updateBdd($bdd,$) {
        $req = $bdd->getPDO()->prepare('UPDATE ')
    }
    */



 }
?>
