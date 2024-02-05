<?php
    if ($_SESSION['user'] == null) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
    }
    $id_playlist = $_GET['id'] ?? 1;
    require_once 'Data/DataBase.php';
    $data = new Data\DataBase();
    $nom_musique = $_POST['nom_musique'] ?? 'AA';
    $musique = $data->getMusiqueByName($nom_musique);
    $id_musique = $musique['id_musique'];
    $userStatement = $data->insertMusiquePlaylist($id_musique, $id_playlist);
    header('Location: playlist.php?id='.$id_playlist);
?>