<?php
namespace App;
use \PDO;




//require 'Autoloader.php';
//Autoloader::register();
$bdd = new Database('rip');

 class Chauffeur extends Collaborateur{

   protected $carId;
   protected $carBrand;
   protected $carModel;
   protected $carColor;

   public function __construct($idCollaborateur,$email,$last_name,$first_name,$metier,$prixCollaborateur,$dateEmbauche,$ville,$heuresTravailees,$carId,$carBrand,$carModel,$carColor) {

     parent::__construct($idCollaborateur,$email,$last_name,$first_name,$metier,$prixCollaborateur,$dateEmbauche,$ville,$heuresTravailees);

       $this->carId = $carId;
       $this->carBrand = $carBrand;
       $this->carModel = $carModel;
       $this->carColor = $carColor;
   }

    public function getCarId(){return $this->carId;}
    public function getCarBrand(){return $this->carBrand;}
    public function getCarModel(){return $this->carModel;}
    public function getCarColor(){return $this->carColor;}

    public function setCarId($carId){$this->carId = $carId;}
    public function setCarBrand($carBrand){$this->carBrand = $carBrand;}
    public function setCarModel($carModel){$this->carModel = $carModel;}
    public function setCarColor($carColor){$this->carColor = $carColor;}



    /* FONCTIONS */
/*
    public function updateBdd($bdd,$) {
        $req = $bdd->getPDO()->prepare('UPDATE ')
    }
    */

    static public function getCar($idChauffeur,$bdd){
      $car=$bdd->queryOne('SELECT * FROM car WHERE idCollaborateur = '.$idChauffeur.'');
      return $car;
    }



}














?>
