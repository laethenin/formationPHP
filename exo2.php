<?php
/* Donner à partir d'une liste d'années de naissance, la plus grande valeur et
la plus petite, ainsi que le nombre d'années paires*/

$ages = [2010, 1983, 2021, 1952, 1986, 2018];

$valeurMax = $ages[0];
for ($i=1; $i < count($ages); $i++) {
    if ($ages[$i] > $valeurMax) {
        $valeurMax = $ages[$i];
    }
}
echo "L'année de naissance la plus petite (âge le plus petit) est : " . $valeurMax . "<br>";
echo "<br>";

$valeurMin = $ages[0];
for ($i=1; $i < count($ages); $i++) {
    if ($ages[$i] < $valeurMin) {
        $valeurMin = $ages[$i];
    }
}
echo "L'année de naissance la plus grande (âge le plus grand) est : " . $valeurMin . "<br>";
echo "<br>";

$compteur = 0;
foreach ($ages as $value) {
    if ($value % 2 == 0) {
        $compteur++;
    }
}
echo "Il y a " . $compteur . " années paires dans le tableau." . "<br>";
