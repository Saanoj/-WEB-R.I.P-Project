<?php
namespace App;
use \PDO;

class Session
{
  private $id;
  public function __construct($id)
  {
    $this->id = $id;
  }
  public function isConnect()
  {
    if($this->getId()){
      //good
    }else{
      $path=__DIR__.'../notConnect.php';
      header('Location:'.$path);

      
    }
  }
  public function getId() {return $this->id;}
}

 ?>
