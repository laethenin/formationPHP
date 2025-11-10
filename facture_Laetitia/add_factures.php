<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Création factures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<?php
require_once 'config/db.php';
global $bdd;

// Récupération de certaines données de la table clients, stockées dans un tableau associatif
$stmt = $bdd->query("SELECT id_clients, nom, prenom FROM clients ORDER BY nom ASC");
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

/// Vérifier que les données sont envoyées
if (isset($_POST['id_clients']) && isset($_POST['montant']) && isset($_POST['produits']) && isset($_POST['quantite'])) {
    $id_clients = $_POST ["id_clients"];
    $montant = $_POST ["montant"];
    $produits = $_POST ["produits"];
    $quantite = $_POST ["quantite"];

    /// Insertion des données dans la table
    if (!empty($id_clients) && !empty($montant) && !empty($produits) && !empty($quantite)) {
        $sql = "INSERT INTO factures (id_clients, montant, produits, quantite) VALUES (:id_clients, :montant, :produits, :quantite)";
        $insert = $bdd->prepare($sql);
        $verif = $insert->execute([
                "id_clients" => $id_clients,
                "montant" => $montant,
                "produits" => $produits,
                "quantite" => $quantite
        ]);
        if ($verif) {
            header("Location:list_factures.php");
            exit();
        }
    }
}
?>

<body>
<div class="container-custom">
    <div class="card mb-4">
        <div class="card-header text-center">
            <h1 class="mb-0">📋 Création d'une facture</h1>
        </div>
        <div class="card-body">
            <p class="text-center text-muted">Merci de remplir ce formulaire afin de valider la facture.</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <form action="add_factures.php" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="id_clients" class="form-label">* Client : </label>
                    <select class="form-select" id="id_clients" name="id_clients">
                        <option value="">Sélectionnez le client</option>
                        <?php foreach ($clients as $client){ ?>
                            <option value="<?php echo ($client['id_clients'])?>"
                                <?php if (isset($_POST['id_clients']) && $_POST['id_clients'] == $client['id_clients']){
                                    echo 'selected';}?>>
                                <?php echo ($client['nom'].' '.$client['prenom'])?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php
                    if (isset($_POST['id_clients']) && empty($_POST['id_clients'])) {
                        echo "Veuillez sélectionner un client.<br>";
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="montant" class="form-label">* Montant total : </label>
                    <input type="text" class="form-control" id="montant" name="montant"
                           placeholder="entrez le montant de la facture"
                           value="<?php if (isset($_POST['montant'])) {
                            echo $_POST['montant'];
                           } ?>">
                    <?php
                    if (isset($_POST['montant']) && empty($_POST['montant'])) {
                        echo "Le montant est vide.<br>";
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="produits" class="form-label">* Produits commandés : </label>
                    <textarea class="form-control" id="produits" name="produits"
                              placeholder="détaillez ici la commande" rows="5">
                              <?php if (isset($_POST['produits'])) {
                                echo $_POST['produits'];
                              } ?></textarea>
                    <?php
                    if (isset($_POST['produits']) && empty($_POST['produits'])) {
                        echo "La description de la commande est vide.<br>";
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="quantite" class="form-label">* Quantité : </label>
                    <input type="number" class="form-control" id="quantite" name="quantite" placeholder="indiquez la quantité commandée"
                           value="<?php if (isset($_POST['quantite'])) {
                                    echo $_POST['quantite'];
                           } ?>">
                    <?php
                    if (isset($_POST['quantite']) && empty($_POST['quantite'])) {
                        echo "La quantité est vide.<br>";
                    }
                    ?>
                </div>

                <button type="submit" class="btn btn-primary">Valider la facture</button>
                <br>
            </form>
        </div>
    </div>

    <footer class="text-center mt-4 text-black">
        <p class="mb-0">© <?php echo date('Y'); ?> - Gestion des factures</p>
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