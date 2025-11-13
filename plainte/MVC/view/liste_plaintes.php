<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des plaintes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container">

<div class="card mb-4">
    <div class="card-header text-center">
        <h1 class="mb-0">📋 Liste des plaintes</h1>
    </div>
    <div class="card-body">
        <p class="text-center text-muted">Voici la liste des plaintes reçues.</p>
    </div>
</div>

<a href="index.php?page=ajouter_plainte">
    <button class="btn btn-info" onclick>Ajouter une plainte</button>
</a>

<div class="row">
    <table class="table table-light">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Sujet</th>
            <th>Message</th>
            <th>Date de la plainte</th>
            <th>Statut</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($plaintes as $plainte) { ?>
            <tr>
                <td><?php echo $plainte['id'] ?></td>
                <td><?php echo $plainte['nom'] ?></td>
                <td><?php echo $plainte['sujet'] ?></td>
                <td><?php echo $plainte['message'] ?></td>
                <td><?php echo $plainte['date_plainte'] ?></td>
                <td>
                    <?php if ($plainte['visible'] == 1) { ?>
                        <span class="badge bg-success">Visible</span>
                    <?php } else { ?>
                        <span class="badge bg-danger">Invisible</span>
                    <?php } ?>
                </td>
                <td>
                    <a href="index.php?page=show_plainte&id=<?php echo $plainte['id'] ?>">Voir</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>
