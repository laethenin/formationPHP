<?php

/*class mère*/
abstract class Creature {
    // Attributs //
    protected $nom;
    protected $sante;
    protected $force;
    protected $defense;

    // Constructeur //
    public function __construct($nom, $sante, $force, $defense) {
        $this->nom = $nom;
        $this->sante = $sante;
        $this->force = $force;
        $this->defense = $defense;
    }

    // Getters//
    public function getNom() {
        return $this->nom;
    }
    public function getSante() {
        return $this->sante;
    }
    public function getForce() {
        return $this->force;
    }
    public function getDefense() {
        return $this->defense;
    }

    /// Ajout de cette méthode juste pour vérifier les données///
    public function getInfos() {
        return "Le nom de la créature est : " . $this->getNom() . ".<br>" .
            " Ses points de santé sont : " . $this->getSante() . ".<br>" .
            " Sa force est : " . $this->getForce() . ".<br>" .
            " Sa défense est : " . $this->getDefense() . ".<br>";
    }

    /// Méthodes///
    public function attaquer(Creature $adversaire) {
        $degats = $this->force - $adversaire->defense;
        if ($degats < 0) {
            $degats = 0;
        }
        echo $this->nom. " vient d'infliger " . $degats . " de dégats à " . $adversaire->nom . ".<br>";
        $adversaire->recevoirDegats($degats);
    }

    public function recevoirDegats($degats) {
        $this->sante = $this->sante - $degats;
        echo $this->nom . " n'a plus que " . $this->sante . " points de santé.<br><br>";
        if ($this->sante <= 0) {
            echo $this->nom . " est mort.<br><br>";
        }
    }

    public function estEnVie(){
        if($this->sante > 0){
            return true;
        } else {
            return false;
        }
    }

    abstract public function crier();
}
