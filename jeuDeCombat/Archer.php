<?php
require_once 'Creature.php';

class Archer extends Creature {
    // Attribut //
    private $cri;

    // Méthodes //
    public function __construct($nom, $sante, $force, $defense, $cri){
        Parent::__construct($nom, $sante, $force, $defense);
        $this->cri = $cri;
    }

    public function getCri() {
        return $this->cri;
    }

    public function crier() {
        return "Au coeur de l'action, " . $this->getNom() . " crie : " . $this->getCri() . "!<br><br>";
    }

    // modif pour mettre 30% de chance d'esquive///
    public function recevoirDegats($degats) {
        $chance = rand(1, 100);
        if ($chance <= 30) {
            echo $this->nom . " a pu esquivé l'attaque !<br><br>";
            return;
        }
        $this->sante = $this->sante - $degats;
        echo $this->nom . " n'a plus que " . $this->sante . " points de santé.<br><br>";
        if ($this->sante <= 0) {
            echo $this->nom . " est mort.<br><br>";
        }
    }
}

