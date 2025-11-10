<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Modification plaintes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
global $bdd;
require_once "bdd.php";
if (isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['sujet']) && isset($_POST['message']) && isset($_POST['id'])) {
    $nom = $_POST ["nom"];
    $email = $_POST ["email"];
    $sujet = $_POST ["sujet"];
    $message = $_POST ["message"];
    $id = $_POST ["id"];

    if (!empty($nom) && !empty($email) && !empty($sujet) && !empty($message) && !empty($id)) {
        global $bdd;
        $sql = "UPDATE plaintes SET nom=:nom, sujet=:sujet, message=:message WHERE id=:id";
        $update = $bdd->prepare($sql);
        $verif = $update->execute([
            "nom" => $nom,
            "sujet" => $sujet,
            "message" => $message,
            "id" => $id
        ]);
        if ($verif) {
            header("Location:plaintes.php");
            exit();
        }
    }
}

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM plaintes WHERE id = :id";
        $query = $bdd->prepare($sql);
        $plainte=$query->execute(['id' => $id]);
        $plainte = $query->fetch();
    }
?>

<body>

<div class="container-custom">
    <div class="card mb-4">
        <div class="card-header text-center">
            <h1 class="mb-0">📋 Modification des Plaintes</h1>
        </div>
        <div class="card-body">
            <p class="text-center text-muted">Si vous le souhaitez vous pouvez modifier votre saisie de plainte.</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <a href="plaintes.php"><button type="button" class="btn btn-danger">Retour</button></a>
            <form action="edit_plainte.php" method="POST" autocomplete="off">
                <input type="hidden" name="id" value="<?php if (isset($plainte['id'])) {echo $plainte['id'];} ?>">
                <div class="mb-3">
                    <label for="nom">* Nom : </label>
                    <input type="text" class="form-control" id="nom" name="nom"
                           placeholder="entrez votre nom et prénom" value="<?php if (isset($plainte['nom'])) {
                        echo $plainte['nom'];
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
                           value="<?php if (isset($plainte['email'])) {
                               echo $plainte['email'];
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
                           placeholder="sujet de votre plainte" value="<?php if (isset($plainte['sujet'])) {
                        echo $plainte['sujet'];
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
                              placeholder="détaillez ici votre plainte" rows="5"><?php if (isset($plainte['message'])) {
                            echo $plainte['message'];
                        } ?></textarea>
                    <?php
                    if (isset($_POST['message']) && empty($_POST['message'])) {
                        echo "Le message est vide.<br>";
                    }
                    ?>
                </div>

                <button type="submit" class="btn btn-primary">Modifier</button>
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
