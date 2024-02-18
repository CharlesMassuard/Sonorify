<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['user'] == null) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /Pages/Views/login.php');
    }
    $id_playlist = $_GET['id'] ?? 1;
    $id_utilisateur = $_SESSION['user']['id_utilisateur'] ?? 1;
    require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php'; 
    $data = new Data\DataBase();
    $userStatement = $data->deleteFavorisPlaylist($id_playlist, $id_utilisateur);
    header('Location: /Pages/Views/playlist.php?id='.$id_playlist);
?>