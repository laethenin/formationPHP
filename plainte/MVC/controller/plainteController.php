<?php

require_once  "./model/plainte.php";

class PlainteController {
    private Plainte $plainte;

    public function __construct(Plainte $plainte) {
        $this->plainte = $plainte;
    }

    // affiche la liste des plaintes
    public function index(){
        $plaintes = $this->plainte->getAllPlaintes();
        include "./view/liste_plaintes.php";
    }

    // affiche le formulaire de plainte
    public function addPlainte(){
        include "./view/ajouter_plainte.php";
    }

    /// voir une plainte
    public function showPlainte($id){
        $plainte = $this->plainte->showOnePlainte($id);
        include "./view/show_plainte.php";
    }
}
