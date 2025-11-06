<?php

global $bdd;
require_once "bdd.php";

$sql = "SELECT * FROM plaintes";
$query = $bdd->query($sql);
$plaintes = $query->fetchAll();

if (isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM plaintes WHERE id = :id";
    $query = $bdd->prepare($sql);
    $verif = $query->execute(['id' => $id]);

    if ($verif){
        header("Location:plaintes.php");
        exit();
    }
}
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
    <a href="formulaire.php"><button onclick>Ajouter une plainte</button></a>
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
                <?php foreach ($plaintes as $item){?>
                <tr>
                    <td><?php echo $item['id'];?></td>
                    <td><?php echo $item['nom'];?></td>
                    <td><?php echo $item['sujet'];?></td>
                    <td><?php echo $item['message'];?></td>
                    <td><?php echo $item['date_plainte'];?></td>
                    <td>
                        <?php if ($item['visible'] == 1) { ?>
                            <span class="badge bg-success">Visible</span>
                        <?php } else { ?>
                            <span class="badge bg-danger">Invisible</span>
                        <?php } ?>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="plaintes.php?id=<?php echo $item['id'];?>">Supprimer</a>
                        <a class="btn btn-warning" href="plaintes.php?id=<?php echo $item['id'];?>">Modifier</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>