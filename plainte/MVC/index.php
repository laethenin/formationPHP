<?php

require_once "controller/plainteController.php";
require_once "model/plainte.php";
require_once "model/database.php";

$bdd = new Database();
$plainteModel = new Plainte($bdd);
$plainteController = new PlainteController($plainteModel);

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'ajouter_plainte':
            $plainteController->addPlainte();
            break;

        case 'show_plainte':
            $id=$_GET['id'];
            $plainteController->showPlainte($id);
            break;

        default:
            $plainteController->index();
            break;
    }

} else {
    $plainteController->index();
}



