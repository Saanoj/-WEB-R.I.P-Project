<?php
namespace App;
use \PDO;




//require 'Autoloader.php';
//Autoloader::register();
$bdd = new Database('rip');

 class Abonnement {
    private $idAbonnement;
    private $typeAbonnement;
    private $isEngagement;

    public function __construct($idAbonnement,$typeAbonnement,$isEngagement) {
        $this->idAbonnement = $idAbonnement;
        $this->typeAbonnement = $typeAbonnement;
        $this->isEngagement = $isEngagement;

    }



    /* GETTERS */
    public function getIdAbonnement() {return $this->idAbonnement;}
    public function getTypeAbonnement(){return $this->typeAbonnement;}
    public function getIsEngagement(){return $this->isEngagement;}

    /* SETTERS */
    public function setIdAbonnement($newIdAbonnement) {return $this->idAbonnement = $newIdAbonnement;}
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
        return $abo = new Abonnement($dataAbonnement['idAbonnement'],$dataAbonnement['typeAbonnement'],$dataAbonnement['isEngagement']);
        
    }

    public static function getAll($bdd) {
        $statement = 'SELECT * FROM linkabonnemententreprise WHERE idClient = ?';
        $reqAbo = $bdd->getPDO()->prepare($statement);
        $reqAbo->execute(array($_SESSION['id']));
        $reqAbo = $reqAbo->fetch();
        $idAbonnement = $reqAbo['idAbonnement'];
        $statement2 =  'SELECT * FROM linkabonnemententreprise INNER JOIN abonnement ON linkabonnemententreprise.idClient = ? AND linkabonnemententreprise.idAbonnement = abonnement.idAbonnement AND linkabonnemententreprise.idAbonnement = ?';
        $reqAbo2 = $bdd->getPDO()->prepare($statement2);
        $reqAbo2->execute(array($_SESSION['id'],$idAbonnement));
        $dataAbonnement = $reqAbo2->fetch();
         return $dataAbonnement;

    }
}

  

    

    

  





 
?>
