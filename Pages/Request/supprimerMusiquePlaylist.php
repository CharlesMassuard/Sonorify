<?php
    session_start();
    if ($_SESSION['user'] == null) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
    }
    $id_playlist = $_GET['id_playlist'] ?? 1;
    $id_musique = $_GET['id_musique'] ?? 1;
    require_once '../../Classes/Data/DataBase.php';
    $data = new Data\DataBase();
    echo $id_playlist;
    echo $id_musique;
    $userStatement = $data->deleteMusiquePlaylist($id_musique, $id_playlist);
    header('Location: playlist.php?id='.$id_playlist);
?>