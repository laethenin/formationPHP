<?php
/* class mère*/
class Country {
    /// Attributs //
    protected $name;
    protected $capital;
    protected $population;
    protected $continent;

    /// Constructeur //
    public function __construct($name, $capital, $population, $continent) {
        $this->name = $name;
        $this->capital = $capital;
        $this->population = $population;
        $this->continent = $continent;
    }

    /// Getters //
    public function getName() {
        return $this->name . "<br>";
    }
    public function getCapital() {
        return $this->capital . "<br>";
    }
    public function getPopulation() {
        return $this->population . "<br>";
    }
    public function getContinent() {
        return $this->continent . "<br>";
    }

    /// Setters //
    public function setName($name) {
        $this->name = $name;
    }
    public function setPopulation($population) {
        $this->population = $population;
    }

    /// Dire si oui ou non la population est > 100///
    public function isPopulous() {
        if($this->population > "100") {
            return true;
        } else {
            return false;
        }
    }

    /// Affichage des infos pour chaque pays //
    public function getInfo(){
        return "Le nom du pays est : " . $this->getName() . "Sa capitale est : " . $this->getCapital() . "Sa population est de : " . $this->getPopulation() . " millions d'habitants" . "<br>" . "Il est situé sur le continent : " . $this->getContinent() . "<br><br>";
    }
}


