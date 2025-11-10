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

$filtre_client = isset($_GET['client']) ? $_GET['client'] : 'tous';

//// Récupération des données de la table factures et d'une partie de la table clients
/// et jointure afin d'afficher le nom et prénom du client
$sql = "SELECT factures.*, clients.nom, clients.prenom FROM factures
        INNER JOIN clients ON factures.id_clients = clients.id_clients";

if ($filtre_client !== 'tous' && !empty($filtre_client)) {
    $sql .= " WHERE factures.id_clients = :id_clients";
    $query = $bdd->prepare($sql);
    $query->execute(['id_clients' => $filtre_client]);
} else {
    $query = $bdd->prepare($sql);
    $query->execute();
}
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
    <button class="btn btn-info" onclick>Ajouter une facture</button>
</a>

<div class="col-md-6">
    <form method="GET" action="list_factures.php" class="d-flex justify-content-end">
        <label for="client" class="me-2 align-self-center">Filtrer par client :</label>
        <select name="client" id="client" class="form-select w-auto me-2" onchange="this.form.submit()">
            <option value="tous" <?php echo ($filtre_client == 'tous') ? 'selected' : ''; ?>>Tous les clients</option>
            <?php foreach ($clients as $client) { ?>
                <option value="<?php echo $client['id_clients']; ?>"
                        <?php echo ($filtre_client == $client['id_clients']) ? 'selected' : ''; ?>>
                    <?php echo $client['nom'] . ' ' . $client['prenom']; ?>
                </option>
            <?php } ?>
        </select>
    </form>
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
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if(count($factures) > 0){ ?>}
        <?php foreach ($factures as $item) { ?>
            <tr>
                <td>
                    <input type="checkbox" name="id_selected[]" id="" value="<?php echo $item['id_factures'];?>">
                </td>
                <td><?php echo $item['id_factures']; ?></td>
                <td><?php echo ($item['nom'].' '.$item['prenom']); ?></td>
                <td><?php echo $item['montant']; ?></td>
                <td><?php echo $item['produits']; ?></td>
                <td><?php echo $item['quantite']; ?></td>
                <td>
                    <a class="btn btn-danger" href="list_factures.php?id_factures=<?php echo $item['id_factures']; ?>&action=supprimer">Supprimer</a>
                    <a class="btn btn-warning" href="edit_factures.php?id_factures=<?php echo $item['id_factures']; ?>">Modifier</a>
                </td>
            </tr>
        <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
