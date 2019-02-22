<?php
namespace App;
use \PDO;




//require 'Autoloader.php';
//Autoloader::register();
$bdd = new Database('rip');

 class Abonnement {
    private $idAbonnement;
    private $idClient;
    private $dateDebut;
    private $dateFin;
    private $typeAbonnement;
    private $isEngagement;

    public function __construct($idAbonnement,$idClient,$dateDebut,$dateFin,$typeAbonnement,$isEngagement) {
        $this->idAbonnement = $idAbonnement;
        $this->idClient = $idClient;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->typeAbonnement = $typeAbonnement;
        $this->isEngagement = $isEngagement;

    }



    /* GETTERS */
    public function getIdAbonnement() {return $this->idAbonnement;}
    public function getIdClient() {return $this->idClient;}
    public function getDateDebut() {return $this->dateDebut;}
    public function getDateFin() {return $this->dateFin;}
    public function getTypeAbonnement(){return $this->typeAbonnement;}
    public function getIsEngagement(){return $this->isEngagement;}

    /* SETTERS */
    public function setIdAbonnement($newIdAbonnement) {return $this->idAbonnement = $newIdAbonnement;}
    public function setIdClient($newIdClient) {return $this->idClient = $newIdClient;}
    public function setDateDebut($newDateDebut) {return $this->dateDebut = $newDateDebut;}
    public function setDateFin($newDateFin) {return $this->dateFin = $newDateFin;}
    public function setTypeAbonnement($newTypeAbonnement) {return $this->typeAbonnement = $newTypeAbonnement;}
    public function setIsEngagement($newIsEngagement) {return $this->isEngagement = $newIsEngagement;}




    /* FONCTIONS */
/*
    public function updateBdd($bdd,$) {
        $req = $bdd->getPDO()->prepare('UPDATE ')
    }
    */

    public static function createAbonnement($bdd) {
        $dataAbonnement = Abonnement::getAll($bdd);
        return $abo = new Abonnement($dataAbonnement['idAbonnement'],$dataAbonnement['idClient'],$dataAbonnement['dateDebut'],$dataAbonnement['dateFin'],$dataAbonnement['typeAbonnement'],$dataAbonnement['isEngagement']);
        
    }

    public static function getAll($bdd) {
        $statement = 'SELECT * FROM abonnement WHERE idClient = ?';
        $reqAbo = $bdd->getPDO()->prepare($statement);
        $reqAbo->execute(array($_SESSION['id']));
        $dataAbonnement = $reqAbo->fetch();
         return $dataAbonnement;

    }
}

  

    

    

  





 
?>
