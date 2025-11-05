<?php

class DevelopedCountry extends Country {
    protected $gdp;

    public function __construct($name, $capital, $population, $continent, $gdp) {
        Parent:: __construct($name, $capital, $population, $continent);
        $this->gdp = $gdp;
    }

    public function getGdp() {
        return $this->gdp;
    }

    public function getInfo(){
        echo "Le nom du pays est : " . $this->getName() . "<br>" . "Sa capitale est : " . $this->getCapital() . "<br>" . "Sa population est de : " . $this->getPopulation() . " millions d'habitants" . "<br>" . "Il est situé sur le continent : " . $this->getContinent() . "<br>" . "Son PIB en milliards de dollars est de : " . $this->getGdp() . "<br><br>";
    }
}