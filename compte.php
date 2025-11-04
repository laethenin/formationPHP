<?php
class CompteBancaire {
    public $proprietaire;
    public $solde;
    public $annee;

    public function __construct($proprietaire, $solde, $annee) {
        $this->proprietaire = $proprietaire;
        $this->solde = $solde;
        $this->annee = $annee;
    }

    public function afficherProprietaire() {
        echo "Le nom du propriétaire est " . $this->proprietaire . ".";
    }

    public function afficherSolde() {
        echo "Le solde est " . $this->solde . ".";
    }
}

class CompteEpargne extends CompteBancaire {
    public $soldeBloque;

    public function __construct($proprietaire, $solde, $annee, $soldeBloque) {
        Parent::__construct($proprietaire, $solde, $annee);
        $this->soldeBloque = $soldeBloque;
    }

    public function afficherSoldeBloque() {
        echo "Le solde épargné est " . $this->soldeBloque . ".";
    }
}

$compte1 = new CompteBancaire("STEN", 2880, 2007);
$compte1->afficherProprietaire();
$compte1->afficherSolde();

$compte2 = new CompteEpargne("HENIN", 3500, 2007, 1800);
$compte2->afficherProprietaire();
$compte2->afficherSolde();
$compte2->afficherSoldeBloque();