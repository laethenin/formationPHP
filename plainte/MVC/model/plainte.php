<?php

require_once "database.php";

class Plainte {
    private $id ;
    private $nom ;
    private $sujet ;
    private $message ;
    private $date_plainte ;

    private Database $bdd;

    public function __construct(Database $bdd) {
        $this->bdd = $bdd;
    }

    public function getAllPlaintes() {
        $sql = "SELECT * FROM plaintes";
        $query = $this->bdd->getBdd()->query($sql);
        return $plaintes = $query->fetchAll();
    }

    public function showOnePlainte($id) {
        $sql = "SELECT * FROM plaintes WHERE id = :id";
        $query = $this->bdd->getBdd()->prepare($sql);
        $plainte=$query->execute(['id'=>$id]);
        return $plainte = $query->fetch();
    }
}
