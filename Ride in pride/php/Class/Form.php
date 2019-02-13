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
       return  $this->surround('<input type="' . $type . '" name="'. $name . '">');

    }
    public function submit(){
        return $this->surround('<button type="submit" name="submit" id="submit" class="form-submit" value="Inscription">Inscription</button>');
    }
}


?>
