<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Gestion plaintes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
if (isset($nom) && isset($email) && isset($sujet) && isset($message)) {
    $nom = $_POST ["nom"];
    $email = $_POST ["email"];
    $sujet = $_POST ["sujet"];
    $message = $_POST ["message"];
    }

    /*if (empty($nom)){
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
    }*/
?>

<body>
<header>
    <h1>Gestion d'une plainte</h1>
</header>

<main>
    <h2>Merci de remplir ce formulaire afin que l'on traite votre plainte.</h2>
    <form action="formulaire.php" method="POST">
        <div class="form-group">
            <label for="nom">* Nom : </label>
            <input type="text" class="form-control" id="nom" name="nom"
                   placeholder="entrez votre nom et prénom" value="<?php if (isset($_POST['nom'])) {echo $_POST['nom'];}?>">
            <?php
            if (isset($_POST['nom']) && empty($_POST['nom'])){
                echo "Le nom est vide.<br>";
            }
            ?>
        </div>

        <div class="form-group">
            <label for="email">* Email : </label>
            <input type="email" class="form-control" id="email" name="email" placeholder="exemple@email.com" value="<?php if (isset($_POST['email'])) {echo $_POST['email'];}?>">
            <?php
            if (isset($_POST['email']) && empty($_POST['email'])){
                echo "L'email est vide.<br>";
            }
            ?>
        </div>

        <div class="form-group">
            <label for="sujet">* Sujet : </label>
            <input type="text" class="form-control" id="sujet" name="sujet"
                   placeholder="sujet de votre plainte" value="<?php if (isset($_POST['sujet'])) {echo $_POST['sujet'];}?>">
            <?php
            if (isset($_POST['sujet']) && empty($_POST['sujet'])) {
                echo "Le sujet est vide.<br>";
            }
            ?>
        </div>

        <div class="form-group">
            <label for="message">* Message : </label>
            <input type="text" class="form-control" id="message" name="message"
                   placeholder="expliquez votre plainte en détails" value="<?php if (isset($_POST['message'])) {echo $_POST['message'];}?>">
            <?php
            if (isset($_POST['message']) && empty($_POST['message'])) {
                echo "Le message est vide.<br>";
            }
            ?>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button><br>
        <?php
        if(!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['sujet']) && !empty($_POST['message'])){
            echo "Je m'appelle ".$_POST['nom'].", mon adresse mail est ".$_POST['email'].", ma plaine porte sur ".$_POST['sujet'].".<br>"."Contenu de la plainte : <br>".$_POST['message']."<br>";
        }
        ?>
    </form>

</main>

<footer>
</footer>

</body>
</html>


