<?php

require_once __DIR__.'/../utils/FieldValidator.php';

class Trajet implements JsonSerializable{

  private $idTrajet;
  private $idClient;
  private $idChauffeur;
  private $heureDebut;
  private $heureFin;
  private $dateResevation;
  private $distanceTrajet;
  private $prixtrajet;
  private $debut;
  private $fin;
  private $duration;
  private $state;
  private $stateDriver;

  public function __construct( int $idTrajet, int $idClient,  int $idChauffeur,  string $heureDebut,
  string $heureFin,  string $dateResevation,  int $distanceTrajet,  float $prixtrajet,  string $debut,
  string $fin, string $duration, int $state, int $stateDriver){


    $this->idTrajet=$idTrajet;
    $this->idClient=$idClient;
    $this->idChauffeur=$idChauffeur;
    $this->heureDebut=$heureDebut;
    $this->heureFin=$heureFin;
    $this->dateResevation=$dateResevation;
    $this->distanceTrajet=$distanceTrajet;
    $this->prixtrajet=$prixtrajet;
    $this->debut=$debut;
    $this->fin=$fin;
    $this->duration=$duration;
    $this->state=$state;
    $this->stateDriver=$stateDriver;
}

  public function __toString(): string{
    $out = "";
    foreach (get_object_vars($this) as $key => $value) {
      $out .= "$key: $value | ";
    }
    return $out;

  }

  public static function TrajetFromArray(array $data): ?Trajet{
    //if (FieldValidator::validate($data, ['email', 'password', 'last_name', 'first_name','birthday','gender',
    //'avatar','zip_code','address','isBanned','isAdmin','isCollaborateur','idEntreprise','isDirecteur'])) {

        $trajet = new Trajet($data['idTrajet'],$data['idClient'],$data['idChauffeur'],$data['heureDebut'],$data['heureFin'],
        $data['dateResevation'],$data['distanceTrajet'],$data['prixtrajet'],$data['debut'],$data['fin'],$data['duration'],$data['state'],
        $data['stateDriver']);

        $trajet->toString();
        return $trajet;
    //}
    //return NULL;
  }

  public function jsonSerialize(){
    return get_object_vars($this);
  }
}

 ?>
