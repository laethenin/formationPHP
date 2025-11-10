<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Création clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="formulaireClient.css">
</head>

<?php
require_once 'config\db.php';

/// vérifie que les données sont initialisées
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['sexe']) && isset($_POST['date_naissance'])) {
    $nom = $_POST ["nom"];
    $prenom = $_POST ["prenom"];
    $sexe = $_POST ["sexe"];
    $date_naissance = $_POST ["date_naissance"];

    /// met les données dans la base de données
    if (!empty($nom) && !empty($prenom) && !empty($sexe) && !empty($date_naissance)) {
        global $bdd;
        $sql = "INSERT INTO clients (nom, prenom, sexe, date_naissance) VALUES (:nom, :prenom, :sexe, :date_naissance)";
        $insert = $bdd->prepare($sql);
        $verif = $insert->execute([
            "nom" => $nom,
            "prenom" => $prenom,
            "sexe" => $sexe,
            "date_naissance" => $date_naissance
        ]);
        if ($verif) {
            header("Location:list_clients.php");
            exit();
        }
    }
}
?>

<body>
<div class="container-custom">
    <div class="card mb-4">
        <div class="card-header text-center">
            <h1 class="mb-0">📋 Création d'un client</h1>
        </div>
        <div class="card-body">
            <p class="text-center text-muted">Merci de remplir ce formulaire afin de vous enregistrer comme client.</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <form action="add_clients.php" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="nom" class="form-label">* Nom : </label>
                    <input type="text" class="form-control" id="nom" name="nom"
                           placeholder="entrez votre nom" value="<?php if (isset($_POST['nom'])) {
                        echo $_POST['nom'];
                    } ?>">
                    <?php
                    if (isset($_POST['nom']) && empty($_POST['nom'])) {
                        echo "<div class='text-danger'>Le nom est vide.<br></div>";
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="prenom" class="form-label">* Prénom : </label>
                    <input type="text" class="form-control" id="prenom" name="prenom"
                           placeholder="entrez votre prénom" value="<?php if (isset($_POST['prenom'])) {
                        echo $_POST['prenom'];
                    } ?>">
                    <?php
                    if (isset($_POST['prenom']) && empty($_POST['prenom'])) {
                        echo "<div class='text-danger'>Le prénom est vide.<br></div>";
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="sexe" class="form-label">* Sexe : </label>
                    <select class="form-select" id="sexe" name="sexe">
                        <option value="">--sélectionnez--</option>
                        <option value="H" <?php if (isset($_POST['sexe']) && $_POST['sexe'] == 'H') echo 'selected'; ?>>Homme</option>
                        <option value="F" <?php if (isset($_POST['sexe']) && $_POST['sexe'] == 'F') echo 'selected'; ?>>Femme</option>
                    </select>
                    <?php
                    if (isset($_POST['sexe']) && empty($_POST['sexe'])) {
                        echo "<div class='text-danger'>Le sexe doit être sélectionné.</div>";
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="date_naissance" class="form-label">* Date de naissance : </label>
                    <input type="date" class="form-control" id="date_naissance" name="date_naissance"
                           value="<?php if (isset($_POST['date_naissance'])) {
                        echo $_POST['date_naissance'];
                    } ?>">
                    <?php
                    if (isset($_POST['date_naissance']) && empty($_POST['date_naissance'])) {
                        echo "<div class='text-danger'>La date de naissance est vide.<br></div>";
                    }
                    ?>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-between mt-4">
                    <a href="list_clients.php" class="btn btn-secondary">Retour</a>
                    <button type="submit" class="btn btn-primary">S'enregistrer</button>
                </div>
                <br>
            </form>
        </div>
    </div>

    <footer class="text-center mt-4 text-black">
        <p class="mb-0">© <?php echo date('Y'); ?> - Gestion des clients</p>
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

