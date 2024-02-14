<?php
require_once 'Classes/Autoloader.php';
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
        echo "<strong class='warning'>Les mots de passe ne correspondent pas</strong>";
    }
    
} ?>
<!doctype>
<html>
<head>
    <title>Sonorify</title>
    <link rel="stylesheet" href="./static/css/register.css">
</head>
<body>
<main id="main-content">
    <div class="header">
    <img src="./ressources/images/grandLogo.png" alt="logo" class="logo">
    </div>
    <form action="register.php" method="post" id="registration-form">
    <h2 class="section-title"> Vos identifiants </h2>
    <div class="section1">
        <div>
            <label for="username" class="form-label">Pseudonyme</label>
            <input type="text" name="registerId" id="registerId" class="form-input" placeholder="Pseudonyme" required>
        </div>
        <div>
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" name="registerPw" id="registerPw" class="form-input" placeholder="Mot-De-Passe" required>
        </div>
        <div>
            <label for="mdpConfirm" class="form-label">Confirmer votre mot de passe</label>
            <input type="password" name="registerPwConfirm" id="registerPwConfirm" class="form-input" placeholder="Mot-De-Passe" required>
        </div>
    </div>
    <h2 class="section-title"> Vos coordonnées </h2>
        <div class="section2">
        <div>
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-input" placeholder="Prénom" required>
        </div>
        <div>
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-input" placeholder="Nom" required>
        </div>
        <div>
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-input" placeholder="Email" required>
        </div>
        <div>
            <label for="dateNaissance" class="form-label">Date de naissance</label>
            <input type="date" name="dateNaissance" id="dateNaissance" class="form-input" required>
        </div>
        <div class="button-container">
        <a href="login.php" id="to_login" class="login-link">Déjà inscrit ?</a>
        <input type="submit" value="Créer mon compte!" class="submit-button">
    </div>
    </div>
    </form>
</main>
</body>
</html>