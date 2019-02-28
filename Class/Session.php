<?php
namespace App;
use \PDO;

class Session
{
  private $id
  public function __construct($id)
  {
    $this->id = $id;
  }
  public function isConnect()
  {
    if(isset($this->getId())){
      //good
    }else{
      header('Location:http://localhost/-WEB-R.I.P-Project/notConnect.php');
    }
  }
  public function getId() {return $this->id;}
}

 ?>
