<?php
require dirname(__FILE__) . '/../../Classes/Autoloader.php';
Autoloader::register();

use Data\Encrypteur;
use Data\DataBase;
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = new DataBase();
    $login = $_POST['identifiant'];
    $mdp = $_POST['mdp'];
    $mdpCrypted = Encrypteur::encrypt($mdp);
    unset($_POST['mdp']);
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
        echo "<strong class='warning'>Identifiant ou mot de passe incorrect</strong>";
    }
} ?>
<head>
    <title>Sonorify</title>
    <link rel="stylesheet" href="./static/css/login.css">
</head>
<body>
    <main id="main-content">
        <img src="/static/img/grandLogo.png" alt="logo" class="logo">
        <form action="login.php" method="post" id="login-form">
            <label for="username" class="form-label">Identifiant</label>
            <input type="text" name="identifiant" id="identifiant" class="form-input" placeholder="Identifiant" required>
            <label for="mdp" class="form-label">Mot-De-Passe</label>
            <input type="password" name="mdp" id="mdp" class="form-input" placeholder="Mot-De-Passe" required>
            <div class="button-container">
                <input type="submit" class="submit-button" value="Se connecter">
            </div>
        </form>
        <a href="register.php" id="to_register" class="register-link">Pas encore inscrit ?</a>
    </main>
</body>