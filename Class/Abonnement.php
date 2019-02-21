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

    public function __construct($idAbonnement,$idClient,$dateDebut,$dateFin,$typeAbonnement) {
        $this->idAbonnement = $idAbonnement;
        $this->idClient = $idClient;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->typeAbonnement = $typeAbonnement;

    }



    /* GETTERS */
    public function getIdAbonnement() {return $this->idAbonnement;}
    public function getIdClient() {return $this->idClient;}
    public function getDateDebut() {return $this->dateDebut;}
    public function getDateFin() {return $this->dateFin;}
    public function getTypeAbonnement(){return $this->typeAbonnement;}

    /* SETTERS */
    public function setIdAbonnement($newIdAbonnement) {return $this->idAbonnement = $newIdAbonnement;}
    public function setIdClient($newIdClient) {return $this->idClient = $newIdClient;}
    public function setDateDebut($newDateDebut) {return $this->dateDebut = $newDateDebut;}
    public function setDateFin($newDateFin) {return $this->dateFin = $newDateFin;}
    public function setTypeAbonnement($newTypeAbonnement) {return $this->typeAbonnement = $newTypeAbonnement;}




    /* FONCTIONS */
/*
    public function updateBdd($bdd,$) {
        $req = $bdd->getPDO()->prepare('UPDATE ')
    }
    */

    public static function createAbonnement($bdd) {
        $dataAbonnement = Abonnement::getAll($bdd);
        return $abo = new Abonnement($dataAbonnement['idAbonnement'],$dataAbonnement['idClient'],$dataAbonnement['dateDebut'],$dataAbonnement['dateFin'],$dataAbonnement['typeAbonnement']);
        
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
