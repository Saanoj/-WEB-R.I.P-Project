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

    public function __construct($idRestaurant,$nomRestaurant,$prixMoyen,$horrairesDebut,$horrairesFin) {
        $this->idRestaurant = $idRestaurant;
        $this->nomRestaurant = $nomRestaurant;
        $this->prixMoyen = $prixMoyen;
        $this->horrairesDebut = $horrairesDebut;
        $this->horrairesFin = $horrairesFin;

    }



    /* GETTERS */
    public function getIdRestaurant() {return $this->idRestaurant;}
    public function getNomRestaurant() {return $this->nomRestaurant;}
    public function getPrixMoyenRestaurant() {return $this->prixMoyen;}
    public function getHorrairesDebutRestaurant() {return $this->horrairesDebut;}
    public function getHorrairesFinRestaurant() {return $this->horrairesFin;}

    /* SETTERS */
    public function setIdRestaurant($newIdRestaurant) {return $this->idRestaurant = $newIdRestaurant;}
    public function setNomRestaurant($newNomRestaurant) {return $this->nomRestaurant = $newNomRestaurant;}
    public function setPrixMoyenRestaurant($newPrixMoyenRestaurant) {return $this->prixMoyen = $newPrixMoyenRestaurant;}
    public function setHorrairesDebutRestaurant($newHorrairesDebutRestaurant) {return $this->horrairesDebut = $newHorrairesDebutRestaurant;}
    public function setHorrairesFinRestaurant($newHorrairesFinRestaurant) {return $this->horrairesFin = $newHorrairesFinRestaurant;}

    // METHODES

    public static function createRestaurant($idRestaurant,$nomRestaurant,$prixMoyen,$horrairesDebut,$horrairesFin) {
        return $resto = new Restaurant($idRestaurant,$nomRestaurant,$prixMoyen,$horrairesDebut,$horrairesFin);
    }
}
