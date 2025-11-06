<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Gestion plaintes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
require_once "bdd.php";
if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['sujet']) && isset($_POST['message'])) {
    $nom = $_POST ["nom"];
    $email = $_POST ["email"];
    $sujet = $_POST ["sujet"];
    $message = $_POST ["message"];

    if (!empty($nom) && !empty($email) && !empty($sujet) && !empty($message)) {
        global $bdd;
        $sql = "INSERT INTO plaintes (nom, sujet, message, date_plainte) VALUES (:nom, :sujet, :message, :date_plainte)";
        $insert = $bdd->prepare($sql);
        $verif = $insert->execute([
                "nom" => $nom,
                "sujet" => $sujet,
                "message" => $message,
                "date_plainte" => date('Y-m-d')
        ]);
        if ($verif) {
            header("Location:plaintes.php");
            exit();
        }
    }
}
?>

<body>

<div class="container-custom">
    <div class="card mb-4">
        <div class="card-header text-center">
            <h1 class="mb-0">📋 Gestion des Plaintes</h1>
        </div>
        <div class="card-body">
            <p class="text-center text-muted">Merci de remplir ce formulaire afin que nous puissions traiter votre
                plainte.</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <a href="plaintes.php"><button type="button" class="btn btn-danger">Retour</button></a>
            <form action="formulaire.php" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="nom">* Nom : </label>
                    <input type="text" class="form-control" id="nom" name="nom"
                           placeholder="entrez votre nom et prénom" value="<?php if (isset($_POST['nom'])) {
                        echo $_POST['nom'];
                    } ?>">
                    <?php
                    if (isset($_POST['nom']) && empty($_POST['nom'])) {
                        echo "Le nom est vide.<br>";
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="email">* Email : </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="exemple@email.com"
                           value="<?php if (isset($_POST['email'])) {
                               echo $_POST['email'];
                           } ?>">
                    <?php
                    if (isset($_POST['email']) && empty($_POST['email'])) {
                        echo "L'email est vide.<br>";
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="sujet">* Sujet : </label>
                    <input type="text" class="form-control" id="sujet" name="sujet"
                           placeholder="sujet de votre plainte" value="<?php if (isset($_POST['sujet'])) {
                        echo $_POST['sujet'];
                    } ?>">
                    <?php
                    if (isset($_POST['sujet']) && empty($_POST['sujet'])) {
                        echo "Le sujet est vide.<br>";
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="message">* Message : </label>
                    <textarea class="form-control" id="message" name="message"
                              placeholder="détaillez ici votre plainte" rows="5"><?php if (isset($_POST['message'])) {
                            echo $_POST['message'];
                        } ?></textarea>
                    <?php
                    if (isset($_POST['message']) && empty($_POST['message'])) {
                        echo "Le message est vide.<br>";
                    }
                    ?>
                </div>

                <button type="submit" class="btn btn-primary">Envoyer</button>
                <br>
                <?php
                if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['sujet']) && !empty($_POST['message'])) {
                    echo "Je m'appelle " . $_POST['nom'] . ", mon adresse mail est " . $_POST['email'] . ", ma plaine porte sur " . $_POST['sujet'] . ".<br>" . "Contenu de la plainte : <br>" . $_POST['message'] . "<br>";
                }
                ?>
            </form>
        </div>
    </div>

    <footer class="text-center mt-4 text-black">
        <p class="mb-0">© <?php echo date('Y'); ?> - Gestion des plaintes pour persos de mangas blasés</p>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></script>
<script>
    window.addEventListener('load', function () {
        document.getElementById('contactForm').reset();
    });
</script>
</body>
</html>
