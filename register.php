<?php
require 'Classes/Autoloader.php';
Autoloader::register();

use Data\Encrypteur;
use Data\DataBase;
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = new DataBase();
    $login = $_POST['registerId'];
    $mdp = $_POST['registerPw'];
    $confirmPassword = $_POST['registerPwConfirm'];
    if($mdp === $confirmPassword){
        $mdpCrypted = Encrypteur::encrypt($mdp);
        unset($_POST['registerPw']);
        unset($_POST['registerPwConfirm']);
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $dateNaissance = $_POST['dateNaissance'];
        $data->insertUser($login, $mdpCrypted, $nom, $prenom, $email, $dateNaissance);
        $userStatement = $data->getUser($login, $mdpCrypted);
        $user = $userStatement->fetch(PDO::FETCH_ASSOC);
        if ($user !== false) {
            $_SESSION['user'] = $user;
            if (isset($_SESSION['redirect_to'])) {
                $redirect_url = $_SESSION['redirect_to'];
                unset($_SESSION['redirect_to']);
                header('Location: ' . $redirect_url);
            }
            header('Location: index.php');
        }
        else {
            echo "<strong>Uh oh...</strong>";
        }
    }
    else{
        echo "<strong>Les mots de passe ne correspondent pas</strong>";
    }
    
} ?>
<!doctype>
<html>
<head>
    <title>PHP'oSong</title>
    <link rel="stylesheet" href="./static/css/register.css">
</head>
<body>
    <main>
        <h1>PHP'oSong</h1>
        <form action="register.php" method="post">
            <p> Vos identifiants </p>
            <label for="username">Pseudonyme</label>
            <input type="text" name="registerId" id="registerId" placeholder="Identifiant" required>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="registerPw" id="registerPw" placeholder="Mot-De-Passe" required>
            <label for="mdpConfirm">Confirmer votre mot de passe</label>
            <input type="password" name="registerPwConfirm" id="registerPwConfirm" placeholder="Mot-De-Passe" required>
            <p> Vos coordonnées </p>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" required>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="dateNaissance">Date de naissance</label>
            <input type="date" name="dateNaissance" id="dateNaissance" required>
            <input type="submit" value="Créer mon compte!">
        </form>
        <a href="login.php" id="to_login">Déjà inscrit ?</a>
    </main>
</body>
</html>