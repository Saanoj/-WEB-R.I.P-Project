<?php

namespace App;

use \PDO;
class Form{

    private $data;
    public $surround ='p';
    public function __construct($data = array()) {
        $this->data = $data;


    }
    private function surround($html) {
        return "<{$this->surround}>{$html}</{$this->surround}>";
    }

    public function input($name,$type) {
       return  $this->surround('<input type="' . $type . '" name="'. $name . '" id="' .$name .'" autofocus onblur="check'.$name.'(this)">');

    }
    public function submit(){
        return $this->surround('<submit  href="#" class="btn btn-success" name="submit"  value="Inscription">Inscription</submit>');
    
    }

    public function inputConnexion($name,$type,$placeholder,$class) {
         return  $this->surround('<input type="' . $type . '" name="'. $name . '" id="' .$name .'" placeholder="' . $placeholder . '"  class="' . $class .'" >');

    }

    public function submitConnexion (){
        return $this->surround('<button  type="submit" href="#" class="btn btn-success" name="submit"  value="Connexion">Valider</button>');

    }
}




?>
