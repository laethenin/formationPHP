<?php
session_start();
global $bdd;
require_once "bdd.php";

if (!isset($_SESSION['admin'])) {
    header("Location: plaintes.php");
    exit();
}

$admin = $_SESSION['admin'];

if (isset($_COOKIE['user_connected']) && !empty($_COOKIE['user_connected']) && isset($_GET['action']) && $_GET['action'] == "logout") {
    setcookie("user_connected", null, time() - 3600);
    session_destroy();

    header("Location: plaintes.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<?php if (isset($_SESSION['welcome_msg'])) { ?>
    <div class="row my-3">
        <div class="col-lg-12">
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['welcome_msg']; ?>, vous êtes connecté à l
                'application.
            </div>
        </div>
    </div>
<?php } ?>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $admin['nom'] ?></td>
                <td><?php echo $admin['prenom'] ?></td>
                <td><?php echo $admin['email'] ?></td>
            </tr>
        </tbody>
    </table>

<?php if (isset($_COOKIE['user_connected']) && !empty($_COOKIE['user_connected'])) { ?>
<a href="plaintes.php?action=logout" class="btn btn-primary">Se déconnecter</a>
<?php } ?>
</body>
</html>




