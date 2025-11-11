<?php

global $bdd;
require_once "config\db.php";

//// Suppression d'une facture
if (isset($_GET['id_factures']) && !empty($_GET['id_factures']) && isset($_GET['action']) && $_GET['action'] == 'supprimer') {
    $id_factures = $_GET['id_factures'];
    $sql = "DELETE FROM factures WHERE id_factures = :id_factures";
    $query = $bdd->prepare($sql);
    $verif = $query->execute(['id_factures' => $id_factures]);

    if ($verif) {
        header("Location:list_factures.php");
        exit();
    }
}

/// récupération de certaines infos pour le menu déroulant
$sql_clients = "SELECT id_clients, nom, prenom FROM clients ORDER BY nom, prenom";
$query_clients = $bdd->query($sql_clients);
$clients = $query_clients->fetchAll();

// paramètres de filtrage
$filtre_client = isset($_GET['client']) ? $_GET['client'] : 'tous';
$date_debut = isset($_GET['date_debut']) ? $_GET['date_debut'] : '';
$date_fin = isset($_GET['date_fin']) ? $_GET['date_fin'] : '';


//// Récupération des données de la table factures et d'une partie de la table clients
/// et jointure afin d'afficher le nom et prénom du client
$sql = "SELECT factures.*, clients.nom, clients.prenom FROM factures
        INNER JOIN clients ON factures.id_clients = clients.id_clients";

$conditions = [];
$params = [];

// filtre sur le client
if ($filtre_client !== 'tous' && !empty($filtre_client)) {
    $conditions[] = "factures.id_clients = :id_clients";
    $params['id_clients'] = $filtre_client;
}

// Filtre sur la date
if (!empty($date_debut)) {
    $conditions[] = "factures.date_facture >= :date_debut";
    $params['date_debut'] = $date_debut;
}

if (!empty($date_fin)) {
    $conditions[] = "factures.date_facture <= :date_fin";
    $params['date_fin'] = $date_fin;
}

// Ajout des conditions à la requête
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY factures.date_facture DESC";

$query = $bdd->prepare($sql);
$query->execute($params);
$factures = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factures</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="listeFactures.css">
</head>

<body class="container">
<div class="card mb-4">
    <div class="card-header text-center">
        <h1 class="mb-0">📋 Liste des factures</h1>
    </div>
    <div class="card-body">
        <p class="text-center text-muted">Voici la liste des factures.</p>
    </div>
</div>

<a href="add_factures.php">
    <button class="btn btn-primary" onclick>Ajouter une facture</button>
</a>

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="list_factures.php">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="date_debut" class="form-label">Du :</label>
                    <input type="date" name="date_debut" id="date_debut" class="form-control"
                           value="<?php echo htmlspecialchars($date_debut); ?>">
                </div>

                <div class="col-md-3">
                    <label for="date_fin" class="form-label">Au :</label>
                    <input type="date" name="date_fin" id="date_fin" class="form-control"
                           value="<?php echo htmlspecialchars($date_fin); ?>">
                </div>

                <div class="col-md-4">
                    <label for="client" class="form-label">Client :</label>
                    <select name="client" id="client" class="form-select">
                        <option value="tous" <?php echo ($filtre_client == 'tous') ? 'selected' : ''; ?>>
                            Tous les clients
                        </option>
                        <?php foreach ($clients as $client) { ?>
                            <option value="<?php echo $client['id_clients']; ?>"
                                    <?php echo ($filtre_client == $client['id_clients']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($client['nom'] . ' ' . $client['prenom']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-success w-100">
                        🔍 Rechercher
                    </button>
                </div>
            </div>

            <?php if (!empty($date_debut) || !empty($date_fin) || $filtre_client !== 'tous') { ?>
                <div class="row mt-2">
                    <div class="col-12">
                        <a href="list_factures.php" class="btn btn-sm btn-outline-secondary">
                            ✖ Réinitialiser les filtres
                        </a>
                    </div>
                </div>
            <?php } ?>
        </form>
    </div>
</div>

<div class="row">
    <table class="table table-light">
        <thead>
        <tr>
            <th></th>
            <th>Identifiant</th>
            <th>Client</th>
            <th>Montant total</th>
            <th>Produits commandés</th>
            <th>Quantité</th>
            <th>Date de la facture</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($factures) > 0) { ?>}
        <?php foreach ($factures as $item) { ?>
            <tr>
                <td>
                    <input type="checkbox" name="id_selected[]" id="" value="<?php echo $item['id_factures']; ?>">
                </td>
                <td><?php echo $item['id_factures']; ?></td>
                <td><?php echo($item['nom'] . ' ' . $item['prenom']); ?></td>
                <td><?php echo $item['montant']; ?></td>
                <td><?php echo $item['produits']; ?></td>
                <td><?php echo $item['quantite']; ?></td>
                <td><?php echo $item['date_facture']; ?></td>
                <td>
                    <a class="btn btn-danger"
                       href="list_factures.php?id_factures=<?php echo $item['id_factures']; ?>&action=supprimer">Supprimer</a>
                    <a class="btn btn-warning"
                       href="edit_factures.php?id_factures=<?php echo $item['id_factures']; ?>">Modifier</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
        <div class="alert alert-info text-center" role="alert">
            <h4 class="alert-heading">📭 Aucune facture trouvée</h4>
            <p class="mb-0">
                <?php if (!empty($date_debut) || !empty($date_fin) || $filtre_client !== 'tous') { ?>
                    Aucune facture ne correspond aux critères de recherche sélectionnés.
                    <br>
                    <a href="list_factures.php" class="btn btn-sm btn-primary mt-2">Voir toutes les factures</a>
                <?php } else { ?>
                    Aucune facture n'est enregistrée dans la base de données.
                    <br>
                    <a href="add_factures.php" class="btn btn-sm btn-primary mt-2">Créer une facture</a>
                <?php } ?>
            </p>
        </div>
    <?php } ?>
</div>
<footer class="text-center mt-4 text-black">
    <p class="mb-0">© <?php echo date('Y'); ?> - Tokyu Hands</p>
</footer>
</body>
</html>
