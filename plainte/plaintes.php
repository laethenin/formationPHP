<?php

global $bdd;
require_once "bdd.php";

$sql = "SELECT * FROM plaintes";
$query = $bdd->query($sql);
$plaintes = $query->fetchAll();

if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'supprimer') {
    $id = $_GET['id'];
    $sql = "DELETE FROM plaintes WHERE id = :id";
    $query = $bdd->prepare($sql);
    $verif = $query->execute(['id' => $id]);

    if ($verif) {
        header("Location:plaintes.php");
        exit();
    }
}

if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['visible']) && isset($_GET['action']) && $_GET['action'] == "changerStatut") {
    $visible=$_GET['visible'];
    $id = $_GET['id'];
    $sql = "UPDATE plaintes SET visible=:visible WHERE id = :id";
    $update = $bdd->prepare($sql);
    $verif = $update->execute([
            'id' => $id,
            'visible' => $visible?0:1,
            ]);

    if ($verif) {
        header("Location:plaintes.php");
        exit();
    }
}

if (isset($_GET['id_selected'])){
    $id_selected=$_GET['id_selected'];

    if (count($id_selected)>0) {
        $sql = "DELETE FROM plaintes WHERE id = :id";
        $query = $bdd->prepare($sql);

        foreach ($id_selected as $id_s) {
            $query->execute(['id' => $id_s]);
        }
    }
}

$sql = "SELECT * FROM plaintes";
$query = $bdd->query($sql);
$plaintes = $query->fetchAll();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plaintes</title>
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
<a href="formulaire.php">
    <button class="btn btn-info" onclick>Ajouter une plainte</button>
</a>

<form action="plaintes.php" method="GET">
    <button type="submit" class="btn btn-dark">Supprimer toute la sélection</button>

<div class="row">

    <table class="table table-light">
        <thead>
        <tr>
            <th>Sélectionner</th>
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
        <?php foreach ($plaintes as $item) { ?>
            <tr>
                <td>
                    <input type="checkbox" name="id_selected[]" id="" value="<?php echo $item['id'];?>">
                </td>
                <td><?php echo $item['id']; ?></td>
                <td><?php echo $item['nom']; ?></td>
                <td><?php echo $item['sujet']; ?></td>
                <td><?php echo $item['message']; ?></td>
                <td><?php echo $item['date_plainte']; ?></td>
                <td>
                    <?php if ($item['visible'] == 1) { ?>
                        <span class="badge bg-success">Visible</span>
                    <?php } else { ?>
                        <span class="badge bg-danger">Invisible</span>
                    <?php } ?>
                </td>
                <td>
                    <a class="btn btn-danger" href="plaintes.php?id=<?php echo $item['id']; ?>&action=supprimer">Supprimer</a>
                    <a class="btn btn-warning" href="edit_plainte.php?id=<?php echo $item['id']; ?>">Modifier</a>
                    <a class="btn btn-secondary" href="plaintes.php?id=<?php echo $item['id']; ?>&visible=<?php echo $item['visible']; ?>&action=changerStatut">Changer le statut</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
</form>
</body>
</html>