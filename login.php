<?php
require 'Classes/Autoloader.php';
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
        echo "<strong>Identifiant ou mot de passe incorrect</strong>";
    }
} ?>
        <h1>PHP'oSong</h1>
        <form action="login.php" method="post">
            <label for="username">Identifiant</label>
            <input type="text" name="identifiant" id="identifiant" placeholder="Identifiant" required>
            <label for="mdp">Mot-De-Passe</label>
            <input type="password" name="mdp" id="mdp" placeholder="Mot-De-Passe" required>
            <input type="submit" value="Login">
        </form>
    </main>