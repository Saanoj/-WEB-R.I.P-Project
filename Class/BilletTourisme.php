<?php
namespace App;
use \PDO;




//require 'Autoloader.php';
//Autoloader::register();
$bdd = new Database('rip');

 class BilletTourisme {
    private $idBillet;
    private $nomBillet;
    private $isValide;
    private $villeBillet;
    private $prixBillet;


    public function __construct($idBillet,$nomBillet,$isValide,$villeBillet,$prixBillet) {
        $this->idBillet = $idBillet;
        $this->nomBillet = $nomBillet;
        $this->isValide = $isValide;
        $this->villeBillet = $villeBillet;
        $this->villeBillet = $prixBillet;

        

    }



    /* GETTERS */
    public function getIdBillet() {return $this->idBillet;}
    public function getNomBillet() {return $this->nomBillet;}
    public function getIsValide() {return $this->isValide;}
    public function getVilleBillet() {return $this->villeBillet;}
    public function getPrixBillet() {return $this->prixBillet;}
 

    /* SETTERS */
    public function setIdBillet($newIdBillet) {return $this->idBillet = $newIdBillet;}
    public function setNomBillet($newNomBillet) {return $this->nomBillet = $nomBillet;}
    public function setIsValide($newIsValide) {return $this->newIsValide = $newIsValide;}
    public function setVilleBillet($newVilleBillet) {return $this->newVilleBillet = $newVilleBillet;}
    public function setPrixBillet($newPrixBillet) {return $this->newPrixBillet = $newPrixBillet;}

    // METHODES
    public static function createBilletTourisme($idBillet,$nomBillet,$isValide,$villeBillet,$prixBillet) {
        return $billet = new BilletTourisme($idBillet,$nomBillet,$isValide,$villeBillet,$prixBillet);
    }

    public static function querySelect($bdd,$statement) {
        $hotels = $bdd->getPDO()->prepare($statement);
        $hotels->execute();
        return $datas = $hotels->fetch();
    }
}
