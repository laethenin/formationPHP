<?php

class Database{
    private $bdd;

    public function __construct () {
        try{
            $dbname="poo_plainte";
            $host="localhost";
            $dbuser="root";
            $dbpassword="";

            $this->bdd=new PDO ("mysql:host=$host;dbname=$dbname", $dbuser,$dbpassword, array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION));

        }catch(Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
    }

    public function getBdd(){
        return $this->bdd;
    }
}
