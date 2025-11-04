<?php
require_once 'Country.php';

$country1 = new Country ("France", "Paris", "68", "Europe");
echo $country1->getPopulation();
$country1->getInfo();
$country1->setName("Francia");
$country1->getInfo();


$country2 = new Country ("Japon", "Tokyo", "120", "Asie");
echo $country2->getName();
$country2->getInfo();
$country2->setName("Nihon");
$country2->getInfo();


$country3 = new Country ("Maroc", "Rabat", "38", "Afrique");
echo $country3->getCapital();
$country3->getInfo();
$country3->setPopulation("40");
$country3->getInfo();


$country4 = new Country ("Australie", "Canberra", "27", "Océanie");
echo $country4->getContinent();
$country4->getInfo();
$country4->setPopulation("25");
$country4->getInfo();


$country5 = new Country ("Chili", "Santiago", "19", "Amérique");
echo $country5->getName();
$country5->getInfo();
$country5->setName("Chile");
$country5->getInfo();

