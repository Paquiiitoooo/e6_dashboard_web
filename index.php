<?php
session_start();
if(isset($_SESSION['user_id'])){
    header("Location: src/view/front/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="login-container">
            <h2>Connexion</h2>
            <form action="login.php" method="POST">
                <input type="text" name="username" placeholder="Nom d'utilisateur" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <button class ="submit" type="submit">Se connecter</button>
            </form>
            <p>Pas encore de compte ? <a href="register.php"> S'inscrire</a></p>
        </div>
    </body>
</html>