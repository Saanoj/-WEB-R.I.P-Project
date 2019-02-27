<?php
namespace App;
use \PDO;




//require 'Autoloader.php';
//Autoloader::register();
$bdd = new Database('rip');

 class Service {
    private $idService;
    private $nomService;
    private $description;
    private $prixService;
    private $categorie;

    public function __construct($idService,$nomService,$description,$prixService,$categorie) {
        $this->idService = $idService;
        $this->nomService = $nomService;
        $this->description = $description;
        $this->prixService = $prixService;
        $this->categorie = $categorie;

    }



    /* GETTERS */
    public function getIdService() {return $this->idService;}
    public function getNomService() {return $this->nomService;}
    public function getDescription() {return $this->description;}
    public function getPrixService() {return $this->prixService;}
    public function getCategorieService() {return $this->categorie;}

    /* SETTERS */
    public function setIdService($newIdService) {return $this->idService = $newIdService;}
    public function setNomService($newNomService) {return $this->nomService = $newNomService;}
    public function setDescription($newDescription) {return $this->description = $newDescription;}
    public function setPrixService($newPrixService) {return $this->prixService = $newPrixService;}
    public function setCategorieService($newCategorie) {return $this->categorie = $newCategorie;}




    /* FONCTIONS */
/*
    public function updateBdd($bdd,$) {
        $req = $bdd->getPDO()->prepare('UPDATE ')
    }
    */

    public function linkServicetrajet($bdd,$statement,$trajet) {

      $req1 = $bdd->getPDO()->prepare($statement);
      $req1->bindValue(':idClient', $trajet->getIdClient());
      $req1->bindValue(':idService', $trajet->getStart());

      $req1->execute();
    }
}














?>
