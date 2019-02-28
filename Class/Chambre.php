<?php
namespace App;
use \PDO;




//require 'Autoloader.php';
//Autoloader::register();
$bdd = new Database('rip');

 class Chambre {
    private $idChambre;
    private $typeChambre;
    private $idHotel;
    private $litsDispo;
    private $isDispo;


    public function __construct($idChambre,$typeChambre,$idHotel,$litsDispo,$isDispo) {
        $this->idChambre = $idChambre;
        $this->typeChambre = $typeChambre;
        $this->idHotel = $idHotel;
        $this->litsDispo = $litsDispo;
        $this->isDispo = $isDispo;
        

    }



    /* GETTERS */
    public function getIdChambre() {return $this->idChambre;}
    public function getTypeChambre() {return $this->typeChambre;}
    public function getIdHotel() {return $this->idHotel;}
    public function getLitsDispo() {return $this->litsDispo;}
    public function getIsDispo() {return $this->isDispo;}
 

    /* SETTERS */
    public function setIdChambre($newIdChambre) {return $this->newIdChambre = $newIdChambre;}
    public function setTypeChambre($newTypeChambre) {return $this->newTypeChambre = $newTypeChambre;}
    public function setLitsDispo($newLitsDispo) {return $this->newLitsDispo = $newLitsDispo;}
    public function setIsDispo($newIsDispo) {return $this->newIsDispo = $newIsDispo;}


    // METHODES
    public static function createChambre($idChambre,$typeChambre,$idHotel,$litsDispo,$isDispo) {
        return $chambre = new Chambre($idChambre,$typeChambre,$idHotel,$litsDispo,$isDispo);
    }

    public static function querySelect($bdd,$statement) {
        $hotels = $bdd->getPDO()->prepare($statement);
        $hotels->execute();
        return $datas = $hotels->fetch();
    }
}
