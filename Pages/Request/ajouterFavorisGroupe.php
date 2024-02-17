<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['user'] == null) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
    } else {
        $id_groupe = $_GET['id'] ?? 1;
        $id_utilisateur = $_SESSION['user'].getIdUtilisateur(); 
        $data = new Data\DataBase();
        $userStatement = $data->insertFavoriteGroupe($id_groupe, $id_utilisateur);
    }
?>