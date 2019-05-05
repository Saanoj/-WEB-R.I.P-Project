<?php
namespace App;
use \PDO;




//require 'Autoloader.php';
//
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
    protected $rating;
    protected $ratingNumber;
    protected $description;

    public function __construct($idCollaborateur,$email,$last_name,$first_name,$metier,$prixCollaborateur,$dateEmbauche,$ville,$heuresTravailees,$rating,$ratingNumber,$description) {
        $this->idCollaborateur = $idCollaborateur;
        $this->email = $email;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->metier = $metier;
        $this->prixCollaborateur = $prixCollaborateur;
        $this->dateEmbauche = $dateEmbauche;
        $this->ville = $ville;
        $this->heuresTravailees = $heuresTravailees;
        $this->rating = $rating;
        $this->ratingNumber = $ratingNumber;
        $this->description = $description;
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
    public function getRating(){return $this->rating;}
    public function getRatingNumber(){return $this->ratingNumber;}
    public function getDescription(){return $this->description;}

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
  	public function setRating($rating){$this->rating = $rating;}
  	public function setRatingNumber($ratingNumber){$this->ratingNumber = $ratingNumber;}
  	public function setDescription($description){$this->description = $description;}





    /* FONCTIONS */
/*
    public function updateBdd($bdd,$) {
        $req = $bdd->getPDO()->prepare('UPDATE ')
    }
    */
    public function checkUserExist($bdd,$statement,$user) {
      $check = $bdd->getPDO()->prepare($statement);
      $check->execute(array(

        'email' => $user->getEmail()
      ));
      return $check->rowCount();
    }

    public function checkDateBirth() {
      $min = strtotime($this->getBirthday());
      $now = strtotime("now") + 7200;
      if($now - $min < 0){

        $date_erreur1 = "Vous n'êtes pas encore né";
        header('location:../inscription.php?error="'.$date_erreur1 .'"');
      }
      if($now - $min < 	504576000){

        $date_erreur3 = "Il faut avoir plus de 16 ans pour créer un compte";
        header('location:inscription.php?error="'.$date_erreur3 .'"');
      }
      else {
        return 1;
      }
    }

    public function chiffrerPassword() {
      $salage='SuP4rS4aL4g3';
      return hash('md5',$salage.$this->password);

    }

    public function addUser($bdd,$statement,$user) {


      $req1 = $bdd->getPDO()->prepare($statement);
      $req1->bindValue(':email', $user->getEmail());
      $req1->bindValue(':password',$user->chiffrerPassword($user->getPassword()));
      $req1->bindValue(':last_name',$user->getLast_name());
      $req1->bindValue(':birthday', $user->getBirthday());
      $req1->bindValue(':gender',$user->getGender());
      $req1->bindValue(':first_name',$user->getFirst_name());
      $req1->bindValue(':isBanned',0);
      $req1->bindValue(':isAdmin',0);
      $req1->execute();

    }
    public function startSession($bdd,$statement) {
      session_start();
      $req = $bdd->getPDO()->prepare($statement);
      $req->bindValue(':email', $this->getEmail());
      $req->execute();
      while	($donnees	=	$req->fetch())
      {
        $_SESSION['id'] =	$donnees['id'];
      }
      $_SESSION['email'] = $this->getEmail();
    }
}














?>
