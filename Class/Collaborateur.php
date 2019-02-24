<?php
namespace App;
use \PDO;




//require 'Autoloader.php';
//Autoloader::register();
$bdd = new Database('rip');

 class Collaborateur {
    protected $idCollaborateur;
    protected $email;
    protected $last_name;
    protected $first_name;
    protected $metier;
    protected $prixCollaborateur;
    protected $dateEmbauche;
    protected $ville;
    protected $heuresTravailees;

    public function __construct($idCollaborateur,$email,$last_name,$first_name,$metier,$prixCollaborateur,$dateEmbauche,$ville,$heuresTravailees) {
        $this->idCollaborateur = $idCollaborateur;
        $this->email = $email;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->metier = $metier;
        $this->prixCollaborateur = $prixCollaborateur;
        $this->dateEmbauche = $dateEmbauche;
        $this->ville = $ville;
        $this->heuresTravailees = $heuresTravailees;
    }

    /* GETTERS */
    public function getIdCollaborateur(){return $this->idCollaborateur;}
    public function getEmail(){return $this->email;}
    public function getLast_name(){return $this->last_name;}
    public function getFirst_name(){return $this->first_name;}
    public function getMetier(){return $this->metier;}
    public function getPrixCollaborateur(){return $this->prixCollaborateur;}
    public function getDateEmbauche(){return $this->dateEmbauche;}
  	public function getVille(){return $this->ville;}
    public function getHeuresTravailees(){return $this->heuresTravailees;}

    /* SETTERS */
    public function setIdCollaborateur($idCollaborateur){$this->idCollaborateur = $idCollaborateur;}
    public function setEmail($email){$this->email = $email;}
    public function setLast_name($last_name){$this->last_name = $last_name;}
    public function setFirst_name($first_name){$this->first_name = $first_name;}
    public function setMetier($metier){$this->metier = $metier;}
    public function setPrixCollaborateur($prixCollaborateur){$this->prixCollaborateur = $prixCollaborateur;}
    public function setDateEmbauche($dateEmbauche){$this->dateEmbauche = $dateEmbauche;}
    public function setVille($ville){$this->ville = $ville;}
  	public function setHeuresTravailees($heuresTravailees){$this->heuresTravailees = $heuresTravailees;}





    /* FONCTIONS */
/*
    public function updateBdd($bdd,$) {
        $req = $bdd->getPDO()->prepare('UPDATE ')
    }
    */



}














?>
