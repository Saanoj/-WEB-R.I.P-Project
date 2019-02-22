<?php
namespace App;
use \PDO;




//require 'Autoloader.php';
//Autoloader::register();
$bdd = new Database('rip');

 class Trajet {
    private $start;
    private $end;
    private $price;
    private $idClient;
    private $dateTrajet;

    public function __construct($start,$end,$price,$idClient,$dateTrajet) {
        $this->start = $start;
        $this->end = $end;
        $this->price = $price;
        $this->idClient = $idClient;
        $this->dateTrajet = $dateTrajet;

    }



    /* GETTERS */
    public function getStart() {return $this->start;}
    public function getEnd() {return $this->end;}
    public function getPrice() {return $this->price;}
    public function getIdClient() {return $this->idClient;}
    public function getDateTrajet() {return $this->dateTrajet;}

    /* SETTERS */
    public function setStart($newIdAbonnement) {return $this->idAbonnement = $newIdAbonnement;}
    public function setEnd($newIdClient) {return $this->idClient = $newIdClient;}
    public function setPrice($newDateDebut) {return $this->dateDebut = $newDateDebut;}
    public function setIdClient($newIdClient) {return $this->idClient = $newIdClient;}
    public function setDateTrajet($newDateTrajet) {return $this->dateTrajet = $newDateTrajet;}




    /* FONCTIONS */
/*
    public function updateBdd($bdd,$) {
        $req = $bdd->getPDO()->prepare('UPDATE ')
    }
    */

    public function addTrajetStart($bdd,$statement,$trajet) {

      $req1 = $bdd->getPDO()->prepare($statement);
      $req1->bindValue(':idClient', $trajet->getIdClient());
      $req1->bindValue(':debut', $trajet->getStart());
      $req1->bindValue(':fin', $trajet->getEnd());
      $req1->bindValue(':prixTrajet', $trajet->getPrice());

      //TERMINER CETTE PARTIE!!! valeurs mauvaisess
      $req1->bindValue(':heureDebut', date('Y-m-d G:i:s'));
      $req1->bindValue(':heureFin', date('Y-m-d G:i:s'));
      $req1->bindValue(':dateTrajet', $trajet->getDateTrajet());
      $req1->bindValue(':distanceTrajet', 12);

      $req1->execute();
    }

    public function startSessionId($bdd) {
      $req = $bdd->getPDO()->prepare('SELECT * FROM trajet WHERE idClient = :idClient AND dateTrajet = :dateTrajet');
      $req->bindValue(':idClient', $this->getIdClient());
      $req->bindValue(':dateTrajet', $this->getDateTrajet());
      $req->execute();
      while	($donnees	=	$req->fetch())
      {
        $_SESSION['idTrajet'] =	$donnees['idTrajet'];
      }
      $_SESSION['startTrajet']=$this->getStart();
      $_SESSION['endTrajet']=$this->getEnd();
    }
  }














?>
