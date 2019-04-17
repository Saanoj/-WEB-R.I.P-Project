<?php

require_once __DIR__.'/../utils/FieldValidator.php';

class User implements JsonSerializable{

  private $id;
  private $email;
  private $password;
  private $last_name;
  private $first_name;
  private $birthday;
  private $gender;
  private $avatar;
  private $zip_code;
  private $address;
  private $isBanned;
  private $isAdmin;
  private $isCollaborateur;
  private $idEntreprise;
  private $isDirecteur;

  public function __construct( ?int $id = 0, string $email,  string $password,  string $last_name,
  string $first_name,  string $birthday,  string $gender,  string $avatar,  ?string $zip_code,
  ?string $address, int $isBanned, int $isAdmin, int $isCollaborateur, ?string $idEntreprise, ?int $isDirecteur){

    $this->id=$id;
    $this->email=$email;
    $this->password=$password;
    $this->last_name=$last_name;
    $this->first_name=$first_name;
    $this->birthday=$birthday;
    $this->gender=$gender;
    $this->avatar=$avatar;
    $this->zip_code=$zip_code;
    $this->address=$address;
    $this->isBanned=$isBanned;
    $this->isAdmin=$isAdmin;
    $this->isCollaborateur=$isCollaborateur;
    $this->idEntreprise=$idEntreprise;
    $this->isDirecteur=$isDirecteur;

  }
public function getId(){
  return $this->id;}
public function setId($id){
  $this->id = $id;}
public function getEmail(){
  return $this->email;}
public function setEmail($email){
  $this->email = $email;}
public function getPassword(){
  return $this->password;}
public function setPassword($password){
  $this->password = $password;}
public function getLast_name(){
  return $this->last_name;}
public function setLast_name($last_name){
  $this->last_name = $last_name;}
public function getFirst_name(){
  return $this->first_name;}
public function setFirst_name($first_name){
  $this->first_name = $first_name;}
public function getBirthday(){
  return $this->birthday;}
public function setBirthday($birthday){
  $this->birthday = $birthday;}
public function getGender(){
  return $this->gender;}
public function setGender($gender){
  $this->gender = $gender;}
public function getAvatar(){
  return $this->avatar;}
public function setAvatar($avatar){
  $this->avatar = $avatar;}
public function getZip_code(){
  return $this->zip_code;}
public function setZip_code($zip_code){
  $this->zip_code = $zip_code;}
public function getAddress(){
  return $this->address;}
public function setAddress($address){
  $this->address = $address;}
public function getIsBanned(){
  return $this->isBanned;}
public function setIsBanned($isBanned){
  $this->isBanned = $isBanned;}
public function getIsAdmin(){
  return $this->isAdmin;}
public function setIsAdmin($isAdmin){
  $this->isAdmin = $isAdmin;}
public function getIsCollaborateur(){
  return $this->isCollaborateur;}
public function setIsCollaborateur($isCollaborateur){
  $this->isCollaborateur = $isCollaborateur;}
public function getIdEntreprise(){
  return $this->idEntreprise;}
public function setIdEntreprise($idEntreprise){
  $this->idEntreprise = $idEntreprise;}
public function getIsDirecteur(){
  return $this->isDirecteur;}
public function setIsDirecteur($isDirecteur){
  $this->isDirecteur = $isDirecteur;
}

  public function __toString(): string{
    $out = "";
    foreach (get_object_vars($this) as $key => $value) {
      $out .= "$key: $value | ";
    }
    return $out;
  }

  public static function UserFromArray(array $data): ?User{
    //if (FieldValidator::validate($data, ['email', 'password', 'last_name', 'first_name','birthday','gender',
    //'avatar','zip_code','address','isBanned','isAdmin','isCollaborateur','idEntreprise','isDirecteur'])) {

        $user = new User(NULL,$data['email'],$data['password'],$data['last_name'],$data['first_name'],
        $data['birthday'],$data['gender'],$data['avatar'],$data['zip_code'],$data['address'],$data['isBanned'],$data['isAdmin'],
        $data['isCollaborateur'],$data['idEntreprise'],$data['isDirecteur']);

        if (isset($data['id'])) {
          $user->setId($data['id']);
        }
        return $user;
    //}
    //return NULL;
  }

  public function jsonSerialize(){
    return get_object_vars($this);
  }
}

 ?>
