<?php
class Country {
    private $name;
    private $capital;
    private $population;
    private $continent;

    public function __construct($name, $capital, $population, $continent) {
        $this->name = $name;
        $this->capital = $capital;
        $this->population = $population;
        $this->continent = $continent;
    }

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

    public function setName($name) {
        $this->name = $name;
    }
    public function setPopulation($population) {
        $this->population = $population;
    }
    public function getInfo(){
        echo "Le nom du pays est : " . $this->name . "<br>" . "Sa capitale est : " . $this->capital . "<br>" . "Sa population est de : " . $this->population . " millions d'habitants" . "<br>" . "Il est situé sur le continent : " . $this->continent . "<br><br>";
    }
}