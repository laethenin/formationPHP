<?php

/*class Personne {
    public $nom;
    public $prenom;
    public $age;

    public function monIdentite(){
        echo $this->nom." ".$this->prenom." ".$this->age;
    }

    public function afficherNom(){
        return "Mon nom est " . $this->nom;
    }
    public function __construct($nom_param, $prenom_param, $age_param){
        $this->nom = $nom_param;
        $this->prenom = $prenom_param;
        $this->age = $age_param;
    }
}

$personne1 = new Personne();
$personne1->nom = "HENIN";
$personne1->prenom = "Laetitia";
$personne1->age = 39;

$personne1->monIdentite();
echo "<br>";
echo $personne1->afficherNom();
*/

class Voiture {
    public $marque;
    public $anneeDeFabrication;
    public $couleur;

    public function __construct($marque_param, $anneeDeFabrication_param, $couleur_param) {
        $this->marque = $marque_param;
        $this->anneeDeFabrication = $anneeDeFabrication_param;
        $this->couleur = $couleur_param;
    }
    public function afficherCaracteristiques(){
        echo "Marque : " . $this->marque . "<br>" . "Année de fabrication : " . $this->anneeDeFabrication . "<br>" . "Couleur : " . $this->couleur;
    }
}

/*$voiture1 = new Voiture();
$voiture1->marque = "Ford";
$voiture1->anneeDeFabrication = "1967";
$voiture1->couleur = "Blanc";
$voiture1->afficherCaracteristiques();*/

/* avec fonction construct */
$voiture2 = new Voiture("Peugeot", 2010, "Bleu");
$voiture2->afficherCaracteristiques();