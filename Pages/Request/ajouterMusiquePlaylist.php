<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['user'] == null) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: /Pages/Views/login.php');
    } else {
        $id_playlist = $_GET['id'] ?? 1;
        require_once dirname(__FILE__) . '/../../Classes/Data/DataBase.php';
        $data = new Data\DataBase();
        $nom_musique = $_POST['nom_musique'] ?? '';
        $id_musique = $data->getMusiqueByName($nom_musique)['id_musique'];
        if ($id_musique ) {
            $userStatement = $data->insertMusiquePlaylist($id_musique, $id_playlist);
        } 
        header('Location: /Pages/Views/playlist.php?id='.$id_playlist);
    }
?>