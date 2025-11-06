<?php

require_once 'Creature.php';
require_once 'Guerrier.php';
require_once 'Archer.php';
require_once 'Mage.php';
require_once 'Arene.php';

/// Vérification des implémentations //
$guerrier1 = new Guerrier ("Son Goku", 150, 20, 10, "Pour la gloire");
echo $guerrier1->getInfos();
echo $guerrier1->estEnVie() ? $guerrier1->getNom() . " est en vie.<br>" : $guerrier1->getNom() . " est mort.<br>";
echo $guerrier1->crier();

$archer1 = new Archer ("Genya", 120, 15, 8, "Prêt à viser");
echo $archer1->getInfos();
echo $archer1->estEnVie() ? $archer1->getNom() . " est en vie.<br>" : $archer1->getNom() . " est mort.<br>";
echo $archer1->crier();

$mage1 = new Mage ("Jin Woo", 100, 30, 5, "Abracadabra");
echo $mage1->getInfos();
echo $mage1->estEnVie() ? $mage1->getNom() . " est en vie.<br>" : $mage1->getNom() . " est mort.<br>";
echo $mage1->crier();


// COMBATS !!!!! ////
(new Arene)->lancerCombat($guerrier1, $mage1);
(new Arene)->lancerCombat($guerrier1, $archer1);
(new Arene)->lancerCombat($archer1, $mage1);






