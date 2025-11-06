<?php
require_once 'Country.php';
require_once 'DevelopedCountry.php';

$country1 = new Country ("France", "Paris", "68", "Europe");
echo "<strong>Récupération donnée population : </strong>" . $country1->getPopulation();
echo $country1->getInfo();
echo $country1->isPopulous() ? "Ce pays est très peuplé." : "Ce pays n'est pas très peuplé." . "<br>";
$country1->setName("Francia");
echo "<strong>modif donnée name</strong>" . "<br>";
echo $country1->getInfo();


$country2 = new Country ("Japon", "Tokyo", "120", "Asie");
echo "<strong>Récupération donnée name : </strong>". $country2->getName();
echo $country2->getInfo();
$country2->setName("Nihon");
echo "<strong>modif donnée name</strong>" . "<br>";
echo $country2->getInfo();


$country3 = new Country ("Maroc", "Rabat", "38", "Afrique");
echo "<strong>Récupération donnée capitale : </strong>" . $country3->getCapital();
echo $country3->getInfo();
$country3->setPopulation("40");
echo "<strong>modif donnée population</strong>" . "<br>";
echo $country3->getInfo();


$country4 = new Country ("Australie", "Canberra", "27", "Océanie");
echo "<strong>Récupération de la donnée continent : </strong>" . $country4->getContinent();
echo $country4->getInfo();
$country4->setPopulation("25");
echo "<strong>modif donnée population</strong>" . "<br>";
echo $country4->getInfo();


$country5 = new Country ("Chili", "Santiago", "19", "Amérique");
echo "<strong>Récupération de la donnée name : </strong>" . $country5->getName();
echo $country5->getInfo();
$country5->setName("Chile");
echo "<strong>modif donnée name</strong>" . "<br>";
echo $country5->getInfo();

$countries = [$country1, $country2, $country3, $country4, $country5];
foreach ($countries as $key => $value) {
    echo "<strong>Index dans le tableau : </strong>" . $key . "<br>";
    echo $value->getInfo() . "<br>";
}

echo "<strong>Affichage avec la class enfant</strong>" . "<br>";
$country6 = new DevelopedCountry("Italie", "Rome", "50", "Europe", "40");
$country6->getInfo();

