<?php
namespace App;
use \PDO;




//require 'Autoloader.php';
//Autoloader::register();
$bdd = new Database('rip');

 class Restaurant {
    private $idRestaurant;
    private $nomRestaurant;
    private $prixMoyen;
    private $horrairesDebut;
    private $horrairesFin;
    private $adresseRestaurant;
    private $villeRestaurant;
    private $placeDispo;

    public function __construct($idRestaurant,$nomRestaurant,$prixMoyen,$horrairesDebut,$horrairesFin,$adresseRestaurant, $villeRestaurant,$placeDispo) {
        $this->idRestaurant = $idRestaurant;
        $this->nomRestaurant = $nomRestaurant;
        $this->prixMoyen = $prixMoyen;
        $this->horrairesDebut = $horrairesDebut;
        $this->horrairesFin = $horrairesFin;
        $this->adresseRestaurant = $adresseRestaurant;
        $this->villeRestaurant = $villeRestaurant;
        $this->placeDispo = $placeDispo;


    }



    /* GETTERS */
    public function getIdRestaurant() {return $this->idRestaurant;}
    public function getNomRestaurant() {return $this->nomRestaurant;}
    public function getPrixMoyenRestaurant() {return $this->prixMoyen;}
    public function getHorrairesDebutRestaurant() {return $this->horrairesDebut;}
    public function getHorrairesFinRestaurant() {return $this->horrairesFin;}
    public function getAdresseRestaurant() {return $this->adresseRestaurant;}
    public function getVilleRestaurant() {return $this->villeRestaurant;}
    public function getPlaceDispoRestaurant() {return $this->placeDispo;}

    /* SETTERS */
    public function setIdRestaurant($newIdRestaurant) {return $this->idRestaurant = $newIdRestaurant;}
    public function setNomRestaurant($newNomRestaurant) {return $this->nomRestaurant = $newNomRestaurant;}
    public function setPrixMoyenRestaurant($newPrixMoyenRestaurant) {return $this->prixMoyen = $newPrixMoyenRestaurant;}
    public function setHorrairesDebutRestaurant($newHorrairesDebutRestaurant) {return $this->horrairesDebut = $newHorrairesDebutRestaurant;}
    public function setHorrairesFinRestaurant($newHorrairesFinRestaurant) {return $this->horrairesFin = $newHorrairesFinRestaurant;}
    public function setAdresseRestaurant($newAdresseRestaurant) {return $this->adresseRestaurant = $newAdresseRestaurant;}
    public function setVilleRestaurant($newVilleRestaurant) {return $this->villeRestaurant = $newVilleRestaurant;}
    public function setPlaceDispoRestaurant($newPlaceDispo) {return $this->placeDispo = $newPlaceDispo;}

    // METHODES

    public static function createRestaurant($idRestaurant,$nomRestaurant,$prixMoyen,$horrairesDebut,$horrairesFin,$newAdresseRestaurant,$newVilleRestaurant,$placeDispo) {
        return $resto = new Restaurant($idRestaurant,$nomRestaurant,$prixMoyen,$horrairesDebut,$horrairesFin,$newAdresseRestaurant,$newVilleRestaurant,$placeDispo);
    }

    public static function querySelect($bdd,$statement) {
        $restaurants = $bdd->getPDO()->prepare($statement);
        $restaurants->execute();
        return $datas = $restaurants->fetch();
    }
}
