<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['user'] == null) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /Pages/Views/login.php');
    }
    $id_musique = $_GET['id'] ?? 1;
    $id_utilisateur = $_SESSION['user']['id_utilisateur'] ?? 1;
    require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php'; 
    $data = new Data\DataBase();
    $userStatement = $data->deleteFavorisMusique($id_musique, $id_utilisateur);
    header('Location: ' . $_SESSION['page']);
?>