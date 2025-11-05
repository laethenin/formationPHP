<?php
require_once 'Creature.php';

class Mage extends Creature {
    // Attribut //
    private $cri;

    // Méthode //
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

    /// modif pour ajouter 10 de dégats supplémentaires//
    public function attaquer(Creature $adversaire) {
        $degats = 10 + $this->force - $adversaire->defense;
        if ($degats < 0) {
            $degats = 0;
        }
        echo $this->nom. " vient d'infliger " . $degats . " de dégats à " . $adversaire->nom . ".<br>";
        $adversaire->recevoirDegats($degats);
    }
}
