<?php

namespace DataBase;

use \PDO;

class Config {

    private $dbname;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;
    
    public function __construct($dbname,$db_user ='root',$db_pass =' ',$db_host ='localhost') {

        $this->db_name = $dbname;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }


        private function getPDO() {

            $pdo = new PDO('mysql:dbname=rip;host=localhost','root','');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
            return $pdo;
        }

        public function query($statement) {
            $req = $this->getPDO()->query($statement);
            $datas = $req->fetchAll(PDO::FETCH_OBJ);
            return $datas;

        }
    }

?>
