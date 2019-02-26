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
    private $dateReservation;
    private $dateDebut;
    private $heureFin;
    private $distance;
    private $duration;

    public function __construct($start,$end,$price,$idClient,$dateReservation,$dateDebut,$heureFin,$distance,$duration) {
        $this->start = $start;
        $this->end = $end;
        $this->price = $price;
        $this->idClient = $idClient;
        $this->dateReservation = $dateReservation;
        $this->dateDebut = $dateDebut;
        $this->heureFin = $heureFin;
        $this->distance = $distance;
        $this->duration = $duration;

    }



    /* GETTERS */
    public function getStart() {return $this->start;}
    public function getEnd() {return $this->end;}
    public function getPrice() {return $this->price;}
    public function getIdClient() {return $this->idClient;}
    public function getDateReservation() {return $this->dateReservation;}
    public function getDateDebut() {return $this->dateDebut;}
    public function getHeureFin() {return $this->heureFin;}
    public function getDistance() {return $this->distance;}
    public function getDuration() {return $this->duration;}

    /* SETTERS */
    public function setStart($newIdAbonnement) {return $this->idAbonnement = $newIdAbonnement;}
    public function setEnd($newIdClient) {return $this->idClient = $newIdClient;}
    public function setPrice($newDateDebut) {return $this->dateDebut = $newDateDebut;}
    public function setIdClient($newIdClient) {return $this->idClient = $newIdClient;}
    public function setDateReservation($dateReservation) {return $this->dateReservation = $dateReservation;}
    public function setDateDebut($dateDebut) {return $this->dateDebut = $dateDebut;}
    public function setHeureFin($heureFin) {return $this->heureFin = $heureFin;}
    public function setDistance($distance) {return $this->distance = $distance;}
    public function setDuration($duration) {return $this->duration = $duration;}




    /* FONCTIONS */
/*
    public function updateBdd($bdd,$) {
        $req = $bdd->getPDO()->prepare('UPDATE ')
    }
    */
    static public function addDriverToTrajet($bdd,$statement,$idChauffeur) {

      $req1 = $bdd->getPDO()->prepare($statement);
      $req1->bindValue(':idTrajet', $_SESSION["idTrajet"]);
      $req1->bindValue(':idChauffeur', $idChauffeur);

      $req1->execute();
    }

    public function addTrajetStart($bdd,$statement,$trajet) {

      $req1 = $bdd->getPDO()->prepare($statement);
      $req1->bindValue(':idClient', $trajet->getIdClient());
      $req1->bindValue(':debut', $trajet->getStart());
      $req1->bindValue(':fin', $trajet->getEnd());
      $req1->bindValue(':prixTrajet', 0);

      //TERMINER CETTE PARTIE!!! valeurs mauvaisess
      $req1->bindValue(':dateDebut', $trajet->getDateDebut());
      $req1->bindValue(':dateFin', $trajet->getHeureFin());
      $req1->bindValue(':dateReservation', $trajet->getDateReservation());
      $req1->bindValue(':distanceTrajet', intval($trajet->getDistance()));

      $req1->execute();
    }

    public function startSessionId($bdd) {
      $req = $bdd->getPDO()->prepare('SELECT * FROM trajet WHERE idClient = :idClient AND dateResevation = :dateResevation');
      $req->bindValue(':idClient', $this->getIdClient());
      $req->bindValue(':dateResevation', $this->getDateReservation());
      $req->execute();
      while	($donnees	=	$req->fetch())
      {
        $_SESSION['idTrajet'] =	$donnees['idTrajet'];
      }
      $_SESSION['startTrajet']=$this->getStart();
      $_SESSION['endTrajet']=$this->getEnd();
      $_SESSION['startTrajet']=$this->getStart();
      $_SESSION['endTrajet']=$this->getEnd();
    }

    public function getTimeTrajet(){
      $timestamp = strtotime($this->heureFin) - strtotime($this->dateDebut);
      $time = gmdate('G:i:s', $timestamp);
      return $time;
    }

    public function showInfosTrajet(){
      echo "<p>Trajet: "."<br>".$this->getStart(). " => ".$this->getEnd()."</p>
      <p>Temps de trajet estimé: ".$this->getDuration()." | Distance: ".$this->getDistance()." Km</p>";
    }

    static public function getDistanceTime($start,$end){
      $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$start."&destinations=".$end."&key=AIzaSyD9V95TZkvQgMaGrryXqkveGQSFdPtyK0Y");
      $data = json_decode($api);

      //echo "<br>Distance: ".((int)$data->rows[0]->elements[0]->distance->value/1000).;
      //echo "<br>Duration: ".$data->rows[0]->elements[0]->duration->text;
      $apiReturn = array('distance' => ((int)$data->rows[0]->elements[0]->distance->value/1000),'time' => $data->rows[0]->elements[0]->duration->text);

      return $apiReturn;
    }
  }














?>
