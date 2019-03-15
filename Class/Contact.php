<?php
namespace App;
use \PDO;





//require 'Autoloader.php';
//Autoloader::register();
$bdd = new Database('rip');

Class Contact {
    private $idContact;
    private $idClient;
    private $nameClient;
    private $phoneNumber;
    private $messageContact;
    private $dateContact;

    public function __construct($idContact,$idClient,$nameClient,$phoneNumber,$messageContact,$dateContact) {
        $this->idContact = $idContact;
        $this->idClient = $idClient;
        $this->nameClient = $nameClient;
        $this->phoneNumber = $phoneNumber;
        $this->messageContact = $messageContact;
        $this->dateContact = $dateContact;
    
    }

        /* GETTERS */
        public function getIdContact(){return $this->idContact;}
        public function getIdClient(){return $this->idClient;}
        public function getNameClient(){return $this->nameClient;}
        public function getPhoneNumber(){return $this->phoneNumber;}
        public function getMessage(){return $this->messageContact;}
        public function getDateMessage(){return $this->dateContact;}

            /* SETTERS */
         public function setIdContact($newIdContact){$this->idContact = $newIdContact;}
         public function setPhoneNumber($newPhoneNumber){$this->phoneNumber = $newPhoneNumber;}
         public function setMessage($newMessage){$this->$messageContact = $newMessage;}


         public static function createContact($bdd) {
        $dataContact = Contact::getAll($bdd);
        return $contact = new Contact($dataContact['idContact'],$dataContact['idClient'],$dataContact['nameClient'],$dataContact['phoneNumber'],$dataContact['messageContact'],$dataContact['dateContact']);
            
        }

        public static function getAll($bdd) {
            $statement = 'SELECT * FROM contact WHERE idClient = ?';
            $reqContact = $bdd->getPDO()->prepare($statement);
            $reqContact->execute(array($_SESSION['id']));
            $dataContact = $reqContact->fetch();
             return $dataContact;
    
        }

        public static function insertContact($bdd) {

            $date = date('Y-m-d');
            $req = $bdd->getPDO()->prepare('INSERT INTO contact(idClient,nameClient,phoneNumber,messageContact,dateContact) VALUES(:idClient,:nameClient,:phoneNumber,:messageContact,:dateContact)');
            $req->bindValue(":idClient",$_SESSION['id']);
            $req->bindValue(":nameClient",$_POST['nameClient']);
            $req->bindValue(":phoneNumber",$_POST['phoneNumber']);
            $req->bindValue(":messageContact",$_POST['messageContact']);
            $req->bindValue(":dateContact",$date);
            $req->execute();
            $req->closeCursor();
            Contact::createContact($bdd);

        }


}