<?php
 $nom = $_POST ["nom"];
 $email = $_POST ["email"];
 $sujet = $_POST ["sujet"];
 $message = $_POST ["message"];

 if (isset($nom) && isset($email) && isset($sujet) && isset($message)) {
     if (empty($nom)){
         echo "Le nom est vide.<br>";
     }
     if (empty($email)){
         echo "L'adresse mail est vide.<br>";
     }
     if (empty($sujet)){
         echo "Le sujet est vide.<br>";
     }
     if (empty($message)){
         echo "Le message est vide.<br>";
     }
     if(!empty($nom) && !empty($email) && !empty($sujet) && !empty($message)){
         echo "Je m'appelle $nom, mon adresse mail est $email, ma plaine porte sur $sujet.<br>"."Contenu de la plainte : <br>".$message."<br>";
     }
 }
