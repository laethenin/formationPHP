<?php
require_once 'Creature.php';

class Arene {
    public function lancerCombat(Creature $c1, Creature $c2){
        echo "Combattez !!!<br>";
        echo "<strong>" . $c1->getCri(). "</strong>" . "<br>";
        echo "<strong>" . $c2->getCri(). "</strong>" . "<br>";
        $premierTour = 1;
        while($c1->estEnVie() && $c2->estEnVie()){
            echo "Tour : " . $premierTour . "<br>";
            $c1->attaquer($c2);
            $c2->estEnVie() && $c2->attaquer($c1);
            $premierTour++;
        }

        echo "Le combat est fini !!!";
        if($c1->estEnVie()){
            echo $c1->getNom() . " a gagné le combat.<br><br>";
        }
        if ($c2->estEnVie()){
            echo $c2->getNom() . " a gagné le combat.<br><br>";
        }
    }
}




