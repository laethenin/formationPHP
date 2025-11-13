<?php

global $bdd;
require_once 'bdd.php';

if (isset($_COOKIE['user_connected']) && !empty($_COOKIE['user_connected'])) {
    header('Location: plaintes.php');
}

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM admins WHERE email=:email";
        $query = $bdd->prepare($sql);
        $admin = $query->execute(array('email' => $email));
        $admin = $query->fetch();

        if ($admin && $admin['password'] == $password) {
            setcookie("user_connected", $email, time() + 3600);
            setcookie("user_infos", $admin['nom']." ".$admin['prenom'], time() + 3600);

            session_start();
            $_SESSION['admin'] = $admin;
            $_SESSION['welcome_msg'] = "Bienvenue"." ".$admin['prenom'];

            header("Location: plaintes.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container-custom">
    <div class="card mb-4">
        <div class="card-header text-center">
            <h1 class="mb-0">Connexion</h1>
        </div>
        <div class="card-body">
            <p class="text-center text-muted">Merci de remplir ce formulaire afin de vous connecter.</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <a href="plaintes.php"><button type="button" class="btn btn-danger">Retour</button></a>
            <form action="connexion.php" method="POST" autocomplete="off">
                <div class="mb-3">
                    <label for="email">* Email : </label>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="exemple@email.com" value="<?php if (isset($_POST['email'])) {
                        echo $_POST['email'];
                    } ?>">
                    <?php
                    if (isset($_POST['email']) && empty($_POST['email'])) {
                        echo "L'email est vide.<br>";
                    }
                    ?>
                </div>

                <div class="mb-3">
                    <label for="password">* Mot de passe : </label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="entrez votre mot de passe"
                           value="<?php if (isset($_POST['password'])) {
                               echo $_POST['password'];
                           } ?>">
                    <?php
                    if (isset($_POST['password']) && empty($_POST['password'])) {
                        echo "Le mot de passe est vide.<br>";
                    }
                    ?>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>
