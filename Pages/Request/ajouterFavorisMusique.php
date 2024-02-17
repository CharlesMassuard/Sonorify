<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['user'] == null) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
    } else {
        $id_musique= $_GET['id'] ?? 1;
        $id_utilisateur = $_SESSION['user']['id_utilisateur'] ?? 1;
        require_once '../../Classes/Data/DataBase.php'; 
        $data = new Data\DataBase();
        $userStatement = $data->insertFavorisMusique($id_musique, $id_utilisateur);
        header('Location: ' . $_SESSION['page']);
    }
?>