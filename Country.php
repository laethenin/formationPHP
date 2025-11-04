<?php
class Country {
    public $name;
    public $capital;
    public $population;
    public $continent;

    public function __construct($name, $capital, $population, $continent) {
        $this->name = $name;
        $this->capital = $capital;
        $this->population = $population;
        $this->continent = $continent;
    }
    public function getInfo(){
        echo "Le nom du pays est : " . $this->name . "<br>" . "Sa capitale est : " . $this->capital . "<br>" . "Sa population est de : " . $this->population . " millions d'habitants" . "<br>" . "Il est situé sur le continent : " . $this->continent . "<br><br>";
    }
}