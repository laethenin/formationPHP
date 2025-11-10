<?php

global $bdd;
require_once "config\db.php";

/// Récupération des données de la table
$sql = "SELECT * FROM clients";
$query = $bdd->query($sql);
$clients = $query->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="listeClients.css">
</head>

<body class="container">
<div class="card mb-4">
    <div class="card-header text-center">
        <h1 class="mb-0">📋 Liste des clients</h1>
    </div>
    <div class="card-body">
        <p class="text-center text-muted">Voici la liste des clients.</p>
    </div>
</div>

<div class="action-bar">
    <div>
        <a href="add_clients.php" class="btn btn-primary">Ajouter un client</a>
    </div>
    <div>
        <a href="add_factures.php" class="btn btn-success">Créer une facture</a>
    </div>
</div

<div class="row">
    <table class="table table-light">
        <thead>
        <tr>
            <th>Identifiant</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Sexe</th>
            <th>Date de naissance</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($clients as $item) { ?>
            <tr>
                <td><?php echo $item['id_clients']; ?></td>
                <td><?php echo $item['nom']; ?></td>
                <td><?php echo $item['prenom']; ?></td>
                <td><?php echo $item['sexe']; ?></td>
                <td><?php echo $item['date_naissance']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>

