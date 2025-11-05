<?php

class DevelopedCountry extends Country {
    protected $gdp;

    public function __construct($name, $capital, $population, $continent, $gdp) {
        Parent:: __construct($name, $capital, $population, $continent);
        $this->gdp = $gdp;
    }

    /*public function setGdp($gdp) {
        $this->gdp = $gdp;
    }*/

    public function getInfo(){
        echo "Le nom du pays est : " . $this->name . "<br>" . "Sa capitale est : " . $this->capital . "<br>" . "Sa population est de : " . $this->population . " millions d'habitants" . "<br>" . "Il est situé sur le continent : " . $this->continent . "<br>" . "Son PIB en milliards de dollars est de : " . $this->gdp . "<br><br>";
    }
}