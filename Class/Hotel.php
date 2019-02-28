<?php
namespace App;
use \PDO;




//require 'Autoloader.php';
//Autoloader::register();
$bdd = new Database('rip');

 class Hotel {
    private $idHotel;
    private $nomHotel;
    private $adresseHotel;
    private $prixHotel;


    public function __construct($idHotel,$nomHotel,$adresseHotel,$prixHotel) {
        $this->idHotel = $idHotel;
        $this->nomHotel = $nomHotel;
        $this->adresseHotel = $adresseHotel;
        $this->prixHotel = $prixHotel;
        

    }



    /* GETTERS */
    public function getIdHotel() {return $this->idHotel;}
    public function getNomHotel() {return $this->nomHotel;}
    public function getAdresseHotel() {return $this->adresseHotel;}
    public function getPrixHotel() {return $this->prixHotel;}
 

    /* SETTERS */
    public function setIdHotel($newIdHotel) {return $this->idHotel = $idHotel;}
    public function setNomHotel($newNomHotel) {return $this->nomHotel = $nomHotel;}
    public function setAdresseHotel($newadresseHotel) {return $this->adresseHotel = $adresseHotel;}
    public function setPrixHotel($newPrixHotel) {return $this->prixHotel = $prixHotel;}


    // METHODES
    public static function createHotel($idHotel,$nomHotel,$adresseHotel,$prixHotel) {
        return $hotel = new Hotel($idHotel,$nomHotel,$adresseHotel,$prixHotel);
    }

    public static function querySelect($bdd,$statement) {
        $hotels = $bdd->getPDO()->prepare($statement);
        $hotels->execute();
        return $datas = $hotels->fetch();
    }
}
