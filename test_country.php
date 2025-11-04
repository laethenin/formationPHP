<?php
require_once 'Country.php';

$country1 = new Country ("France", "Paris", "68", "Europe");
$country1->getInfo();

$country2 = new Country ("Japon", "Tokyo", "120", "Asie");
$country2->getInfo();

$country3 = new Country ("Maroc", "Rabat", "38", "Afrique");
$country3->getInfo();

$country4 = new Country ("Australie", "Canberra", "27", "Océanie");
$country4->getInfo();

$country5 = new Country ("Chili", "Santiago", "19", "Amérique");
$country5->getInfo();
