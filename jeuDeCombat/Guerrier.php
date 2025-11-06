<?php
require_once 'Creature.php';

class Guerrier extends Creature {
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
        return "Au coeur de l'action, " . $this->getNom(). " crie : " . $this->getCri() . "!<br><br>";
    }
}
